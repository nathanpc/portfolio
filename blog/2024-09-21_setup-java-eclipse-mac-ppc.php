<?php
$post = array(
	'title' => 'Setting up a Java development environment on Mac OS X 10.5 for PowerPC'
);
?>

<p>Recently I got into my head that I wanted to play around with some retro
Java development and relive some of my earliest programming memories for
nostalgia reasons. Although the appropriate setup for what I had back in the day
was JDK 1.5 running on Windows XP and Netbeans, I decided to go for quite a
different, but extremely nostalgic setup of Java 1.5.0 on Mac OS X 10.5 Leopard
with Eclipse Juno, mostly because I wanted to spend more time with my Power Mac
G5, but also because I was unable to download older versions of Netbeans due to
them <a href="https://netbeans.apache.org/front/main/download/archive/#_pre_apache_netbeans_versions">
not being properly archived</a>, which is extremely sad.</p>

<p>The first step towards the goal of a proper Java development experience on
this platform is to ensure the bundled version of Java from Apple is completely
up-to-date, since we want to have an authentic experience we will be using the
bundled Java and not OpenJDK. You can ensure you're on the latest version by
checking for software updates using the Software Update tool on Mac OS X 10.5.
If there are no updates available you're set!</p>

<?= compat_image('./up-to-date.png',
	'A completely up-to-date installation of Mac OS X 10.5') ?>

<p>After that you'll need a period correct IDE to develop on. I choose to use
Eclipse Juno 3.8.2 since it was the last version of Eclipse from this era and
because Netbeans wasn't available, otherwise I would've used it. You can still
download older Eclipse versions from their
<a href="https://archive.eclipse.org/eclipse/downloads/">project archives</a>
(<a href="https://archive.eclipse.org/eclipse/downloads/drops/R-3.8.2-201301310800/">
direct link</a> to version 3.8.2). Remember to download the Eclipse SDK archive,
which comes with everything for Java development, not just the Eclipse
Platform.</p>

<p>After you have Eclipse 3.8.2 downloaded you should extract it and copy its
folder to <code>/Applications</code> where it'll live. After the initial
workspace setup you must select the appropriate JRE for it to use, at least in
my case it wasn't capable of finding it automatically. To do this you must go to
<code>Eclipse &gt; Preferences...</code>, in the preferences window navigate to
<code>Java &gt; Installed JREs</code> and add a new JRE. For the type ensure you
select <code>MacOS X VM</code> to signal that you are using the built-in JRE
from Apple. Now for the JRE home you should select the
<code>/System/Library/Frameworks/JavaVM.framework/Versions/1.5.0/Home</code>
directory, which is where Apple stores their JRE on OS X 10.5. Your window
should look more or less like this after Eclipse finds all the system libraries
included:</p>

<?= compat_image('./jre-definition.png',
	'JRE Definition for Java 1.5.0 on Eclipse 3.8.2') ?>

<p>Now you should have everything to start developing Java apps on Mac OS X,
but if you want to build graphical applications with ease it's always
recommended to install <a href="https://eclipse.dev/windowbuilder/">Eclipse's
WindowBuilder</a>. Since we are unable to automatically install it through their
online update sitedue to their insistance in using HTTPS we'll have to download
update archives for it and all of its dependencies. In my case I went with
<a href="https://archive.eclipse.org/windowbuilder/WB/release/R201406251200/">
WindowBuilder 1.7.0</a>, although while trying to install WindowBuilder I was
unable to proceed because of a missing dependency:</p>

<?php compat_code_begin(); ?>Cannot complete the install because one or more required items could not be found.
  Software being installed: WindowBuilder XML Core (requires Eclipse WTP/WST) 1.7.0.r37x201405021458 (org.eclipse.wb.core.xml.feature.feature.group 1.7.0.r37x201405021458)
  Missing requirement: WindowBuilder Core for XML GUI's 1.7.0.r37x201405021458 (org.eclipse.wb.core.xml 1.7.0.r37x201405021458) requires 'bundle org.eclipse.wst.sse.core 0.0.0' but it could not be found
  Cannot satisfy dependency:
    From: WindowBuilder Databinding XML Core 1.7.0.r37x201405021458 (org.eclipse.wb.core.databinding.xml 1.7.0.r37x201405021458)
    To: bundle org.eclipse.wb.core.xml 0.0.0
  Cannot satisfy dependency:
    From: WindowBuilder XML Core (requires Eclipse WTP/WST) 1.7.0.r37x201405021458 (org.eclipse.wb.core.xml.feature.feature.group 1.7.0.r37x201405021458)
    To: org.eclipse.wb.core.databinding.xml [1.7.0.r37x201405021458]<?php compat_code_end(); ?>

<p>The problem is that when I went to get a copy of the
<a href="https://eclipse.dev/webtools/">Eclipse Web Tools Platform</a>, in my
case the era appropriate
<a href="https://archive.eclipse.org/webtools/downloads/drops/R3.5/R3.5.2/R-3.5.2-20140217150812/">
version 3.5.2</a> I realized that their entire archive was missing the actual
releases, only the checksum files are available, so I guess someone decided to
delete their entire release archive to save space. This is a major problem and
unless the archives resurface there's no way to install the WTP on older
versions of Eclipse.</p>

<p>Although a bit disappointed, I still have a fully functioning retro Java
development environment to play around and to write some amazing retro
applications, or just port Java software to older systems. I wish someone could
find a way of providing a lasting archive of Eclipse's entire back catalog to
keep these older systems alive.</p>
