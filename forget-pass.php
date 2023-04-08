<?php
$errors = array();

if (isset($_POST['reset'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $json = $_COOKIE['users'];
    $users = json_decode($json, true);

    // Check if the username exists in the array
    $user_exists = in_array($username, array_column($users, 'username'));
    if (!$user_exists) {
        $errors['username'] = "Invalid username";
    } else {
        foreach ($users as &$user) {
            if ($user['username'] === $username) {
                if ($password !== $repassword) {
                    $errors['password'] = "The new passwords do not match";
                } else {
                    $user['password'] = password_hash($password, PASSWORD_DEFAULT);
                    $json = json_encode($users);
                    setcookie('users', $json, time() + 3600, '/');
                    header('Location: login.php');
                    exit;
                }
                break;
            }
        }
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
  	<title>Forget Password</title>
    <meta charset="utf-8">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Forget Password </h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<!-- <h3 class="text-center mb-4">Have an account?</h3> -->
						<form method="POST" class="login-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Username" name="username" required>
					
                        <?php if (in_array('Invalid username', $errors)): ?>
                            <div class="alert alert-danger" role="alert">Invalid username</div>
                        <?php endif; ?>
                            
		      		</div>
                    <div class="form-group">
                        <input type="password" class="form-control rounded-left" placeholder="Password" name="password" required>
                        <?php if (isset($errors['password'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errors['password']; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control rounded-left" placeholder="Confirm Password" name="repassword" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary rounded submit p-3 px-5" name= 'reset'>Reset</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	</body>
</html>





