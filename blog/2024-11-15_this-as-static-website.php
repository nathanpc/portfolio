<?php
$post = array(
	'title' => 'Making this website static'
);
?>

<p>
	If you look through <a href="https://github.com/nathanpc/portfolio">the
	repository of this website</a>, specially if you look at the commit history,
	you'll notice that I've completely rewritten it to be completely static, and
	because of its previous architecture, compiling everything into a static
	website was a breeze and required minimum modifications.
</p>

<p>
	In order to pull this off I created
	<a href="https://github.com/nathanpc/fantastique">a very simple PHP
	microframework</a> that would allow me to keep most of the work I had
	already done while building the website, after all I didn't want all of it
	to go to waste. Since I'm lazy I wanted this change to require a minimum
	amount of modifications to the code I already had for it, but also require
	no major architectural changes to my workflow when building this website, so
	the framework was built with maximum flexibility in mind.
</p>

<p>
	The creation of this microframework was another step for another goal, which
	is that I want to reuse most of what I've already built to automatically
	build a <a href="https://en.wikipedia.org/wiki/Gopher_(protocol)">gopherhole</a>
	and maybe a <a href="https://en.wikipedia.org/wiki/Gemini_(protocol)">Gemini
	capsule</a>. These are my next steps, but I may play around more with the
	design of the website beforehand. Either way the right pieces are all in
	place.
</p>

<p>
	I'm a sucker for automation, so the last thing I've done to make this new
	version of my website even better and motivate me to write more often and
	keep it updated, was to play around with
	<a href="https://github.com/features/actions">GitHub Actions</a> to create
	<a href="https://github.com/nathanpc/portfolio/actions/workflows/publish-docker.yml">
	a workflow that would build a Docker image</a> of the final built website
	and automatically publish that so that my server, using
	<a href="https://containrrr.dev/watchtower/">watchtower</a>, could pull the
	new version as it's ready for production. So now all that I have to do in
	order to update or post something here is commit and push, everything else
	is done automatically. I don't like relying on GitHub, but at least it's
	something that isn't a requirement, just a nice thing to have, and can be
	easily replaced by a script if need be in the future.
</p>

<p>
	Given the current level of automation that the website currently has I'm now
	looking into ways keep tabs on my build and deployment workflows, maybe
	something involving Telegram since there are ways to integrate it in
	<a href="https://github.com/marketplace/actions/telegram-notify">GitHub
	Actions</a> and <a href="https://github.com/Pyenb/Watchtower-telegram-notifications">Watchtower</a>.
</p>

<p>
	All in all I'm very pleased with the final result and these changes make me
	even more motivated to dedicate time to this website, which
	<a href="<?= $this->link_post('2024-07-05', 'building-website') ?>">was the
	goal of creating this whole thing in the first place</a>.
</p>
