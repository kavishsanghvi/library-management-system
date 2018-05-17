<?php
include 'dbinfo.php'; 
?>  

<?php
session_start(); 
$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");

if(isset($_POST['firstname']) and isset($_POST['lastname']) and isset($_POST['email']))  {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$name = "$firstname $lastname";
	$email = $_POST['email'];
	$DOB = $_POST['DOB'];
	$address = $_POST['address'];
	$gender = $_POST['gender'];
	$isfaculty = $_POST['isfaculty'];
	
	$username = $_SESSION['username'];
	
	if($isfaculty == "1") {
		$dept = $_POST['dept'];
	} else {
		$dept = null;
	}

	$insertStatement = "INSERT INTO student_faculty (Username, Name, DOB, Email, Gender, Address,
	IsFaculty, Dept) VALUES ('$username', '$name', '$DOB', '$email', '$gender', '$address', '$isfaculty',
	'$dept')";
	$result = mysqli_query ($link, $insertStatement)  or die(mysqli_error($link)); 
	if($result == false) {
		echo 'The query failed.';
		exit();
	} else {
		header('Location: Login.php');
	}
} 


?>

<html>
 <head>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
<body>
<h1>Create Profile</h1>

<form action="" method="post">
<table>
<tr>
    <td>First Name</td>
    <td><input type="text" name="firstname" required/></td>
</tr>
<tr>
    <td>Last Name</td>
    <td><input type="text" name="lastname" required/></td>
</tr>

<tr>
    <td>Date of Birth</td>
    <td><input type="date" name="DOB"/></td>
</tr>

<tr>
    <td>Email</td>
    <td><input type="email" name="email" required/></td>
</tr>

<tr>
    <td>Address</td>
    <td><textarea name="address" rows="5" cols="30"></textarea></td>
</tr>

</table>


<tr>
    <td>Gender</td>

<tr><td>
<select name="gender">
  <option value="M">male</option>
  <option value="F">female</option>
</select>
</td>
</tr>
<tr>
 <td>Are you a faculty?</td>

<td>
<select name="isfaculty">
  <option value="1">Yes</option>
  <option value="0">No</option>
</select>
</td>
</tr>


<tr>
    <td>Associate Department</td>

<td>
<select name="dept">
<option value="College of Computing">Computer Science</option>
  <option value="School of Electrical & Computer Engineering">Electrical Engineering</option>
  <option value="School of Mechanical Engineering">Mechanical Engineering</option>
</select>
</td></tr>
</table>


<input type="submit" value="submit"/>
</form>
</body>
</html>