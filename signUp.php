<?php

session_start();

// Check if the users cookie exists and retrieve the users array
if (isset($_COOKIE['users'])) {
    $json = $_COOKIE['users'];
    $users = json_decode($json, true);
} else {

    $users = [];
}

function validatePassword($password) {
    $errors = [];

    if (strlen($password) < 8) {
        $errors[] = "Password should be at least 8 characters long";
    }

    elseif (!preg_match("#[0-9]+#", $password)) {
        $errors[] = "Password should contain at least one number";
    }
    
    elseif (!preg_match("#[a-zA-Z]+#", $password)) {
        $errors[] = "Password should contain at least one letter";
    } 
    
    return $errors;
}

if (isset($_POST['signup'])) {

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    $errors = [];

    if (empty($username) || empty($email) || empty($password) || empty($repassword)) {
        $errors[] = "All fields are required";
    }

    if ($password != $repassword) {
        $errors[] = "Passwords do not match";
    }

    $passwordErrors = validatePassword($password);
    if (!empty($passwordErrors)) {
        $errors = array_merge($errors, $passwordErrors);
    }

    if (empty($errors)) {
        $userId = count($users) + 1;

        $users[] = [
            'id' => $userId,
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ];
      
        $json = json_encode($users);
        setcookie('users', $json, time() + 3600 , '/');
        header('Location: login.php');
        exit();
     }
}

?>



<!doctype html>
<html lang="en">
  <head>
  	<title>Sign Up</title>
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
					<h2 class="heading-section">Sign Up</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
						<div class="icon d-flex align-items-center justify-content-center">
							<span class="fa fa-user-o"></span>
						</div>
						<form  method="POST" class="login-form" >
							<div class="form-group">
								<input type="text" class="form-control rounded-left" name="username" placeholder="Username" required>
								
							</div>
							<div class="form-group">
								<input type="email" class="form-control rounded-left" placeholder="E-mail" name="email" required>
							</div>
							<div class="form-group d-flex">
								<input type="password" class="form-control rounded-left" placeholder="Password" name="password" required>
							</div>
							<div class="form-group d-flex">
								<input type="password" class="form-control rounded-left" placeholder="Re-type Password" name="repassword" required>
							</div>
							 
							
						<?php if (!empty($errors)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php foreach ($errors as $error): ?>
                                    <div><?php echo $error; ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

							<div class="form-group">
								<button type="submit" class="btn btn-primary rounded submit p-3 px-5" name= 'signup'>Sign Up</button>
							</div>
							
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</section>

	</body>
</html>
