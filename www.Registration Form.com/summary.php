<?php

if(empty($_POST['name']) || empty($_POST['email'])){
    header("Location: register.php");
    exit();
}

$name=$_POST['name'];
$dob=$_POST['dob'];
$sex=$_POST['sex'];
$email=$_POST['email'];
$address=$_POST['address'];
$department=$_POST['department'];
$program=$_POST['program'];
$mobile=$_POST['mobile'];

$nameColor="";

if($sex=="Male"){
    $nameColor="blue";
}
elseif($sex=="Female"){
    $nameColor="red";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Summary</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">
<h2>Registration Summary</h2>

<table>

<tr>
<th>Name</th>
<td style="background:<?php echo $nameColor;?>; color:white;">
<?php echo htmlspecialchars($name); ?>
</td>
</tr>

<tr>
<th>Date of Birth</th>
<td><?php echo htmlspecialchars($dob); ?></td>
</tr>

<tr>
<th>Sex</th>
<td><?php echo htmlspecialchars($sex); ?></td>
</tr>

<tr>
<th>Email</th>
<td><?php echo htmlspecialchars($email); ?></td>
</tr>

<tr>
<th>Address</th>
<td><?php echo htmlspecialchars($address); ?></td>
</tr>

<tr>
<th>Department</th>
<td><?php echo htmlspecialchars($department); ?></td>
</tr>

<tr>
<th>Program</th>
<td><?php echo htmlspecialchars($program); ?></td>
</tr>

<tr>
<th>Mobile Number</th>
<td><?php echo htmlspecialchars($mobile); ?></td>
</tr>

</table>

<br>

<a href="register.php">
<button>Back</button>
</a>

</div>

</body>
</html>