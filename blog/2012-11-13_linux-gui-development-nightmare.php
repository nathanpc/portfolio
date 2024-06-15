<?php
$post = array(
	'title' => 'The Linux GUI Development Nightmare'
);
?>

<p>For about 2 weeks I've been having some fun with Linux development, mainly using Ruby to build command-line applications. My decisions, to create command-line applications using Ruby instead of GUI applications, were made because of a simple factor: GUI development for Linux is a nightmare, since there isn't at least one good GUI prototyping tool available to help you design your UI without having to do everything manually.</p>

<p>First I tried <a href="http://glade.gnome.org/">Glade</a> which is just a nightmare. It's extremely complicated to deal with and you have no clue about which control you should use or how to arrange things, and most importantly there's not a lot of tutorials and documentation for new users to learn how to use it, and how to integrate with other languages.</p>

<p>Then I was told that <a href="http://qt.digia.com/Product/Developer-Tools/">Qt Creator</a> was an awesome thing, so I decided to give it a try. I've created a new test project and selected the <a href="http://doc.qt.digia.com/qt/qtquick.html">Qt Quick</a> option so I could use <a href="http://en.wikipedia.org/wiki/QML">QML</a>, which is a lot better for a developer with Javascript background like me. One of the things that made me like this was the amount of good documentation and tutorials.</p>

<p>When I started playing with the Designer one of the first things that I noticed was the lack of simple controls like Buttons, this was pretty strange and I thought I haven't installed all the things needed, but when I searched for it <a href="http://doc.qt.digia.com/qt/gettingstartedqml.html#basic-component-a-button">I got this tutorial from Qt itself</a>, which explains how to create a button in QML (from scratch!!). QML is one of the most awesome things I ever seen to build the GUI logic, it's simple and flexible, the problem is that there isn't any kind of controls to create real world desktop applications with it.</p>

<p>After that I took a look at <a href="http://www.wxwidgets.org/">wxWidgets</a>, which lacks good documentation and a decent GUI designer. Then after all this horrible nightmare I thought about creating all my UIs using HTML5 and wrapping everything around a GTK WebKit window, but I don't think this is a good approach since my apps would look like an alien to the system.</p>

<p>Where are the <a href="http://en.wikipedia.org/wiki/Embarcadero_Delphi">Delphi</a>s of modern computing? I remember how easy it was to design UIs using Delphi and with a right-click on the control you could easily attach an event to it's logic. It's this kind of IDE that I'm expecting, one that focus on the fact that you don't need to struggle to create a UI, but instead that you should be able to create the UI fast and easily enough, so you can focus on the most important thing that is your application logic.</p>

<p>Linux is a awesome OS, I've been using it since 2007, and it needs/deserves better tools to create awesome GUI applications, this is one of the reasons that developers aren't porting their apps to Linux. On Mac OS X we have the awesome Xcode that includes a incredibly awesome GUI designer, and on the Windows side we have Visual Studio with a designer that is the best one in my opinion, since it's easy, flexible, and powerful. Isn't this the perfect time for a great Linux GUI designer? </p>

<p style="font-size: 0.8em">
	This article was imported from <a href="http://currentflow.net/">my old blog
	</a>. Some things may be broken.
</p>
