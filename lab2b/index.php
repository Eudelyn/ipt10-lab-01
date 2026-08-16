<?php

define('CUSTOMERS_FILE_PATH', 'customers-100000.csv');

function get_all_customers_data()
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
                array_push($data, $row);
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

$customers = get_all_customers_data();

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
    All Customers
</h1>

<p>
    Total customers loaded: <strong><?php echo count($customers['data']); ?></strong><br>
    PHP execution time: <strong><?php echo round($customers['execution_time'], 5); ?> seconds</strong><br>
    Full page load time: <strong id="page-load-time">calculating...</strong>
</p>

<h4>
<?php foreach (range('A', 'Z') as $letter): ?>
    <a href="filtered.php?letter=<?php echo $letter; ?>"><?php echo $letter; ?></a>
<?php endforeach; ?>
</h4>
<small>
The dataset is retrieved from this URL <a href="https://www.datablist.com/learn/csv/download-sample-csv-files">https://www.datablist.com/learn/csv/download-sample-csv-files</a>
</small>
<table aria-label="Customers Dataset">
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
    <?php foreach ($customers['data'] as $record): ?>
        <tr>
            <td><?php echo htmlspecialchars($record[1]); ?></td>
            <td><?php echo "<strong>{$record[3]}</strong>, {$record[2]}"; ?></td>
            <td><?php echo htmlspecialchars($record[4]); ?></td>
            <td><?php echo htmlspecialchars("{$record[5]}, {$record[6]}"); ?></td>
            <td><?php echo htmlspecialchars($record[9]); ?></td>
        </tr>
    <?php endforeach; ?>
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