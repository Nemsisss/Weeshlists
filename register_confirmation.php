<?php 
require './config/config.php';

if ( !isset($_POST['email']) || trim($_POST['email'] == '')
	|| !isset($_POST['name']) || trim($_POST['name'] == '')
	|| !isset($_POST['password']) || trim($_POST['password'] == '') ) {
	$error = "Please fill out all required fields.";
}
else{
    $mysqli= new  mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli-> connect_errno)
    {
        echo $mysqli->connect_error;
		exit();
	}
    $email= $mysqli->escape_string($_POST['email']);
	$name= $mysqli->escape_string($_POST['name']);
	$password= $mysqli->escape_string($_POST['password']);
	$password= hash('sha256', $password);
    $sql_registered="SELECT * FROM users WHERE email= '$email';";
	$results_registered= $mysqli->query($sql_registered);
	if($results_registered==false)
	{
		echo $mysqli->error;
		$mysqli->close();
		exit();

	}
	if($results_registered->num_rows > 0)
	{
		$error= "Email already registered!";
	}
	else
	{

		$sql="INSERT INTO users (name,email, password)
		VALUES ('$name', '$email', '$password');";
		$results= $mysqli->query($sql);
		if($results==false)
		{
			echo $mysqli->error;
			$mysqli->close();
			exit();

		}
	}
	$mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>   
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
</head>
<style>
	#login {
	text-decoration: none;
	color: white;
	font-family: regular, Arial, Arial;
	}
	#signup {
	text-decoration: none;
	color: black;
	font-family: regular, Arial, Arial;
	}

	#btns {
        padding-top: 50px;
        font-family: regular, Arial, Arial;
      }
	  body{
        background-color: #fcf1e1;
		
      }
      .container{
		height: 84vh;
      }
      .btn{
        font-family: "regular", Arial, Arial !important;
        
      }
      .btn-dark {
        background-color: black;
        color:white;
        border: 2px solid black !important;
      }
	  .btn-outline-dark{
		border: 2px solid black !important;
	  }
      .btn-dark:hover , .btn-outline-dark:hover{
        background-color: #ff792b !important;
        color: white !important;
        border: 2px solid #ff792b !important;
    
      }
	  .text-danger, .text-success{
		font-family: yesevaone, Arial, Arial;
		margin-top: 200px;
	  }

</style>
<body>
<div class="container row mt-5 mx-auto">
			<div class="cont col-12 col-lg-10 mx-auto text-center">
				<?php if ( isset($error) && trim($error) != '' ) : ?>
					<div class="text-danger"><h2><?php echo $error; ?></h2></div>
				<?php else : ?>
					<div class="text-success"><h2> <?php echo $email;?> was successfully registered.</h2></div>
				<?php endif; ?>
		<div id="btns" class="  mx-auto">
		<a href="register.html" class="btn btn-dark mt-4 rounded-pill">Go back to Sign Up </a>
		<a href="login.php" class="btn btn-outline-dark mt-4 rounded-pill ">Go to Login </a>
        </div>

		</div> <!-- .col -->
	</div> <!-- .row -->
	<div id="footer">Weeshlists by Nemsiss Shahbazian &copy; 2022</div>
</body>
</html>