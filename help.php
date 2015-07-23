<?php
session_start();
include('include_classes.php');
include('functions.php');

ini_set('display_errors',0);
error_reporting(E_ALL);

c_cookie::assist_log();


?>

<!DOCTYPE HTML>

<html>
<head>
	<title>Help</title>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<link rel="icon" href="images/franklin_logo.gif">

	<!-- Bootstrap -->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<link rel="stylesheet" type="text/css" href="css/styles.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">		
      	<img class="logo" src="images/daytime.png">
		<!-- <img class="beta" src="images/betterbeta.png"> -->
	  </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php">Login</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
  				<li role="presentation" class="active"><a data-toggle="tab" href="#home">Home</a></li>
 				<li role="presentation"><a data-toggle="tab" href="#instructions">Instructions</a></li>
 				<li role="presentation"><a data-toggle="tab" href="#about">About</a></li>
 				<li role="presentation"><a data-toggle="tab" href="#contact">Contact</a></li>
			</ul>
			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">
					<h1>Home</h1>

					<p>The FHS APP is a personalized announcement delivery system. The FHSAPP help page was created to assist users in utilizing the app to its full potential.</p>

					<p>Use the bar to the left to navigate to different help topics. </p>
					<ul>
						<li>Instructions provides assistance with the actual mechanics of using the front and back end of the app.</li> 
						<li>About Us provides a history of the FHSAPP creation process and an understanding of who the FHSAPP team is.</li>
						<li>For additional assistance, or those interested in being a part of the FHSAPP team, information is available under Contact.</li>
					</ul>
				</div>
				<div id="instructions" class="tab-pane fade">
					<h1>Instructions</h1>
						<ul>
						<li><a href="#teachers">For Teachers</a></li>
						<li><a href="#students">For Students</a></li>
						</ul>
						
						
				<h2 id="teachers">For Teachers</h2>
				<h3>Help video</h3>

				<p><iframe width="630" height="425" src="//www.youtube.com/embed/iRPp7ObMMc0" frameborder="0" allowfullscreen></iframe></p>

				<h3>Making an announcement</h3>
					<p><img src="images/instructions-home.png" alt="instructions-home"></p>

					<p>To make an announcement, click on the <strong>+</strong> or <strong>Add Announcement</strong> button in the top bar. The <strong>create</strong> screen will appear. Fields marked with a red asterisk are required to be filled for an announcement to be published.</p>
					
				<p><img src="images/Instructions-Create_announcement.png" alt="Instructions-Create_announcement"></p>
					
					<p>The <strong>Title</strong> is the short tagline that will appear in the non-expanded announcement. The <strong>Description</strong> is a longer explanation of an assignment or announcement. Writing a description is just like writing in a word document. If you need a picture in your announcement, add it with the image button on the right side of the buttons. </p>
					
					<p>The <strong>Starting Date</strong> is the first day you want an announcement to appear. If you want an announcement to appear from March 1st to March 5th, you would set the start date to 3/1/2014, using the pop-up calendar. </p>
					
					<p>The <strong>End Date</strong> function determines when the announcement will stop showing up on students' screens. Since the program removes the announcement one minute after midnight on the <strong>end date,</strong> YOU NEED TO SET THE END DATE ONE DAY FORWARD.</p>
					
					<p>For example: that announcement ending on March 5th would need to be set for 3/6/2014 with the pop up calendar. Remember this step, or your announcements will disappear early!</p>
					
					<p>In the right column, you can select the categories (your classes or clubs) that this announcement applies to. Students signed up to the selected categories will see the announcement on their App.</p>
					
					<p>Other information is optional, but may be helpful. Once you have completed the announcement to your satisfaction, click <strong>create announcement.</strong>  To abandon the announcement, click <strong>cancel.</strong></p>
					
				<h3>Editing announcements</h3>

				<p><img src="images/instructions-edit.png" alt="instructions-edit"></p>

					<p>In the <strong>Home</strong> page, you can view all your pending and active announcements. To make edits, simply click the <strong>edit</strong> button. Clicking <strong>edit</strong> will take you to the <strong>create</strong> page, except with the blank fields filled with that announcement's data. From there, you can make any changes to the announcement you wish. Click <strong>save announcement</strong> to save your changes and return to the home page. </p>
					
					<p>To delete an announcement permanently, click <strong>delete</strong>. <strong>THIS CANNOT BE UNDONE, SO BE ABSOLUTELY SURE BEFORE YOU DELETE AN ANNOUNCEMENT</strong></p>
					
				<h3>Password and account management</h3>

				<p><img src="images/instructions-gear.png" alt="instructions-gear" ></p>

					<p>If you are a new user, you should receive an e-mail with a username and password in it. This will be your first login, but you should change your password to something you will remember, that is more secure!</p>
					
					<p>Click on the gear icon in the header bar after you log in to go to the settings page. You can change your username, first name, last name, or e-mail by changing the existing fields and clicking <strong>save</strong>. Changing your password requires it to be typed twice into the empty password fields, and then clicking save. BE CAREFUL WHEN CHANGING YOUR PASSWORD. If a password is lost, only an FHSAPP admin can reset your password and restore access to your account!</p>
					
					<p>Large red letters will tell you when account information has been successfully saved. Once these display, it is safe to navigate to another screen.</p>

				<h3>Managing classes</h3>

					<p>In the settings page (which can be reached by clicking the gear icon), a list of eight possible classes is displayed. These are visible to students signing up for classes under your name, and are labeled with the period number. Simply enter class names for all classes being taught, and click save. If you need to change the names of these classes for any reason, such as changing classes from year to year, simply go to the settings page, change the name in the class field, and click save.</p>

				<h3>Adding clubs or sports</h3>
					<p>If you are the adviser for a club or a coach for a sport, your account will have club and sport permissions enabled. If they are not, please e-mail fhsapp.contact@gmail.com, and the error will be corrected.</p>
					
					<p>To add a club or sport, simply type the name of that club or sport in the box and click save. To add additional categories, click the <strong>add</strong> button, and type in a new name. To remove categories, click the blue <strong>X</strong>.</p>


				<h2 id="students">For Students</h2>

				<h3>Downloading the App</h3>
					
					<p>The FHS App is available on the iTunes Store, and can be found by searching "FHS App" or at this <a href="https://itunes.apple.com/us/app/fhs-app/id862181053?mt=8">link</a> .</p>
					
					<p>Alternatively, point your internet browser to <a href="http://fhsapp.com">fhsapp.com</a>. </p>

				<h3>Signing up for classes</h3>

					<p>Open the slider bar and click on <strong>settings</strong>. From there, open the <strong>classes</strong> tab. Find your teachers, which are in alphabetical order by last name. Clicking on the teacher's name opens their list of periods. To sign up for a class, simply check that class's checkbox. Do this for all eight periods.</p>
					
					<p>Clubs and sports are available for signup as well, but are organized by name rather than by adviser name.</p>
					
					<p>To unsubscribe from a club, simply uncheck it in settings.</p>

				<!--<h3>Managing settings</h3>-->

				<h3>Finding announcements</h3>

					<p>All users are automatically subscribed to the Daily Bulletin, which is the official Franklin High School announcements. Clicking on <strong>All of Daily Bulletin</strong> shows the full list of announcements, but selecting a subcategory in the slide out bar displays only that subset of announcements.</p>
					
					<p>All the announcements for your subscribed classes and clubs appear on the home screen ("Your Announcements"), but specific classes and clubs can be navigated to on the slide out bar.</p>

				<h3>Resources, Calendar, Getting Started</h3>

					<p>The resources page in the slide out menu has some helpful links for Franklin students. The Calendar page contains the official Franklin google calendar of events. The Getting Started page, which appears when you first log in, has some additional helpful information for app users. The feedback page is your way to send us questions, comments, or complaints.</p>
				</div>
				<div id="about" class="tab-pane fade">
					<h1>About</h1>
					<p>The FHS APP is the first announcement app for Franklin High School in Portland Oregon. This app is designed to help students receive personalized announcements for their classes, clubs, and sports.</p>

					<h3>Intuitive Interface</h3> <p>The FHS APP implements a cutting edge user interface so even the dumbest of freshmen can use it. The FHS APP is so easy to use! Just go to settings and click on your classes, clubs, and sports. Then swipe back and check Your Announcements!</p>

					<h3>Get The Latest Info</h3><p>Get ahead of the curve by subscribing to your teachers to receive the latest test and homework news!</p>

					<h3>Stimulate Your G.P.A</h3><p>Give your grade a boost by doing extra credit problems only found on the FHS APP!</p>

					<h3>Browse General Announcements</h3><p>Rifle through the daily announcements to get the latest college and school announcements you may have missed.</p>
				</div>
				<div id="contact" class="tab-pane fade">
					<h1>Contact Information</h1>
					<p>To get in contact with the FHS App team email us at <a href="mailto:fhsapp.contact@gmail.com">fhsapp.contact@gmail.com</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>