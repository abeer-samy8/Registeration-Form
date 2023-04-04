

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
    <?php
    session_start();
    if(isset($_POST['logout'])) {
        session_destroy();
        header('Location: login.php');
    }
    ?>
</body>
</html>
