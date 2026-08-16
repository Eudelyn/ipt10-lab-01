<?php

define('CUSTOMERS_FILE_PATH', 'customers-100000.csv');

function get_filtered_customers_data($filter_letter)
{
    $time_start = microtime(true);

    $opened_file_handler = fopen(CUSTOMERS_FILE_PATH, 'r');

    $data = [];
    $headers = [];
    $row_count = 0;

    while (!feof($opened_file_handler)) {
        $row = fgetcsv($opened_file_handler, 1024);
        if (!empty($row)) {
            if ($row_count == 0) {
                $headers = $row;
            } else {
                if (isset($row[3][0]) && strtoupper($row[3][0]) == strtoupper($filter_letter)) {
                    array_push($data, $row);
                }
            }
        }
        $row_count++;
    }

    fclose($opened_file_handler);

    $time_end = microtime(true);

    return [
        'headers' => $headers,
        'data' => $data,
        'execution_time' => $time_end - $time_start
    ];
}

$chosen_letter = $_GET['letter'] ?? 'A';

$customers = get_filtered_customers_data($chosen_letter);

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #2</title>
    <link rel="icon" href="https://phpsandbox.io/assets/img/brand/phpsandbox.png">
    <link rel="stylesheet" href="https://assets.ubuntu.com/v1/vanilla-framework-version-4.15.0.min.css" />
</head>
<body>

<h1>
    Customers (Last Name starts with '<?php echo htmlspecialchars($chosen_letter); ?>')
</h1>

<p>
    Matches found: <strong><?php echo count($customers['data']); ?></strong><br>
    PHP execution time: <strong><?php echo round($customers['execution_time'], 5); ?> seconds</strong><br>
    Full page load time: <strong id="page-load-time">calculating...</strong>
</p>

<p><a href="index.php">&laquo; Back to all customers</a></p>

<h4>
<?php foreach (range('A', 'Z') as $letter): ?>
    <a href="filtered.php?letter=<?php echo $letter; ?>"><?php echo $letter; ?></a>
<?php endforeach; ?>
</h4>

<table aria-label="Filtered Customers">
    <thead>
        <tr>
            <th>Customer ID</th>
            <th>Complete Name</th>
            <th>Company</th>
            <th>City / Country</th>
            <th>Email Address</th>
        </tr>
    </thead>
    <tbody>
    <?php if (empty($customers['data'])): ?>
        <tr>
            <td colspan="5">No customers found for this letter.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($customers['data'] as $record): ?>
        <tr>
            <td><?php echo htmlspecialchars($record[1]); ?></td>
            <td><?php echo "<strong>{$record[3]}</strong>, {$record[2]}"; ?></td>
            <td><?php echo htmlspecialchars($record[4]); ?></td>
            <td><?php echo htmlspecialchars("{$record[5]}, {$record[6]}"); ?></td>
            <td><?php echo htmlspecialchars($record[9]); ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>

<script>
window.addEventListener('load', function () {
    var timing = performance.timing;
    var loadSeconds = ((timing.loadEventEnd - timing.navigationStart) / 1000).toFixed(3);
    document.getElementById('page-load-time').textContent = loadSeconds + ' seconds';
});
</script>

</body>
</html>