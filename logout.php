<!DOCTYPE html>

<body>
<?php
session_start();

$_SESSION = array();

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
?>

Sign out successful
<form action="loginpage.html" method="POST">
		<input type="submit" value="Click here to return to login page">
</form>
</body>
</html>

