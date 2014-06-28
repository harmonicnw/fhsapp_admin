<?php
	$email = "dustindiep0@gmail.com";
	$grade = $_POST['grade'];
	$feedback = $_POST['feedback'];
	$e_subject = "Feedback";
	$e_content = "Grade: $grade\n\nFeedback: $feedback";
	$mail = mail($email, $e_subject, $e_content);
?>

<!DOCTYPE html>

<head>
	<title>Thank You</title>
	<style type="text/css">
	@font-face {
		font-family: MyriadPro;
		src: url(fonts/MyriadPro-Regular.eot);
	}
	
	body {
		font-family: "MyriadPro", Helvetica, Arial, Lucieda Grande, Sans-Serif;
		font-size: 16px;
		margin: 0;
		padding: 0 1em;
		background: white;
	}
	</style>
</head>

<body>
	<div>
		<p>Your feedback has been recorded. Thank you.</p>
	</div>
</body>