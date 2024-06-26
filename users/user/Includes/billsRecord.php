<?php
require_once('../../../connection/config.php');
require_once('../../../connection/session.php');

$user_id = $_SESSION['uid'];

$sql = "SELECT b.bill_id, b.tariff_id, m.previous_reading_value, m.current_reading_date, m.current_reading_value, b.units, b.total_amount, b.payment_status, b.due_date
        FROM bill b
        JOIN meter_reading m ON b.reading_id = m.reading_id
        WHERE b.user_id = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php
include "../userHeader.php";
include "../sidebar.php";
?>

    <div class="container">
        <div class="title">
            <h1>Billing History</h1>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Bill ID</th>
                    <th>Previous Reading</th>
                    <th>Current Reading</th>
                    <th>Units</th>
                    <th>Total Amount</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>

                <tr>
                    <td><?= $row['bill_id'] ?></td>
                    <td><?= $row['previous_reading_value'] ?></td>
                    <td><?= $row['current_reading_value'] ?></td>
                    <td><?= $row['units'] ?></td>
                    <td><?= 'Rs ' . $row['total_amount'] ?></td>
                    <td><?= $row['due_date'] ?></td>
                    <td><?= $row['payment_status'] ?></td>
                </tr>

                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7">No billing history found for this user.</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="../assets/js/script.js"></script>
</body>

</html>