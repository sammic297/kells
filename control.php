<?php 
session_start();

//initializing variables
$departure="";
$arrival="";
$tdate="";
$seats="";
$email="";
$phone="";
$message="";
$errors=array();

//connect to the database
$book = mysqli_connect('localhost', 'root', '', 'kells');

//BOOKS USER
if (isset($_POST['book'])) {
	//receive all input values from the form
	$departure = mysqli_real_escape_string($book, $_POST['departure']);
	$arrival = mysqli_real_escape_string($book, $_POST['arrival']);
	$tdate = mysqli_real_escape_string($book, $_POST['tdate']);
	$seats = mysqli_real_escape_string($book, $_POST['seats']);
	$email = mysqli_real_escape_string($book, $_POST['email']);
	$phone = mysqli_real_escape_string($book, $_POST['phone']);
	$message = mysqli_real_escape_string($book, $_POST['message']);

	if (empty($departure)) { array_push($errors, "Enter a departure point"); }
	if (empty($arrival)) { array_push($errors, "Enter a arrival point"); }
	if (empty($tdate)) { array_push($errors, "Travel date is required"); }
	if (empty($phone)) { array_push($errors, "Phone Number is required"); }


	//Books passenger if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO bookings (departure, arrival, tdate, seats, email, phone, message)
				  VALUES ('$departure', '$arrival', '$tdate', '$seats', '$email', '$phone', '$message')";
		mysqli_query($book, $query);
		header('location: login.php');
	}
}