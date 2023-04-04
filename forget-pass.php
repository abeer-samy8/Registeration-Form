<?php

if(isset($_POST['reset'])) {
  // retrieve username from cookie
  $username = $_COOKIE['username'];
var_dump($username);
  // retrieve new password
  $password = $_POST['password'];

  // validate password
  if(strlen($password) < 8) {
    $errors[] = 'Password must be at least 8 characters long';
  }

  // if there are no errors
  if(empty($errors)) {
    // retrieve users array from cookie
    $users = json_decode($_COOKIE['users'], true);

    // update password for user
    $users[$username]['password'] = password_hash($password, PASSWORD_DEFAULT);

    // store updated users array in cookie
    setcookie('users', json_encode($users), time() + (86400 * 30), '/');

    // redirect to login page
    header('Location: login.php');
    exit;
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
						<form  method= "POST" class="login-form">
		      		<div class="form-group">
		      			<input type="text" class="form-control rounded-left" placeholder="Username" name='username' required>
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Password" name= 'password'  required>
	            </div>
                <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Confirm-Password" name= 'repassword'  required>
	            </div>
	          
								
	            </div>
				<?php if (!empty($errors)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php foreach ($errors as $error): ?>
                                    <div><?php echo $error; ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5" name= 'reset'>LOG IN</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	</body>
</html>