<?php

require "helpers/helper-functions.php";

session_start();

$email = trim($_POST['email'] ?? '');
$rawPassword = $_POST['password'] ?? '';
$agree = isset($_POST['agree']);

if (
    empty($email) ||
    empty($rawPassword) ||
    !$agree
) {
    header("Location: step-3.php");
    exit();
}

// Protect the password using password_hash() (bcrypt by default)
$hashedPassword = password_hash($rawPassword, PASSWORD_DEFAULT);

$_SESSION['email'] = $email;
$_SESSION['password'] = $hashedPassword;
$_SESSION['agree'] = 'yes';

dump_session();

// Format birthdate to "June 15, 2001" style
$formattedBirthdate = date("F j, Y", strtotime($_SESSION['birthdate']));

// Compute age from birthdate
$birthDateObj = new DateTime($_SESSION['birthdate']);
$today = new DateTime('today');
$age = $birthDateObj->diff($today)->y;

// Build the final display data (don't mutate the raw session values used above)
$form_data = $_SESSION;
$form_data['birthdate'] = $formattedBirthdate;
$form_data['age'] = $age;

session_destroy();
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />
</head>
<body>

<section class="p-section--hero">
  <div class="row--50-50-on-large">
    <div class="col">
      <div class="p-section--shallow">
        <h1>
          Thank You Page
        </h1>
      </div>
      <div class="p-section--shallow">

        <table aria-label="Session Data">
            <thead>
                <tr>
                    <th></th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($form_data as $key => $val):
            ?>
                <tr>
                    <th><?php echo htmlspecialchars($key); ?></th>
                    <td>
                      <?php echo htmlspecialchars($val); ?>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>

      </div>
    </div>
  </div>
</section>

</body>
</html>