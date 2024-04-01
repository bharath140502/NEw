<?php
session_start();
include('includes/config.php');

// Function to validate LDAP credentials against Active Directory
function authenticateLDAP($username, $password) {
    $ldap_server = "10.247.49.10"; // Update with your LDAP server address
    $ldap_bind_dn = "bhoruka\ramya.s"; // Update with your service account DN
    $ldap_bind_password = "DevaGanesh@67"; // Update with your service account password

    // Connect to LDAP server
    $ldap_conn = ldap_connect($ldap_server);

    if (!$ldap_conn) {
        // Failed to connect to LDAP server
        return false;
    }

    // Bind to LDAP server
    $ldap_bind_result = ldap_bind($ldap_conn, $ldap_bind_dn, $ldap_bind_password);

    if (!$ldap_bind_result) {
        // Failed to bind to LDAP server
        return false;
    }

    // Search for user in Active Directory
    $ldap_search_result = ldap_search($ldap_conn, "dc=your_domain,dc=com", "(sAMAccountName=$username)");

    if (!$ldap_search_result) {
        // LDAP search failed
        return false;
    }

    $ldap_entries = ldap_get_entries($ldap_conn, $ldap_search_result);

    if ($ldap_entries['count'] == 1) {
        // User found, attempt to authenticate
        $user_dn = $ldap_entries[0]['dn'];
        $ldap_auth_result = ldap_bind($ldap_conn, $user_dn, $password);

        if ($ldap_auth_result) {
            // Authentication successful
            return true;
        }
    }

    // Authentication failed
    return false;
}

// Check if login form is submitted
if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate user against Active Directory
    if (authenticateLDAP($username, $password)) {
        // Authentication successful
        // Proceed with desired actions
        // For example, set session variables and redirect to dashboard
        $_SESSION['username'] = $username;
        header("Location: admin/admin_dashboard.php");
        exit();
    } else {
        // Authentication failed
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Bhoruka Leave Manager</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/BEPL-logo180.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/BEPL-logo32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/BEPL-logo16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>
<body class="login-page">
<div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div class="brand-logo">
            <a href="login.html">
                <img src="vendors/images/BEPL-logo.png" alt="">
            </a>
        </div>
    </div>
</div>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <img src="vendors/images/login-page-img.png" alt="">
            </div>
            <div class="col-md-6 col-lg-5">
                <div class="login-box bg-white box-shadow border-radius-10">
                    <div class="login-title">
                        <h2 class="text-center text-primary">Welcome To Self Portal</h2>
                    </div>
                    <form name="signin" method="post">

                        <div class="input-group custom">
                            <input type="text" class="form-control form-control-lg" placeholder="Email ID" name="username" id="username">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="icon-copy fa fa-envelope-o" aria-hidden="true"></i></span>
                            </div>
                        </div>
                        <div class="input-group custom">
                            <input type="password" class="form-control form-control-lg" placeholder="**********"name="password" id="password">
                            <div class="input-group-append custom">
                                <span class="input-group-text"><i class="toggle-password dw dw-eye"></i>
            <i class="toggle-password dw dw-eye-off" style="display: none;"></i></span>
                            </div>
                        </div>
                        <div class="row pb-30">

                            <div class="col-6">
                                <div class="forgot-password"><a href="forgot_pwd.php">Forgot Password</a></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="input-group mb-0">
                                    <input class="btn btn-primary btn-lg btn-block" name="signin" id="signin" type="submit" value="Sign In">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add this script at the end of your HTML body -->
<script>
    // Get references to the password input and toggle button
    const passwordInput = document.getElementById("password");
    const toggleButton = document.querySelector(".toggle-password");

    // Add click event listener to the toggle button
    toggleButton.addEventListener("click", function () {
        // Toggle the input field's type between "password" and "text"
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleButton.querySelector(".dw-eye").style.display = "none";
            toggleButton.querySelector(".dw-eye-off").style.display = "inline";
        } else {
            passwordInput.type = "password";
            toggleButton.querySelector(".dw-eye").style.display = "inline";
            toggleButton.querySelector(".dw-eye-off").style.display = "none";
        }
    });
</script>


<!-- js -->
<script src="vendors/scripts/core.js"></script>
<script src="vendors/scripts/script.min.js"></script>
<script src="vendors/scripts/process.js"></script>
<script src="vendors/scripts/layout-settings.js"></script>
</body>
</html>
