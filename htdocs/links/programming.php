<h2 id="prog">Programming</h2>
<p>The art of turning ideas and logic into magical things that may be
	useful when run on a computer.</p>

<!-- ----------------------------------------------------------------------- -->

<h3 id="prog-msdos">MS-DOS</h3>
<p>The hellish landscape of no drivers, near and far pointers, and
	inline assembly.</p>

<?php link_component(
	'DOS retrocoding 01 - setting up',
	'http://nuclear.mutantstargoat.com/articles/retrocoding/dos01-setup/',
	'Really nice tutorial on how to get started with Open Watcom ' .
	'under DOS.'
); ?>
<?php link_component(
	'Practical Watcom Makefiles, by example',
	'http://nuclear.mutantstargoat.com/articles/make/',
	'Great resource on Open Watcom\'s makefiles.'
); ?>

<!-- ----------------------------------------------------------------------- -->

<h3 id="prog-git">Git</h3>
<p>The <i>de facto</i> standard in version control systems. Created by Linus
	Torvalds and popularized by the Ruby community.</p>

<?php link_component(
	'Setting up cgit on Debian',
	'https://floatingoctothorpe.uk/2017/setting-up-cgit-on-debian.html',
	'Great tutorial on how to setup cgit for a self-hosted Git server.'
); ?>

<!-- ----------------------------------------------------------------------- -->

<h3 id="prog-cvs">CVS (Concurrent Versions System)</h3>
<p>The horrible and outdated version control system that's still plenty good
	enough for some BSD distributions.</p>

<?php link_component(
	'Secure CVS Pserver Mini-HOWTO',
	'http://www.faqs.org/docs/Linux-mini/Secure-CVS-Pserver.html',
	'Most of what you need to know to quickly setup a pserver.'
); ?>
<?php link_component(
	'Open Source Development with CVS, 3rd Edition',
	'http://cvsbook.red-bean.com/',
	'The bible on how to properly use CVS for open source development.'
?>

<!-- ----------------------------------------------------------------------- -->

<h3 id="prog-docker">Docker</h3>
<p>The thing that unfortunately popularized containers. Think of FreeBSD's
	jails, except 100% declarable, and worst in many ways.</p>

<?php link_component(
	'How To Run Container Background Tasks With Cron By Using Supervisord',
	'https://huyhoang8398.github.io/blog/posts/how-to-run-container-background-tasks-with-cron-by-using-supervisord/',
	'Running multiple services with supervidord and cron made easy.'
); ?>

<!-- ----------------------------------------------------------------------- -->

<h3 id="prog-sockets">Sockets</h3>
<p>Like driving a manual car, except it's a network. The way you create and
	implement protocols when no library is available.</p>

<?php link_component(
	'Beej\'s Guide to Network Programming',
	'https://beej.us/guide/bgnet/',
	'At this point this is basically the bible of network programming. ' .
		'Definitely a required read.'
); ?>
<?php link_component(
	'Beej\'s Socket Examples Ported to Windows',
	'https://www.tallyhawk.net/WinsockExamples/',
	'All of Beej\'s great examples ported to WinSock 2. Also a great resource '
	'to learn the differences between UNIX and Windows sockets.'
); ?>
<?php link_component(
	'Programming with sockets - SCO OpenServer 6',
	'http://osr600doc.xinuos.com/en/SDK_netapi/CONTENTS.html#:~:text=Programming%20with%20sockets',
	'An amazing tutorial on how to do proper sockets programming.'
); ?>
