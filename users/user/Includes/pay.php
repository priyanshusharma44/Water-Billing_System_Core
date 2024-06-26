<?php
// Include your database configuration file
require_once('../../../connection/config.php');

$error_message = "";
$khalti_public_key = "test_public_key_b04f6e78dc88418a91e4a01dfd8b3b1d";

// Ensure $con is initialized correctly
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["token"]) && isset($_POST["mpin"]) && isset($_POST["bill_id"]) && isset($_POST["total_amount"])) {
        try {
            $token = $_POST["token"];
            $mpin = $_POST["mpin"];
            $bill_id = $_POST["bill_id"];
            $total_amount = $_POST["total_amount"];

            // Verify the payment using Khalti API
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://khalti.com/api/v2/payment/confirm/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "public_key": "' . $khalti_public_key . '",
                    "transaction_pin": ' . $mpin . ',
                    "confirmation_code": ' . $token . ',
                    "token": "' . $token . '"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $parsed_response = json_decode($response, true);

            if (isset($parsed_response["token"])) {
                // Payment successful
                $payment_status = "paid";

                // Update the bill status in the database
                $update_sql = "UPDATE bill SET payment_status = ?, total_amount = ? WHERE bill_id = ?";
                $stmt = $con->prepare($update_sql);
                $stmt->bind_param("sdi", $payment_status, $total_amount, $bill_id);
                $stmt->execute();

                // Redirect to billsRecord.php after successful payment
                header("Location: ../../../users/user/Includes/billsRecord.php");
                exit();
            } else {
                $error_message = "Could not process the transaction at the moment.";
                if (isset($parsed_response["detail"])) {
                    $error_message = $parsed_response["detail"];
                }
            }
        } catch (Exception $e) {
            $error_message = "Could not process the transaction at the moment.";
        }
    } else {
        $error_message = "Invalid request parameters.";
    }
}
?>

<div class="khalticontainer">
    <center>
        <div><img src="khalti.png" alt="khalti" width="200"></div>
    </center>
    <?php if ($error_message != "") { ?>
    <div class="error">
        <span style="color:red;"><?php echo $error_message; ?></span>
    </div>
    <?php } ?>

    <form action="pay.php" method="post">
        <input type="hidden" name="bill_id" value="<?php echo htmlspecialchars($_GET['bill_id']); ?>">
        <input type="hidden" name="total_amount" value="<?php echo htmlspecialchars($_GET['total_amount']); ?>">
        <div class="form-group">
            <label for="token">Khalti Transaction Code:</label>
            <input type="text" class="form-control" id="token" name="token" required>
        </div>
        <div class="form-group">
            <label for="mpin">Your Khalti MPIN:</label>
            <input type="password" class="form-control" id="mpin" name="mpin" required>
        </div>
        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
</div>


<style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(to bottom right, #4e54c8, #8f94fb);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.khalticontainer {
    width: 300px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.khalticontainer img {
    display: block;
    margin: 0 auto 20px;
}

input {
    width: calc(100% - 16px);
    padding: 10px;
    margin: 6px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #5C2D91;
    border: none;
    color: white;
    cursor: pointer;
    width: calc(100% - 16px);
    padding: 12px;
    margin: 6px;
    border-radius: 4px;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #4a2573;
}

.error {
    color: red;
    font-size: 14px;
    margin-top: 10px;
}

.success {
    color: green;
    font-size: 14px;
    margin-top: 10px;
}

.khalticontainer small {
    display: block;
    font-size: 12px;
    margin-top: 10px;
}
</style>