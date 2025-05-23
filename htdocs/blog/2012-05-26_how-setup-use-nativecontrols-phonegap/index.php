<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>How To Setup And Use NativeControls In PhoneGap</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>How To Setup And Use NativeControls In PhoneGap</h2>
		<div id="published-date">2012-05-26</div>
	</div>

<?= compat_image("./title.png", "NativeControls") ?>

<p>As many might know the most used plugins in <a href="http://phonegap.com/">PhoneGap</a> for iOS are <a href="https://github.com/purplecabbage/phonegap-plugins/tree/master/iPhone/NativeControls">NativeControls</a> and <a href="https://github.com/purplecabbage/phonegap-plugins/tree/master/iPhone/ChildBrowser">ChildBrowser</a>, but installing plugins is a bit tricky and you can't easily find this kind of help around the internet, for example in my case I've learned by reading about plugins installation in PhoneGap and doing tests, so on this post I'll cover the entire setup and usage of NativeControls (but you can use this for any other plugin in the iOS repo) in a very simple and informative way that even a PhoneGap beginner can understand. I'll assume that you've already had installed and configured the Xcode environment on your Mac and is familiarized with the latest version of it. The first thing you must do is download the <a href="https://github.com/purplecabbage/phonegap-plugins">phonegap-plugins</a> repo archive and extract it anywhere you like. Now go to the extracted folder and go to iPhone/NativeControls and copy the NativeControls.h and NativeControls.m to the <code>/Plugins</code> folder on Xcode, then move the <code>NativeControls.js</code> to your desired place in the <code>www</code> folder. After all this copying and pasting you must open your <code>PhoneGap.plist</code> under <code>/Supporting Files</code> and add a new item to the Plugins array with the <em>Key</em> and <em>Value</em> <code>NativeControls</code> and the <code>Type</code> String, at the end your project should look something like this:</p>

<?= compat_image("./xcode.png", "Xcode") ?>

<p>Now you're ready to start diving into the code. The first thing you should do is include the required Javascript files into your <code>index</code> HTML source in this order:</p>

<?php compat_code_begin('markup'); ?><script src="phonegap-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script src="NativeControls.js" type="text/javascript" charset="utf-8"></script><?php compat_code_end(); ?>

<p>The next thing to do is go to your main Javascript file, which contains the <code>onDeviceReady</code> event set and put the NativeControls initialization code there. On this example we are going to use the <code>TabBar</code> component to output something like this:</p>

<?= compat_image("./tabbar.png", "TabBar") ?>

<p>As you might have noticed I'm using the <a href="http://glyphish.com/">Glyphish Pro</a> icon pack there, which you can get for $25, but it's worth every cent, since it's such a complete icon pack for your TabBars and more. First of all you should initialize a NativeControls variable and create a assign a <code>TabBar</code> to it using this code:</p>

<?php compat_code_begin('js'); ?>nativeControls = window.plugins.nativeControls;
nativeControls.createTabBar();<?php compat_code_end(); ?>

<p>Then you can start creating a icon/button for a tab using this JSON object:</p>

<?php compat_code_begin('js'); ?>nativeControls.createTabBarItem(
  "books",
  "Books",
  "/www/tabs/book.png",
  {"onSelect": function() {
    // Do something
  }}
);<?php compat_code_end(); ?>

<p>The first item is the name variable, the second is the icon label, the third is the icon path and the last one is a function that should be called every time icon is clicked. Be aware that you should insert the icon path relative to the project folder! About retina icons I really encourage you to check out <a href="http://stackoverflow.com/questions/3666963/iphone-4-tab-bar-icons/3667247#3667247">this explanation</a> on how to organize them. After you added all the icons you want to the TabBar you should show it in the screen. Then start to place the icons (the order you declare on this function they will get placed) and finally assign a <code>TabBar</code> to be active as the app is fired, just like this:</p>

<?php compat_code_begin('js'); ?>nativeControls.showTabBar();
nativeControls.showTabBarItems("books", "finished", "about");
nativeControls.selectTabBarItem("books");<?php compat_code_end(); ?>

<p>If you want you can choose from the pre-defined <code>TabBar</code> icons that Apple include by default on their SDK by using these keywords as the icon item:</p>

<ul>
	<li><code>tabButton:More</code></li>
	<li><code>tabButton:Favorites</code></li>
	<li><code>tabButton:Featured</code></li>
	<li><code>tabButton:TopRated</code></li>
	<li><code>tabButton:Recents</code></li>
	<li><code>tabButton:Contacts</code></li>
	<li><code>tabButton:History</code></li>
	<li><code>tabButton:Bookmarks</code></li>
	<li><code>tabButton:Search</code></li>
	<li><code>tabButton:Downloads</code></li>
	<li><code>tabButton:MostRecent</code></li>
	<li><code>tabButton:MostViewed</code></li>
</ul>

<p>Remember that the label will be unusable since these will overwrite it, but you should put something on the label item or it won't work. I've uploaded the full source code to my Gist and you can check it out at <a href="https://gist.github.com/1384250">Example of NativeControls in PhoneGap</a>. After all this hard work you're ready to compile your application and test it. If you followed the instructions correctly everything should work. If anything goes wrong please drop us a comment and will be my pleasure to help you. Also leave a comment with your thoughts on this article or suggestions. </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
