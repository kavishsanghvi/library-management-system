<?php
include 'dbinfo.php'; 
?>  
<?php
//always start the session before anything else!!!!!! 
session_start(); 
//connect to the db 

$link = mysqli_connect($host,$user,$pass) or die( "Unable to connect");
mysqli_select_db($link, $database) or die( "Unable to select database");
//Our SQL Query
$sql_query1 = "Select SubName, checkoutnum From (Select Month(IssueDate) AS month, SubName, Count(IssueID) AS checkoutnum From book AS B, issue AS I
	Where B.ISBN = I.ISBN AND (Month(IssueDate) = 2 OR Month(IssueDate) = 1) AND ExtenDate IS NOT NULL
	Group by month, SubName) AS V Where month = 1 Order by checkoutnum DESC LIMIT 3";
//Run our sql query
$result1 = mysqli_query ($link, $sql_query1)  or die(mysqli_error($link));	
if($result1 == false)
{
	echo 'The query by ISBN failed.';
	exit();
}
//Our SQL Query
$sql_query2 = "Select SubName, checkoutnum From (Select Month(IssueDate) AS month, SubName, Count(IssueID) AS checkoutnum From book AS B, issue AS I
	Where B.ISBN = I.ISBN AND (Month(IssueDate) = 2 OR Month(IssueDate) = 1) AND ExtenDate IS NOT NULL
	Group by month, SubName) AS V Where month = 2 Order by checkoutnum DESC LIMIT 3";
//Run our sql query
$result2 = mysqli_query ($link, $sql_query2)  or die(mysqli_error($link));	
if($result2 == false)
{
	echo 'The query by ISBN failed.';
	exit();
}
?>
<html>
 <head>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
<body>
<h1>Popular Subject Report</h1>
<form action="AdminSummary.php" method="post">
<table border="1" style="width:100%">
  <tr>
    <th>Month</th>
    <th>Top Subject</th>
    <th>#chechouts</th>
  </tr>
 <?php while($row1 = mysqli_fetch_array($result1)){ 
	  
	$SubName = $row1['SubName'];
	$checkoutnum = $row1['checkoutnum'];
  ?>
  <tr>
    <td>January</td>
    <td><?php echo $SubName; ?></td>
    <td><?php echo $checkoutnum; ?></td>
  </tr>
<?php
}
?>
<?php while($row2 = mysqli_fetch_array($result2)){ 
	  
	$SubName = $row2['SubName'];
	$checkoutnum = $row2['checkoutnum'];
  ?>
  <tr>
    <td>February</td>
    <td><?php echo $SubName; ?></td>
    <td><?php echo $checkoutnum; ?></td>
  </tr>
<?php
}
?>
</table>
<input type="submit" value="Back"/>
</form>

</body>
</html>