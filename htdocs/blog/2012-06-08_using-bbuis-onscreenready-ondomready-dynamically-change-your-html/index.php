<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<?php include __DIR__ . '/../../../templates/head.php'; ?>

	<!-- Page information. -->
	<title>Using bbUI's onscreenready and ondomready to Dynamically Change Your HTML</title>
</head>
<body>
	<?php include_template('header'); ?>

	<div id="blog-post" class="section">
		<h2>Using bbUI's onscreenready and ondomready to Dynamically Change Your HTML</h2>
		<div id="published-date">2012-06-08</div>
	</div>

<p>I started playing a bit with BlackBerry development these days and since I'm not the best at Java (also hate how it's difficult to do simple things with it) I choose their awesome framework for HTML5 native web development called <a href="https://developer.blackberry.com/html5/">WebWorks</a>. I really loved it because it's like PhoneGap, but a lot easier to build plugins (extensions on WebWorks) for it to make your native WebApp feel a lot more native.</p>

<p>Another great thing that RIM did to make the life of WebWorks developers easier and create apps that are exactly like native ones is a Javascript framework called <a href="https://github.com/blackberry/bbUI.js">bbUI.js</a>, which is like jQuery Mobile, but seriously, it's a lot more than just a UI framework. It makes it a lot easier to interact with the OS, override the back button for example, and makes your development cycle look a lot with native development by using <a href="https://github.com/blackberry/bbUI.js/wiki/Screens"><em>screens</em></a>. On this post I'll teach you how to dynamically manipulate the screen's HTML before it's processed by the bbUI library.</p>

<p>One of the first things that you'll notice after you start working with bbUI is that it's not just a collection Javascript functions and CSS stylings, it actually reformat and customize your screen's HTML before it's shown to the user. As an example, this simple <em>image-list</em> item declaration in your screen HTML source looks like this:</p>

<?php compat_code_begin('markup'); ?><div data-bb-type="item" data-bb-title="Title goes here" data-bb-img="images/test.png" onclick="alert('this was clicked')">A description is welcome.</div><?php compat_code_end(); ?>

<p>After it's processed by the library and shown to the user it will look like this:</p>

<?php compat_code_begin('markup'); ?><div data-bb-type="item" class="bb-hires-image-list-item"
    onclick="alert('this was clicked')"
    onmouseover="this.setAttribute('class','bb-hires-image-list-item-hover')"
    onmouseout="this.setAttribute('class','bb-hires-image-list-item')"
    x-blackberry-focusable="true">
  <img src="images/test.png">
  <div class="details">
    <span class="title">Title goes here</span>
    <span class="accent-text"></span>
    <div class="description">A description is welcome.</div>
  </div>
</div><?php compat_code_end(); ?>

<p>Hopefully we can easily manipulate our screen elements and other things before and after it's processed by bbUI. This is done with the <strong>bb.init()</strong> function (you can always read more at their <a href="https://github.com/blackberry/bbUI.js/wiki/Toolkit-Initialization">documentation</a>). This will be called when the application starts and can be used to listen to events like when a screen is loaded. The main ones are <strong>onscreenready</strong> and <strong>ondomready</strong>.</p>

<p><strong>onscreenready:</strong> This event will be fired before the sources get processed by the library, so here is where you should manipulate, add or remove things from your HTML source using Javascript, so after it's done the code will be passed to bbUI to be processed.</p>

<p><strong>ondomready:</strong> This event will be fired when the screen finished loading and it has been already processed by bbUI and shown to the user. Here you can put things like alerts and other things that will be used to interact with the user, also some little editing to the screen's source like renaming a field grabbing some information from a field and etc.</p>

<p>Here is a example of a <strong>bb.init()</strong> call:</p>

<?php compat_code_begin('js'); ?>bb.init({
  onscreenready: function (element, id) {
    if (id == "main") {
      // code to be executed before the "main" screen is loaded.
    } else if (id == "add") {
      // code to be executed before the "add" screen is loaded.
    }
  },
  ondomready: function (element, id) {
    if (id == "main") {
      // code to be executed after the "main" screen is loaded.
    } else if (id == "add") {
      // code to be executed after the "add" screen is loaded.
    }
  }
});<?php compat_code_end(); ?>

<p>The code is almost self-explanatory. The <strong>id</strong> is the name, second argument, you gave to a screen when you call it to be processed, for example <em>bb.pushScreen("screen/main.html", "main")</em>. And <strong>element</strong> is the screen source code, which is used to be manipulated before the screen is loaded.</p>

<p>A little problem that some developers might come across while using bbUI for the first time is that when you want to append or change the HTML of the screen before it's processed by bbUI you might write your code like if the HTML was already loaded onto the screen, but it's not. Here is an example of a code that won't work, used to populate a <em>image-list</em> and then show a button that was hidden (using jQuery):</p>

<?php compat_code_begin('js'); ?>bb.init({
  onscreenready: function (element, id) {
    if (id == "main") {
      var item = document.createElement('div');
      item.setAttribute('data-bb-type','item');
      item.setAttribute('data-bb-title','my title');
      item.innerHTML = 'my description';
      item.setAttribute('data-bb-img','foo.png');

      document.getElementById('mylist').appendItem(item);

      $("#button").css("display", "block");
    }
  }
});<?php compat_code_end(); ?>

<p>The main problem here is that it's using <strong>document</strong> as the source to be manipulated. Since bbUI still hasn't appended the screen into the <strong>document</strong> it will give you an error. In order to correct this you should replace <strong>document</strong> with <strong>element</strong>, that is passed by the <strong>onscreenready</strong> event. If you have any jQuery code, just add <strong>element</strong> as a <strong>context</strong> argument as shown below in the corrected code:</p>

<?php compat_code_begin('js'); ?>bb.init({
  onscreenready: function (element, id) {
    if (id == "main") {
      var item = element.createElement('div');
      item.setAttribute('data-bb-type','item');
      item.setAttribute('data-bb-title','my title');
      item.innerHTML = 'my description';
      item.setAttribute('data-bb-img','foo.png');

      element.getElementById('mylist').appendItem(item);

      $("#button", element).css("display", "block");
    }
  }
});<?php compat_code_end(); ?>

<p>That's it! Now you know how to use the <strong>onscreenready</strong> and <strong>ondomready</strong> events to dynamically insert or modify your bbUI screen's. Any questions or suggestions just leave a comment and I'll reply as soon as possible. </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>

	<?php include_template('footer'); ?>
</body>
</html>
