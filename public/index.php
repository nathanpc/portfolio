<?php include_once __DIR__ . '/../templates/doctype.php'; ?>
<html>
<head>
	<title>Nathan Campos</title>
	
	<?php include_once __DIR__ . '/../templates/head.php'; ?>
</head>
<body>
	<?php include_once __DIR__ . '/../templates/header.php'; ?>

	<div class="section">
		<h2>about me</h2>
	
		<p>
			<img src="<?= href('/assets/images/nathan/profile.jpg') ?>"
				width="200px" height="200px"
				style="float: left; padding-right: 10px;"
				alt="A picture of me smiling with my workbench as the background">
			<?php if (compat_isconsole()) { ?>
				<p></p>
			<?php } ?>
	
			I'm a <b>full-stack developer</b> (although I prefer the backend),
			<b>creative technologist</b> and an <b>electronics engineer</b>
			born in <a href="https://en.wikipedia.org/wiki/Brazil">Brazil</a>
			and currently living in
			<a href="https://en.wikipedia.org/wiki/Portugal">Portugal</a>.
			You can find me working on almost anything that involves
			electricity, both in terms of hardware and software.  Building
			things has always been a passion of mine, so you'll notice that I'm
			always self-motivated to work on new projects that involve
			technology. Some of the things that I've worked on have been used
			by hundreds of thousands of people, maybe into the millions
			depending on who's counting, and my work has definitely reached at
			least tens of millions.
		</p>
	
		<p>I'm currently dedicating some of my time to passing some of my
		knowledge to another generation and having a lot of fun working on
		creative projects with my students and colleagues at
		<a href="https://www.iade.europeia.pt/"> IADE - Creative University</a>.
		I'm mostly involved with the
		<a href="https://www.iade.europeia.pt/en/undergraduate-programs/bachelor-creative-technologies/">
		Creative Technologies</a>,
		<a href="https://www.iade.europeia.pt/en/undergraduate-programs/bachelor-games-development/">
		Games Development</a>, and
		<a href="https://www.iade.europeia.pt/licenciaturas/engenharia-informatica/">
		Computer Science</a> degrees.</p>
	
		<p>If you browse this website, <a href="https://github.com/nathanpc">my
		GitHub profile</a>, or
		<a href="<?= $_SERVER['REQUEST_SCHEME'] . '://innoveworkshop.com/' ?>">
		my company's website</a> you'll notice that I'm capable of building
		quite a lot of amazing things. If you're looking for someone with my
		skillset either for your company or to make your idea become a reality
		feel free to reach out to me at
		<?=safe_email('nathan@innoveworkshop.com') ?>.</p>
	</div>
	
	<div class="section">
		<h2>this website</h2>
	
		<p>As you can clearly notice this website doesn't look like your
		regular client-side rendered, Javascript-dependent, bloated, spying,
		and resource hungry webpage that's so prevalent today. I despise the
		way things currently are, the web used to be such a wonderful place and
		currently it's simply depressing. I hate so much how the modern website
		is built that I've decided to build a proper website that adheres to
		the <a href="https://smolweb.org/guidelines.html">smolweb guidelines
		</a>.</p>
	
		<p>This website was built to showcase that you don't need gigabytes of
		node modules in order to build
		<a href="https://thebestmotherfucking.website">a webpage</a>, and most
		importantly just because <a href="https://web.dev/baseline/">Baseline
		</a> tells you to target the "almost latest and greatest" doesn't mean
		you should. This website is built to be properly rendered on almost any
		web browser, from Lynx to Netscape on Windows 3.11 to the latest version
		of Chrome Canary.</p>
	
		<p>The main goal behind this website is to bring back
		<a href="https://daniel.industries/2023/10/17/what-happened-to-web-design/">
		the joy of the old web days</a> and allow me to publish more things
		online, something that I felt I was less and less inclined to do given
		our current social media realities. Building this website brought back
		that joy I felt when I first started building webpages and I hope will
		allow me to keep motivated to continue publishing more of what I'm
		currently up to.</p>
	
		<p>You can check the source code that powers this amazing webpage
		<a href="https://github.com/nathanpc/portfolio">here</a>. I'm currently
		working on a solution to hosting my Git repositories on GitHub, so that
		they are more accessible to everyone (I hate how you can't clone a repo
		on an older Linux machine anymore), but since I already have a local
		Git server that only mirrors things to GitHub I need to figure out a
		three way solution that is publicly accessible and won't be fiddly to
		maintain.</p>
	</div>

	<?php include_once __DIR__ . '/../templates/footer.php'; ?>
</body>
</html>
