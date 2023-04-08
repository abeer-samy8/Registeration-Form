

<?php
if (isset($_POST['logout'])) {
    setcookie('users', '', time() - 3600, '/');
    session_destroy();

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Logout</title>
</head>
<body>
    <h1>Welcome</h1>
    <form method="post" >
        <input type="submit" name="logout" value="Logout">
    </form>
   
</body>
</html>
