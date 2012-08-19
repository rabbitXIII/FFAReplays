<!doctype html>
<html lang="en">
<head>
	<title>Meow's W3 Replay Loveshack</title>
	<meta name="description" content="This website was created to allow upload and distribution of warcraft 3 ffa replays.">
	<link rel="stylesheet" href="<?php echo "$base/$css"?>" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo "$base/"?>print.css" media="print" />
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script> 
<script type="text/javascript" src="js/equalcolumns.js"></script> 
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>

	<header>
		<h1>Meow's W3 Replay Loveshack</h1>
	</header>
	<nav>
		<ul>
			<li class="selected"><a href="#">Home</a></li>
			<li><?=anchor("/uploader", "Upload")?></li>
			<li><?php echo anchor("http://ffamasters.com/league/index.php", "Forums")?></li>
			<li><a href="#">Azeroth Ladder</a></li>
			<li><?php echo anchor("/auth/$loginout/", ucfirst($loginout)); ?></li>
			<li><a href="#">About</a></li>
		</ul>
	</nav>
	<section id="intro">
		<header>
			<h2>Your pub for Warcraft 3 replays.</h2>
		</header>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut.</p>
		<img src="<?php echo "$base/images"?>/brew.jpg" alt="lime" />
	</section>
	<div id="upload">
		<?php 
			#echo form_open_multipart('/welcome');
			#echo form_upload('userfile');
			#echo form_submit('upload', 'Submit Replay');
			#echo form_close();
		?>
	</div>
	
	<section id="content">
				<ul class="column">
				    <!--eqblock-->
				    <li>
				        <section class="block">
									<a href="#"><img src="<?php echo "$base/images"?>/1-thumb.jpg" alt=""  /></a> 
										<h2><a href="#">Nerdrage 101</a></h2> 
										<p>Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Curabitur in odio augue. Morbi congue auctor interdum. Phasellus sit amet metus justo. </p> 
				        </section>
				    </li>

				    <!--eqblock-->
				    <li>
				        <section class="block">
									<a href="#"><img src="<?php echo "$base/images"?>/2-thumb.jpg" alt=""  /></a> 
										<h2><a href="#">All About Mushrooms</a></h2> 
										<p>Morbi congue auctor interdum. Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Curabitur in odio augue. Phasellus sit amet metus justo. </p> 
				        </section>
				    </li>

				    <!--eqblock-->
				    <li>
				        <section class="block">
									<a href="#"><img src="<?php echo "$base/images"?>/3-thumb.jpg" alt=""  /></a> 
										<h2><a href="#">Compatible Heroes</a></h2> 
										<p>Phasellus sit amet metus justo. Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Curabitur in odio augue. Morbi congue auctor. </p> 
				        </section>
				    </li>

				    <!--eqblock-->
				    <li>
				        <section class="block">
									<a href="#"><img src="<?php echo "$base/images"?>/4-thumb.jpg" alt=""  /></a> 
										<h2><a href="#">Lich King's Diary</a></h2> 
										<p>Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Morbi congue auctor interdum. Curabitur in odio augue. Phasellus sit amet metus justo. </p> 
				        </section>
				    </li>

				    <!--eqblock-->
				    <li>
				        <section class="block">
									<a href="#"><img src="<?php echo "$base/images"?>/5-thumb.jpg" alt=""  /></a> 
										<h2><a href="#">Tools of the Trade</a></h2> 
										<p>Curabitur in odio augue. Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Morbi congue auctor interdum. Phasellus sit amet metus justo. </p> 
				        </section>
				    </li>

				    <!--eqblock-->
				    <li>
				        <section class="block">
									<a href="#"><img src="<?php echo "$base/images"?>/6-thumb.jpg" alt=""  /></a> 
										<h2><a href="#">The Art of Trolling</a></h2> 
										<p>Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Phasellus sit amet metus justo. Curabitur in odio augue. Morbi congue auctor interdum.  </p> 
				        </section>
				    </li>

				    <!--eqblock-->
				    <li>
				    <li>
				        <section class="block">
									<a href="#"><img src="<?php echo "$base/images"?>/7-thumb.jpg" alt=""  /></a> 
										<h2><a href="#">Playing with Style</a></h2> 
										<p>Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Curabitur in odio augue. Morbi congue auctor interdum. Phasellus sit amet metus justo. </p> 
				        </section>
				    </li>
				</ul>
		</section>
		
	<footer>
    <section>
    <h3>Left Stuff</h3>
    <p>Left aligned text here. Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Curabitur in odio augue. Morbi congue auctor interdum. Phasellus sit amet metus justo.</p>
    <p>Next line here</p>
    </section>
    
    <section>
    <h3>Center Stuff</h3>
    <p>Center Text here. Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Curabitur in odio augue. Morbi congue auctor interdum. Phasellus sit amet metus justo.</p>
    <p>Next line here</p>
    </section>
    
    <section>
    <h3>Right Stuff</h3>
    <p>&copy; 2010 <a href="#" title="your site name">meow.com</a> All rights reserved.</p>
    <p>Center Text here. Proin metus odio, ultricies eu pharetra dictum, laoreet id odio. Curabitur in odio augue. Morbi congue auctor interdum. Phasellus sit amet metus justo.</p>
    </section>

	</footer>
<!-- Free template created by http://freehtml5templates.com -->
</body>
</html>
