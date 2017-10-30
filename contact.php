<?php 
//	if(isset($_POST['Submit'])){
//		$firstName = $_POST['firstname'];
//		$lastName = Trim(stripslashes($_POST['lastname']));
//		$name = $firstName . $lastName;
//		$email = $_POST['email'];
//		$from = $email;
//		$message = $_POST['comments'];
//		$body = "From: " . $name;
//		$body .= "\nEmail: " . $email; 
//		$body .= "\nMessage: " . $message;
//		$to = "president.projectsmileucm@gmail.com";
//		$subject = "Contact Form Submission";
//		$mailheader = "From: " . $email . "\r\n";
//		if(mail($to, $subject, $body, $from)){
//			http_response_code(200);
//			echo "Thank you! Message sent.";	
//		};
//	}
?>

<?php	
	//only process POST requests
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//get form fields, remove whitespace
		$firstName = strip_tags(trim($_POST['firstname']));
		$lastName = strip_tags(trim($_POST['lastname']));
		$name = $firstName." ".$lastName;
		$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
		$message = trim($_POST['message']);	
		
		//check that data was sent to mailer.php
		if(empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			//set 400 (bad request) response code & exit
			http_responde_code(400);
			echo "Oops! There was a problem with your submission. Please complete the form and try again.";
			exit;	
		}
		
		
		//set recipient email
		$recipient = "president.projectsmileucm@gmail.com";
		
		//set email subject
		$subject = "New Contact from " . $name;
		
		//build message
		$body = "Name: " . $name . "\n";
		$body .= "Email: " . $email . "\n\n";
		$body .= "Message: \n" . $message . "\n";
		
		//build email header
		$header = "From: " . $name . " " .$email;
		
		//send email
		if(mail($recipient, $subject, $body, $header)) {
			//set 200 (okay) response code
			http_response_code(200);
			$success = true;
		}
		
	} else {
			//set 500 response code
			http_response_code(500);
			$success = false;
			//echo "Oops! Something went wrong and we couldn't send your message. Please try again.";
	}
	
?>


<!doctype html>
<html>
<head>
<!--Import Google Icon Font-->
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--Import materialize.css framework!-->
<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
<link href="css/main.css" rel="stylesheet" type="text/css">
<title>Thank You - Project Smile</title>
<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

<!--nav bar goes here-->
<nav class="blue darken-4">
	<div class="nav-wrapper">
		<!--Logo for desktop only-->
		<div id="logo-wrapper" class="hide-on-med-and-down"> 
			<a href="index.html" class="brand-logo" id="project-smile-logo">
				Project Smile
				<h6 id="uc-merced-logo">University of California, Merced</h6>
			</a> 
		</div>
		<!--Logo for tablet and smaller-->
		<a href="#!" class="brand-logo hide-on-large-only">Project Smile</a> 
		
		<!--Horizontal nav on desktop, hides for smaller displays and creates hamburger nav icon-->
		<a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons left-pad">menu</i>
		</a>
		<ul class="right hide-on-med-and-down">
			<li><a href="index.html">Home</a></li>
			<li><a href="about.html">About</a></li>
			<li><a href="officers.html">Officers</a></li>
			<li><a href="calendar.html">Calendar</a></li>
			<li><a href="contact.html">Contact</a></li>
		</ul>
		
		<!--side nav list created on smaller displays-->
		<ul class="side-nav" id="mobile-demo">
			<li class="logo">
				<img class="logo-img" src="images/tooth_logo.png" alt="Project Smile logo header">
				<h5 class="col s12 grey-text text-darken-4 center">Project Smile</h5>
				<h6 class="col s12 grey-text text-darken-4 center">At UC Merced</h6>
			</li>
			<li><div class="divider"></div></li>
			<li><a href="index.html">
				<i class="material-icons grey-text text-darken-3 left">home</i>Home</a></li>
			<li><a href="about.html">
				<i class="material-icons grey-text text-darken-3 left">info</i>About</a></li>
			<li><a href="officers.html">
				<i class="material-icons grey-text text-darken-3 left">people</i>Officers</a></li>
			<li><a href="calendar.html">
				<i class="material-icons grey-text text-darken-3 left">event</i>Calendar</a></li>
			<li><a href="contact.html">
				<i class="material-icons grey-text text-darken-3 left">email</i>Contact</a></li>
		</ul>
	</div>
