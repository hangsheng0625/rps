<?php // Do not put any HTML above this line

if (isset($_POST['cancel'])) {
    // Redirect the browser to index.php
    header("Location: index.php");
    return;
}

$salt = 'XyZzy12*_';
$stored_hash = 'a8609e8d62c043243c4e201cbb342862';  // Password is meow123
$failure = false;  // To track error messages

// Check to see if we have some POST data, if we do process it
if (isset($_POST['who']) && isset($_POST['pass'])) {
    $username = $_POST['who'];
    $password = $_POST['pass'];

    // Check if fields are empty
    if (strlen($username) < 1 || strlen($password) < 1) {
        $failure = "User name and password are required";
    } elseif ($username !== 'XyZzy12*_') { // Check if username matches
        $failure = "Access denied: Invalid username";
    } else {
        // Validate the password
        $check = hash('md5', $salt . $password);
        if ($check == $stored_hash) {
            // Redirect the browser to game.php
            header("Location: game.php?name=" . urlencode($username));
            return;
        } else {
            $failure = "Incorrect password";
        }
    }
}

// Fall through into the View
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once "bootstrap.php"; ?>
<title>93a147d0 - Chuck Severance's Login Page</title>
</head>
<body>
<div class="container">
<h1>Please Log In</h1>
<?php
// Display error messages if any
if ($failure !== false) {
    echo('<p style="color: red;">' . htmlentities($failure) . "</p>\n");
}
?>
<form method="POST">
<label for="nam">User Name</label>
<input type="text" name="who" id="nam"><br/>
<label for="id_1723">Password</label>
<input type="text" name="pass" id="id_1723"><br/>
<input type="submit" value="Log In">
<input type="submit" name="cancel" value="Cancel">
</form>
<p>
For a password hint, view source and find a password hint
in the HTML comments.
<!-- Hint: The password is the four character sound a cat
makes (all lower case) followed by 123. -->
</p>
</div>
</body>
</html>
