<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Water-Billing System</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="signup-form" action="signup.php" method="post">
                <h1>Create Account</h1>
                <input type="text" id="name" name="name" placeholder="Name">
                <span class="error" id="name-error"></span>
                <input type="email" id="email" name="email" placeholder="Email">
                <span class="error" id="email-error"></span>
                <input type="password" id="password" name="password" placeholder="Password">
                <span class="error" id="password-error"></span>
                <input type="tel" id="contact_num" name="contact_num" placeholder="Contact Number">
                <span class="error" id="contact_num-error"></span>
                <input type="text" id="address" name="address" placeholder="Address">
                <span class="error" id="address-error"></span>
                <select id="admin_id" name="admin_id" required>
                    <option value="1">Admin 1</option>
                    <option value="2">Admin 2</option>
                </select><br>
                <button type="submit">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form id="signin-form" action="connection/session.php" method="post">
                <h1>Sign In</h1><br><br>
                <input type="email" id="signin-email" name="email" placeholder="Email">
                <span class="error" id="signin-email-error"></span>
                <input type="password" id="signin-password" name="password" placeholder="Password">
                <span class="error" id="signin-password-error"></span>
                <span class="error" id="signin-error"></span>
                <button type="submit">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Water-Billing System</h1>
                    <p>Efficiency Flows Through Every Drop</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Water-Billing System</h1>
                    <p>Billing Made Simple, Water Conservation Made Easy</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="login.js"></script>
</body>

</html>