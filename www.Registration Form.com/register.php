<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<img src="auflogo.png" width="120"><br>

<h2>Student Registration Form</h2>

<form action="summary.php" method="POST">

<label>Name *</label>
<input type="text" name="name" required>

<label>Date of Birth</label>
<input type="date" name="dob">

<label>Sex</label>

<div class="radio">
<input type="radio" name="sex" value="Male"> Male
<input type="radio" name="sex" value="Female"> Female
</div>

<label>Email *</label>
<input type="email" name="email" required>

<label>Address</label>
<textarea name="address"></textarea>

<label>College Department</label>

<select name="department">
<option value="">Select Department</option>
<option>College of Computing Studies</option>
<option>College of Engineering</option>
<option>College of Business</option>
<option>College of Nursing</option>
<option>College of Education</option>
</select>

<label>Program</label>
<input type="text" name="program">

<label>Mobile Number</label>
<input type="text" name="mobile">

<br><br>

<input type="reset" value="Reset">
<input type="submit" value="Submit">

</form>

</div>

</body>
</html>