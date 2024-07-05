<?php
$post = array(
	'title' => 'Revisiting an Old Project: MintyCharger'
);
?>

<p>
	Back in May of 2015, a bit less than 6 years ago, I realized that there
	weren't any good and practical charger for PP3 batteries (commonly known as
	9V batteries), all of the products on the market are either
	<a href="https://www.triontechg.com/index.php?main_page=product_info&products_id=127563">
	those horrible wall chargers</a> straight from the cheapest Chinese
	factories, <a href="https://www.amazon.com/Tenergy-Charger-Rechargeable-Batteries-Detector/dp/B078NMX96J">
	more up-market models</a> that either assumes the type of NiMH battery
	you'll insert or just try to recharge them to the highest voltage possible
	with a lot of current limiting, or
	<a href="https://www.skyrc.com/iMAX_B6_Charger">professional chargers</a>
	aimed at the hobby market. None of these solutions worked for me. They
	ranged from "I would never trust to leave this charging while I sleep" to
	"that's way too much hassle", so I've decided that I could do better.
</p>

<p>
	The first problem that we have to overcome is the fact that there are way
	too many different "9V" rechargeable batteries on the market. They all look
	exactly the same (of course), but their voltages greatly differ. Most of
	them are of the NiMH variety, but more recently lithium alternatives have
	come to market, although I haven't had the chance to buy one to try out yet,
	I still prefer my good old NiMHs. So let's look at what's out on the market
	right now:
</p>

<ul>
	<li>
		<b>NiMH 7.2V</b> (6 NiMH cells in series): These are quite old, and very 
		are these days. I guess it was the best way to get a relatively high
		capacity battery for more demanding applications back when they were
		introduced, but this came at the cost of having a very low nominal
		voltage, although most 9V appliances wouldn't have any problems with
		this.
	</li>
	<li>
		<b>Li-Ion 7.4V</b> (2 Li-Ion cells in series): The latest and probably
		the last version we'll see of the 9V battery, sporting an amazing
		capacity thanks to that lithium magic, but suffers from a low nominal
		voltage, which as discussed previously might not be a big problem after
		all. The only issue I have with these is that I still don't trust
		lithium to be left unattended discharging away in a device that might
		take the cells to quite low levels. NiMH cells are a lot easier to
		"heal" after they have been abused or neglected.
	</li>
	<li>
		<b>NiMH 8.4V</b> (7 NiMH cells in series): The most popular type of
		rechargeable 9V battery. These strike a good balance between nominal
		voltage and capacity and are my preferred choice. Usually, if a battery
		isn't labeled it's almost a given that it's an 8.4V model.
	</li>
	<li>
		<b>NiMH 9.6V</b> (8 NiMH cells in series): If you need a pretty high
		nominal voltage and don't care a lot about capacity this type is the way
		to go, just be mindful that most 9V hardware will gladly over-discharge
		them and ruin your day, so always keep an eye on their voltage from time
		to time.
	</li>
</ul>

<p>
	As you can clearly see there are quite a lot of battery types out there (and
	some of them aren't even marked!), so our charger must be able to handle
	them all, preferably without trying to be <s>dumb</s> smart and detecting
	the battery voltage. The user should be able to manually select the type of
	battery that they are inserting, but the software of the charger can also
	apply the <a href="https://www.maximintegrated.com/en/design/technical-documents/app-notes/4/4496.html">
	classic dV/dt algorithm</a> to determine when to terminate the charge if the
	user is unsure about the type of battery they got.
</p>

<p>
	Since back then I just wanted to make something quick and only for me, I've
	designed a simple PIC12F683-based charger with a basic buffered op-amp
	linear CV/CC voltage regulator that fits inside an
	<a href="https://en.wikipedia.org/wiki/Altoids#Tins">Altoids tin</a>
	together with the battery that it was charging. This was a pretty neat
	solution, it would have a nice enclosure, I could have multiple charging a
	bunch of my batteries at the same time, and was very easy to write the code
	for. This was the schematic and board that I came up with:
</p>

<?= blog_image('prototype-schematic.png', 'First Concept Schematic', [], [
	'caption' => true
]) ?>

<p>
	If you want to know more the <a href="https://github.com/nathanpc/MintyCharger">
	GitHub repository</a> is still up, but as you can see it's a pretty simple
	board, and unfortunately due to size limitations it only was able to charge
	8.4V and 9.6V batteries, which were most of my batteries back then, the
	charging current adjustment was manual with a potentiometer, and it required
	15V to work. This was far from optimal, but I was in a hurry and it would
	perfectly fit my needs back then. Unfortunately because of the rise of the
	USD value and my lack of interest in the project I've never manufactured
	this board, and just continued charging my batteries with my lab power
	supply.
</p>

<?= blog_image('prototype-pcb.png', 'First Concept PCB Layout', [], [
	'caption' => true
]) ?>

<p>
	Last year, while I was developing the <a href="https://innoveworkshop.com/project/bipolary">
	Bipolary project</a>, I was reminded of this long-forgotten project and
	decided to revisit it, use the knowledge that I've accumulated in the last 6
	years, and redesign it completely from the ground up! Here are some of the
	features that I intend to implement in this new version:
</p>

<ul>
	<li>
		<b>5V USB power</b>: Wall warts no longer an option, these days USB is
		the standard power outlet for almost everything. This also means I'll
		have to use a switch-mode converter.
	</li>
	<li>
		<b>Capable of charging every single 9V battery out there</b>: If I'm
		going to do this right, I'm going to support everything, even the
		lithium ones.
	</li>
	<li>
		<b>Neat design</b>: Since I plan on selling these they must have a nice
		design and be easy to use.
	</li>
	<li>
		<b>Refresh batteries</b>: Since these batteries usually live quite a
		hard life, and are constantly over-discharged, I think having a way to
		automatically try to bring them back to life is very important.
	</li>
</ul>

<p>
	These were my goals when I've designed the circuit of this new version.
	Here's a sneak peek:
</p>

<?= blog_image_gallery(array(
	array('loc' => "professional-pcb.jpg", 'alt' => "Manufactured PCB"),
	array('loc' => "homemade-pcb.jpg", 'alt' => "Homemade Prototypes"),
	array('loc' => "board-eagle.png", 'alt' => "PCB Layout")
)); ?>

<p>
	Due to a whole bunch of reasons I'm only coming around to work on this
	project now, but I promise I'll try my best to finish it quickly this time.
	I hope to post updates on it here pretty soon!
</p>
