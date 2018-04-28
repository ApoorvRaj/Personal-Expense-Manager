<?php
$servername = "localhost";
$uname = "root";
$pass = "";
$dbname = "users";
$errors = array();
$day1 = strtotime($_POST["date1"]);
$day1 = date('Y-m-d H:i:s', $day1); //now you can save in DB
$conn = mysqli_connect($servername, $uname, $pass, $dbname);
$push=$_POST['expense'];
if(!$conn)
{
	die('connection failed'.mysqli_error());
}
if($_POST['s1']=='1')
{
$result="INSERT INTO manage (Date,Category,Amount) VALUES('$day1','$_POST[expense]','$_POST[amount]')";
if(!mysqli_query($conn,$result))
{
	die('no record added'.mysqli_error());
}
else
echo "1 record added";
}
else
{
$result="select Category,sum(Amount) from manage where Date='$day1' group by(Category) order by(Category)";
$result=mysqli_query($conn,$result);
$data= array();
foreach($result as $row)
{
	$data[]=$row;
}
print json_encode($data);
}
mysqli_close($conn);
?>
