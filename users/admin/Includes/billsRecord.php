<?php
require_once('../../../connection/config.php');
require_once('../../../connection/session.php');


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Bills</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../assets/style.css"> <!-- Link to your external CSS file -->
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Link to your external CSS file -->
</head>
<body>
    
<?php 
include "../adminHeader.php";
include "../sidebar.php";
?>   

<div class="container">
    <div class="title">
        <h1>Bills</h1>
    </div>
    
    <!-- Filter Form -->
    <form method="GET" id="filterForm">
        <input type="text" class="search" id="user_filter" name="user_filter" placeholder="    Id or Email" value="<?php echo isset($_GET['user_filter']) ? $_GET['user_filter'] : ''; ?>">
        <button class="btn btn-primary" type="submit">Filter</button>
        <button class="btn btn-danger" type="button" onclick="resetFilter()">Reset</button>
    </form>

    <?php
    // Step 2: Retrieve bills from the database based on filter, if provided
    $filter = isset($_GET['user_filter']) ? $_GET['user_filter'] : '';
    $sql = "SELECT b.bill_id,b.charge_id, b.user_id, b.units, b.tariff_id, b.total_amount, b.due_date, b.payment_status, u.email, r.reading_id,
               r.previous_reading_value, r.previous_reading_date,
               r.current_reading_value, r.current_reading_date
            FROM bill b
            INNER JOIN user u ON b.user_id = u.user_id
            LEFT JOIN meter_reading r ON b.reading_id = r.reading_id
            WHERE b.payment_status = 'paid'";
    
    if (!empty($filter)) {
        // Add filter condition to SQL query
        $sql .= " AND (b.user_id = '$filter' OR u.email = '$filter')";
    }
    
    $result = $con->query($sql);
    ?>
    
    <table class="table">
        <thead>
            <tr>
                <th>Bill ID</th>
                <th>Previous Reading</th>
                <th>Current Reading</th>
                <th>Units</th>
                <th>Due Date</th>
                <th>Additional Charge(%)</th>
                <th>Charged Amount</th>
                <th>Total Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) { 
                    // Fetching tariff details for the user's bill
                    $tariff_id = $row['tariff_id'];
                    $tariff_sql = "SELECT * FROM tariff WHERE tariff_id = $tariff_id";
                    $tariff_result = $con->query($tariff_sql);
                    $tariff_row = $tariff_result->fetch_assoc();
                    $unit_price = $tariff_row['unit_price'];
                    $base_fee = $tariff_row['base_fee'];
                    
                    // Fetch additional charge details
                    $additional_charge_percent = 0;
                    $additional_charge = 0;
                    $charge_id = $row['charge_id'];
                    if ($charge_id !== null) {
                        $charge_sql = "SELECT * FROM additional_charge WHERE charge_id = $charge_id";
                        $charge_result = $con->query($charge_sql);
                        if ($charge_result && $charge_result->num_rows > 0) {
                            $charge_row = $charge_result->fetch_assoc();
                            $additional_charge_percent = $charge_row['charge_percent'];
                            $additional_charge = ($row['total_amount'] * $additional_charge_percent) / 100;
                        }
                    }

                    ?>
                    
                    <tr>
                        <td><?= $row['bill_id'] ?></td>
                        <td><?= $row['previous_reading_value'] ?></td>
                        <td><?= $row['current_reading_value'] ?></td>
                        <td><?= $row['units'] ?></td>
                        <td><?= $row['due_date'] ?></td>
                        <td><?= $additional_charge_percent ? $additional_charge_percent . '%' : 'No Additional Charge' ?></td>
                        <td><?= $additional_charge ? 'Rs ' . $additional_charge : 'No Additional Charge' ?></td>
                        <td><?= 'Rs ' . $row['total_amount'] ?></td>
                         <td><?= $row['payment_status'] ?></td>
                    </tr>
                
                <?php }
            } else { ?>
                <tr>
                    <td colspan="9">No paid bills found for this user.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
    function resetFilter() {
        // Reset the filter input field
        document.getElementById('user_filter').value = '';
        
        // Submit the form to reset the filter
        document.getElementById('filterForm').submit();
    }
    function submitForm(formId) {
        document.getElementById(formId).submit();    
    }

    function deleteBill(readingId) {
        if (confirm('Are you sure you want to delete this bill?')) {
            // Create a hidden form with the bill ID
            var form = document.createElement('form');
            form.method = 'post';
            form.action = 'billDeleteProcess.php'; // PHP script to handle deletion

            // Create a hidden input field for the bill ID
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'reading_id';
            input.value = readingId;

            // Append the input field to the form
            form.appendChild(input);

            // Append the form to the document and submit it
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>
<script type="text/javascript" src="../assets/js/script.js"></script>
</body>
</html>
