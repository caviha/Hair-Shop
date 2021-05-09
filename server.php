<?php 
session_start();

//int var
$First_name= "";
$Last_name= "";
$Email= "";
$category= "";
$Text= "";
$category1= "";
$error    = array();

//cont
$db = mysql_connect(
	'localhost',
	'root',
	'',
	'hairproduct'
	);

	//keyin details
if (isset($_POST['hair'])) {
	
	//get details
	$First_name = mysql_real_escape_string($db, $_POST['First_name']);
	$Last_name = mysql_real_escape_string($db, $_POST['Last_name']);
	$Email = mysql_real_escape_string($db, $_POST['Email']);
	$category = mysql_real_escape_string($db, $_POST['category']);
	$Text = mysql_real_escape_string($db, $_POST['Text']);
	$category1 = mysql_real_escape_string($db, $_POST['category1']);
}
//checking 
if (empty($First_name)) {
	arrat_push($errors, "First name is required");
}
if (empty($Last_name)) {
	arrat_push($errors, "Last name is required");
}
if (empty($Email)) {
	arrat_push($errors, "Email is required");
}
if (empty($category)) {
	arrat_push($errors, "selection required ");
}
if (empty($Text)) {
	arrat_push($errors, "selection required ");
}
if (empty($category1)) {
	arrat_push($errors, "selection required ");
}
//cgecking database
$user_check_query = "SELECT * FROM  users WHERE username='$username' or email= $email'
LIMIT 1";
$results = mysql_query($db, $user_check_query);
$user = mysql_fetch_assoc($results);
if ($user) {
	if ($user['username'] ===$username) {
		array_push($error, "username already exists")
		}
if ($user['email'] === $email) {
	array_push($error, "email already exists")
}
}
//if no error
if (count($error) == 0) {
	$password = md5($password_1)//securing
$query = "INSERT INTO users(username, email, password)
VALUES('$username', '$email', '$password') ";
mysql_query($db, $query);
$_SESSION ['username'] = "YOU ARE LOGGED IN"
header('location:index.php');
}

}
//login user
if (isset($_POST['login_user'])) {
	$username =mysql_escape_string($db, $_POST['username']);
	$password =mysql_escape_string($db, $_POST['password']);

if (empty($username)) {
	arrat_push($errors, "username is required");
	if (empty($password)) {
	arrat_push($errors, "password is required");
}
if (count($errors) == 0) {
$password=md5($password);
$query = "SELECT * FROM users WHERE username= '$username' AND password='$password'";
$results= mysql_query($db , $query);
if (mysql_num_rows($results) ==1) {
	$_SESSION['username'] = $username;
	$_SESSION['success'] = "you are now logged in";
	header('location:index.php');

}
else{
	array_push($errors, "wrong username/password combination");
  }
 }
}
	 ?>