</nav>


	<!--main content goes here-->
	<main>
		<!--Contact Page Heading-->
		<div class="section">
			<div class="row container pad-top-2">
				<div class="col s12 center">
					<img src="images/contact-page/contact-ic.png" alt="Project Smile Officers Heading Icon">
					<h3 class="no-marg-top">Contact Project Smile</h3>
				</div>
			</div>
		</div>
		
		<div class="section grey lighten-4">
			<div class="row container">
				<div class="col s12">
					<?php 
						if ($success) {
							echo "<h3>Thank You!</h3>
					<p>Thank you for contacting Project Smile. Your
					message was successfully sent.<br/>
					Please allow us 24-48 hours to respond to your
					message.</p>
					<p>Thanks,<br/>
					Project Smile<br/>
					University of California, Merced</p>";
						} else {
							echo "<h3>Oops!</h3>
					<p>Something went wrong when trying to send your message.<br/>
					Please go back and try again.</p>
					<p>Thanks,<br/>
					Project Smile<br/>
					University of California, Merced</p>";	
						}
					 ?>
				</div>
			</div>
		</div>
		
	</main>


<!-- footer -->
<footer class="page-footer blue darken-4">
	<div class="container">
		<div class="row">
	  		<div class="col l5 m5 s12">
				<h5 class="no-marg-no-pad white-text">Project Smile</h5>
				<h6 class="no-marg-no-pad grey-text text-lighten-5">At University of CA, Merced</h6>
				<p class="grey-text text-lighten-5">
					Thank you for visiting Project Smile's website! Please feel free to contact us if you share a
					passion of oral hygiene with us and are interested in joining Project Smile. Also please feel
					free to contact our officers for information regarding events, services, or inquiries. 
				</p>
	  		</div>
	  		<div class="col l5 offset-l2 m4 offset-m3 s12">
				<h5 class="no-marg-no-pad white-text">Links</h5>
					<ul class="col l6 s12 footer-ul">
						<li><a class="grey-text text-lighten-2" href="calendar.html">Calendar</a></li>
						<li><a class="grey-text text-lighten-2" href="officers.html">Officers</a></li>
						<li><a class="grey-text text-lighten-2" href="http://globaldentalrelief.org/">Global Dental Relief</a></li>
					</ul>
					<ul class="col l6 s12 footer-ul">
				  		<li><a class="grey-text text-lighten-2" href="about.html">About</a></li>
				  		<li><a class="grey-text text-lighten-2" href="signup.html">Join</a></li>
						<li><a class="grey-text text-lighten-2" href="contact.html">Contact</a></li>
					</ul>
	  		</div>
		</div><!--end of row -->
  	</div><!--end container-->
	
  	<div class="footer-copyright">
		<div class="container">
			&copy; 2016 Project Smile at UC Merced
			<p class="no-marg-no-pad right">Website designed by: 
				<a class="grey-text text-lighten-4" href="mailto:leelandmiller@gmail.com?Subject=Web%20Design%20Inquiry"
				target="_blank">Leeland Miller</a>
			</p>
		</div>
  	</div>
</footer>

	<!--Import jQuery before materialize.js--> 
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script> 
	<script type="text/javascript" src="js/materialize.min.js"></script> 
	
	
	<script>
		$(document).ready(function(){
			$('.parallax').parallax();
			$(".button-collapse").sideNav();
			$('select').material_select();
		});
	</script>
</body>
</html>
