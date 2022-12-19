<?php 
    require './config/config.php';
    if ( isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true ) {
		// User IS NOT logged in.
		header('Location: ./home.php');
	}
    else
    {
        if ( isset($_POST['email']) && isset($_POST['password']) ) 
		{
			// The form was submitted.
			$mysqli= new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if($mysqli->connect_errno)
			{
				echo $mysqli->connect_error;
				exit();
			}
			$email= $_POST['email'];
			$password= hash('sha256',$_POST['password']);
			

			$sql="SELECT * FROM users
					WHERE email = '$email' AND password ='$password';";
			
			$results= $mysqli->query($sql);
			if(!$results)
			{
				echo $mysqli->error;
				$mysqli->close();
				exit();
			}
			$mysqli->close();

			if ( $results->num_rows==1 ) {
				// Valid credentials.

				$_SESSION['logged_in'] = true;
				$_SESSION['email'] = $_POST['email'];

				header('Location: ./home.php');

			} else {
				// Invalid credentials.

				$error = "Invalid credentials.";
	

			}

		}
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="stylesheet" type="text/css" href="login_register.css" />
   
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      .container{
        height: 90vh;
      }
      #login-form, .form-input, .btn{
        font-family: "regular", Arial, Arial !important;
      }
      .btn-dark:hover {
      background-color: black !important;
      color: white !important;
      border: 2px solid black !important;
    }
    </style>
  </head>
  <body>
    <div class="main">
      <div class="container">
        <div class="col-lg-10 row mx-auto">
          <!-- Login form -->
          <div class="col-md-6 col-lg-6 mx-auto">
            <div class="login-card mb-5">
              <h2 id="signin" class="mb-5">Sign In</h2>
              <form
                id="login-form"
               
                method="POST"
              >
                <div class="row mb-3">
                  <div class="font-italic text-danger col-sm-9 ml-sm-auto">
                    <!-- Show errors here. -->
                    <?php
        
                    if ( !empty($error) ) {
                      echo $error;
                    }
        
                  ?>
                  </div>
                </div>
                <!-- .row -->
                <div class="mb-4">
                  <label for="l-email">Email</label
                  ><span class="text-danger">*</span>
                  <input
                    id="l-email"
                    type="email"
                    class="form-input"
                    name="email"
                    placeholder="Enter your email address"
                  />

                  <small id="email-error" class="invalid-feedback"
                    ><em>Email is required.</em></small
                  >
                </div>
                <div class="mb-5">
                  <label for="l-pass">Password</label
                  ><span class="text-danger">*</span>
                  <input
                    id="l-pass"
                    type="password"
                    class="form-input"
                    name="password"
                    placeholder="Enter your password"
                  />
                  <small id="password-error" class="invalid-feedback"
                    ><em>Password is required.</em></small
                  >
                </div>
                <div class="text-center">
                  <input
                    type="submit"
                    class="btn btn-dark rounded-pill mb-5"
                    value="Login"
                  />
                </div>
              </form>
            </div>
          </div>

        </div>
      </div>
      <div id="footer">Weeshlists by Nemsiss Shahbazian &copy; 2022</div>
    </div>
    <script>
      document.querySelector("#login-form").onsubmit = function () {
        if (document.querySelector("#l-email").value.trim().length == 0) {
          document.querySelector("#l-email").classList.add("is-invalid");
        } else {
          document.querySelector("#l-email").classList.remove("is-invalid");
        }
        if (document.querySelector("#l-pass").value.trim().length == 0) {
          document.querySelector("#l-pass").classList.add("is-invalid");
        } else {
          document.querySelector("#l-pass").classList.remove("is-invalid");
        }
        return !document.querySelectorAll(".is-invalid").length > 0;
      };

    </script>
  </body>
</html>
