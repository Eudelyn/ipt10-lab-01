<?php

function get_registrants_data()
{
    $csvPath = __DIR__ . '/registration.csv';
    $data = [];

    if (file_exists($csvPath)) {
        $handle = fopen($csvPath, 'r');
        if ($handle !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                if (!empty($row) && count($row) >= 8) {
                    $data[] = $row;
                }
            }
            fclose($handle);
        }
    }

    return $data;
}

$registrants = get_registrants_data();

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
  <div class="p-section--shallow">
    <h1>Registrants</h1>
    <p>Total registrants: <strong><?php echo count($registrants); ?></strong></p>
  </div>

  <table aria-label="Registrants">
    <thead>
        <tr>
            <th>Complete Name</th>
            <th>Birthday</th>
            <th>Age</th>
            <th>Contact Number</th>
            <th>Sex</th>
            <th>Program</th>
            <th>Complete Address</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($registrants)): ?>
        <tr>
            <td colspan="8">No registrants yet.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($registrants as $record): ?>
            <tr>
                <td><?php echo htmlspecialchars($record[0]); ?></td>
                <td><?php echo htmlspecialchars($record[1]); ?></td>
                <td><?php echo htmlspecialchars($record[2]); ?></td>
                <td><?php echo htmlspecialchars($record[3]); ?></td>
                <td><?php echo htmlspecialchars($record[4]); ?></td>
                <td><?php echo htmlspecialchars($record[5]); ?></td>
                <td><?php echo htmlspecialchars($record[6]); ?></td>
                <td><?php echo htmlspecialchars($record[7]); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
  </table>

</section>

</body>
</html>