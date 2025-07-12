<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Using supervisord as cron inside Docker containers</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Using supervisord as cron inside Docker containers</h2>
		<div id="published-date">2025-07-12</div>
	</div>

	<p>Recently, while rebuilding my local Git repository server to run within
		Docker (<a href="https://github.com/nathanpc/docker-source-vault">docker-source-vault</a>),
		I was once again faced with the problem of having to run multiple
		programs at the same time within the same container project, a task
		that's usually solved by either breaking things into multiple containers
		and orchestrating everything with <code>docker compose</code>, by
		<a href="https://docs.docker.com/engine/containers/multi-service_container/#use-bash-job-controls">using
		a simple entrypoint shell script</a> and sending all programs to the
		background, or the correct way, which is to use a process manager, as
		is <a href="https://docs.docker.com/engine/containers/multi-service_container/#use-a-process-manager">adviced
		by Docker themselves</a>.</p>

	<p>Since my use case required that services such as SSH and Apache were
		properly monitored and cared for, as no one wants their repositories
		offline, I went down the process manager route with
		<code><a href="https://supervisord.org/">supervisord</a></code>. This
		solution has proved very reliable in production so it was a safe bet,
		although this time, for the first time, I had to have something akin to
		<code>cron</code> inside my container, since I have a repository
		synchronization script that should run every 5 minutes, and ensures that
		I mirror all my local changes to GitHub.</p>

	<p>Having <code>cron</code> inside a container is a really bad idea, since
		it's not really designed to work in that specific environment, not only
		that, but since we already have <code>supervisord</code>, we should have
		everything that's needed to run a task at a fixed interval, since it has
		<a href="https://supervisord.org/events.html">an event system</a> that
		supports <code>TICK</code> events.</p>

	<p>The problem with <code>supervisord</code>'s <code>TICK</code> events is
		that they only work in fixed intervals of every 5 seconds, every minute,
		or every hour, meaning they are not arbitrary, which is a big problem,
		and of course <a href="https://narkive.com/hPOo79mM">people have asked
		for solutions</a> and the developers simply tell them to <i>"Subscribe
		to one <code>TICK_*</code> event and increment a counter each time the
		event is received. When a certain number of counts have occurred, act
		and reset the count."</i>, which is great, but there's no documentation
		on how to properly do this from a simple shell script and adhering to
		the event system's communication protocol.</p>

	<p>After digging through the event system documentation and understanding
		how to properly manage <a href="https://supervisord.org/events.html#event-listener-states">event
		states</a>, I came up with the following solution using
		<code>bash</code>:</p>

<?php compat_code_begin('bash'); ?>#!/bin/bash

# Go into ready state and wait for the event to come in.
echo 'READY'
read -s eventinfo
echo "$eventinfo" 1>&2

# Get the counter value.
counter=0
counterfile=/tmp/counter  # TODO: Change this if you have multiple events.
if [ -f "$counterfile" ]; then
	counter=$(head -n 1 "$counterfile")
fi

# Increment the counter and store it.
counter=$((counter+1))
echo "$counter" > "$counterfile"
echo "Counter: $counter" 1>&2

# Check if we've reached our timer goal.
if [ "$counter" -lt "$TICK_GOAL" ]; then
	# See you next time.
	echo -e -n "RESULT 2\nOK"
	exit 0
else
	# Reset the counter.
	counter=0
	echo "$counter" > "$counterfile"
fi

# TODO: Put here everything that you need to run at a fixed interval.

# Notify we processed the event.
echo -e -n "RESULT 2\nOK"<?php compat_code_end(); ?>

	<p>This shell script performs all the necessary communications with
		<code>supervisord</code> in order to keep it happy and can have its time
		interval configured by selecting the right combination of event type
		and an environment variable called <code>TICK_GOAL</code>, allowing for
		completely arbitrary intervals.</p>

	<p>Here's an excerpt of the <code>supervisord.conf</code> used to perform
		the synchronization task every 5 minutes:</p>

<?php compat_code_begin('ini'); ?>[eventlistener:gitsync]
command = /git-scripts/auto-sync
events = TICK_60
environment = TICK_GOAL="5"
autostart = true
autorestart = true
redirect_stderr = false
stderr_logfile = /logs/event_%(program_name)s.log
stderr_logfile_maxbytes = 2MB
stderr_logfile_backups = 10<?php compat_code_end(); ?>

	<p>That's all you need to have tasks running at fixed intervals inside your
		containers.</p>

	<?php include_template('footer'); ?>
</body>
</html>
