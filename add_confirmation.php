<?php 
require './config/config.php';
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false ) {
  // User IS logged in.
  header('Location: ./landingPage.html');
}
if( !isset($_POST['itemurl']) || trim($_POST['itemurl'])=='' || !isset($_POST['category_id']) || trim($_POST['category_id'])==''|| !isset($_POST['itemName']) || trim($_POST['itemName'])=='' || !isset($_POST['user_id']) || trim($_POST['user_id'])=='')
{
  $error="Please fill out all required fields.";
  $user_id= $_POST['user_id'];

}
else{

  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
  if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
  }
  $mysqli->set_charset('utf8');
  $user_id= $_POST['user_id'];
  $item_name= "'".$_POST['itemName']."'";
  $item_url= "'".$_POST['itemurl']."'";
  $category_id= $_POST['category_id'];
  if ( isset($_POST['brand']) && trim($_POST['brand']) != '') {
    $brand = "'".$_POST['brand']."'";
  } else {
    $brand = "null";
  }
  if ( isset($_POST['imgurl']) && trim($_POST['imgurl']) != '') {
    $img_url = "'".$_POST['imgurl']."'";
  } else {
    $img_url = "'"."https://via.placeholder.com/300". "'";
  }

  $sql= "INSERT INTO wishlist_item(user_id,item_name,item_url, brand, image_url, category_id) VALUES ($user_id,$item_name,$item_url, $brand, $img_url, $category_id );";
  $results= $mysqli->query($sql);
  if(!$results)
  {
      echo $mysqli->error;
      $mysqli->close();
      exit();
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
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
      integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" type="text/css" href="main.css" />
    <style>


	  body{
        background-color: #fcf1e1;
		
      }
      .btn{
        font-family: "regular", Arial, Arial !important;
        
      }
      .btn-dark {
        background-color: black;
        color:white;
        border: 2px solid black !important;
      }

      .btn-dark:hover {
        background-color: #ff792b !important;
        color: white !important;
        border: 2px solid #ff792b !important;
    
      }


      .container{
		    height: 76vh;
      }


	  .text-danger, .text-success{
		font-family: yesevaone, Arial, Arial;
		margin-top: 200px;
	  }

</style>
</head>

<body>
<nav id="nav-bar" class="navbar navbar-expand-lg sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"> </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon bg-light"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link " href="home.php">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle active"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                My Wishlists
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a class="dropdown-item "  aria-current="page" href="view.php">View my wishlist</a>
                </li>
                <li>
                  <a class="dropdown-item" href="add.php">Add to my wishlist</a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container row mt-5 mx-auto">
			<div class="cont col-12 col-lg-10 mx-auto text-center">
				<?php if ( isset($error) && trim($error) != '' ) : ?>
					<div class="text-danger">
            <h2><?php echo $error; ?></h2>
          </div>
				<?php else : ?>
					<div class="text-success">
            <h2> <?php echo $_POST['itemName'];?> was successfully added!</h2>
          </div>
				<?php endif; ?>
        <div class="col-10 col-lg-5 mx-auto">
        <a href="<?php if(isset($error) && trim($error) != ''){ echo "add.php";} else { echo "view_results.php?user_id=". $user_id;}  ?>" class="btn btn-dark mt-4 rounded-pill">Go back </a>
        </div>
    </div>
</div>
 <div id="footer">Weeshlists by Nemsiss Shahbazian &copy; 2022</div>

</body>
</html>