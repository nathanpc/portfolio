<?php
$post = array(
	'title' => 'Levissimo: A Perl Static Blog Generator'
);
?>

<p>
	2 years ago me and my wife moved from Brazil to Portugal, but due to some
	unfortunate series of events we ended up having to live some months in a
	hotel while some construction work was being finished in our new apartment.
	Because of this I was without an electronics lab for way too long, which
	gave me more time to do some software projects. From these turbulent times a
	static blog generator was born. I've always wanted to write my blog posts in
	plain HTML, which gave me a lot more flexibility than Markdown, and this was
	the foundation for <a href="https://github.com/nathanpc/levissimo">Levissimo
	</a>, to be kind of the <a href="https://suckless.org/">suckless</a> of
	blogs.
</p>

<p>
	As you might have noticed, I've imported some of my posts that I had on my
	old blog, <a href="https://currentflow.net/">Current Flow</a>, which was
	originally a Tumblr that I converted to Levissimo, so if you want to see
	exactly how an instance of this blog generator is, that's the place to go.
</p>

<?= blog_image('current-flow.png', 'How a Levissimo Instance Looks Like', [], [
	'caption' => true
]) ?>

<p>
	If you want to learn more about this project or maybe even try it out make
	sure to head over to the <a href="https://github.com/nathanpc/levissimo">
	GitHub repository</a> where you'll find everything about it including how to
	set it up.
</p>

<p>
	Unfortunately, as much as I was very eager to use Levissimo for the company
	blog, I've decided against it and went with
	<a href="https://wordpress.org/">WordPress</a> for the simple reason that I
	wanted something that I could quickly set up and customize without having to
	waste much time programming, since my free time is quite scarce these days,
	but also because WordPress is so easy to migrate from, thanks to awesome
	first-party and third-party tools, that if I decide to migrate to Levissimo,
	it's just a matter of exporting the data and writing a script to import all
	of it into Levissimo.
</p>

<p>
	Finally I would like to add that even though Perl gets a lot of hate these
	days, it's still one of the programming languages that I love most, and
	continue to cling to whenever a project comes up where it will be useful.
	If you come to it with an open mind, stick to
	<a href="http://modernperlbooks.com/">Modern Perl</a>, and doesn't despise
	<a href="https://en.wikipedia.org/wiki/Sigil_(computer_programming)">sigils
	</a>, you might end up loving it as well.
</p>
