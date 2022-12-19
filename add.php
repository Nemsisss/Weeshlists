<?php
require './config/config.php';
    if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false ) {
      // User IS NOT logged in.
      header('Location: ./landingPage.html');
    }

// DB Connection.
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
  echo $mysqli->connect_error;
  exit();
}
$mysqli->set_charset('utf8');

$sql_category= "SELECT * FROM category;";
$results_cat= $mysqli->query($sql_category);
if(!$results_cat)
{
  echo $mysqli->error;
  $mysqli->close;
  exit();
}
$user_email= $_SESSION['email'];
$sql_userid="SELECT user_id FROM users WHERE email = '$user_email' ; ";
$result_userid= $mysqli->query($sql_userid);
if(!$result_userid)
{
  echo $mysqli->error;
  $mysqli->close();
  exit();
}
$user_id= $result_userid->fetch_assoc();
$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add</title>
    
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

      .container{
        height: 77vh;
      }

      #btns {
        padding-top: 50px;
        font-family: regular, Arial, Arial;
      }
      .btn-dark {
        background-color: black;
      }
      .btn-outline-dark {
        color: black;
      }
      .btn-dark:hover {
        background-color: #ff792b !important;
        color: white !important;
        border-color: #ff792b !important;
      }
      .input-field {
        border: 1px solid black;
        font-size: 0.9rem;
        font-family: regular, Arial, Arial;
      }
      .input-field:hover {
        border: 1px solid #ff792b;
      }
      .input-label {
        font-family: yesevaone, Arial, Arial;
        color: #e36866;
      }
      #category-id {
        font-family: regular, Arial, Arial;
      }
      h3, #h5{
        font-family: regular, Arial, Arial;
  
      }
    </style>
  </head>
  <body>
    <nav id="nav-bar" class="navbar navbar-expand-lg bg-light sticky-top">
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
              <a class="nav-link" href="home.php">Home</a>
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
                  <a class="dropdown-item" href="view.php">View my wishlist</a>
                </li>
                <li>
                  <a class="dropdown-item" aria-current="page" href="add.php"
                    >Add to my wishlist</a
                  >
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
    <div id="add_form" class="container mt-5">
      <form action="add_confirmation.php" method="POST">
      <input type="hidden" name="user_id" value="<?php echo $user_id['user_id'];?>">
      <div class="col-12 col-md-10 col-lg-8 col-xl-7 mb-4 mt-4 form-group row mx-auto ">
           
        </div>
        <div class="col-12 col-md-10 col-lg-8 col-xl-7 mb-4 mt-4 form-group row mx-auto">
        <h3>Add more items to your <em>Weeshlist</em>!</h3>
           <div class="ticker scroll">
        <div class="weeshlists mb-3">

            <span class="scroll-text1">
              <span class="logo"><small id="h5">Please make sure to fill out all the required fields.</small></span
            >
    </span>

        </div>
      </div>
          <label
            for="item-name"
            class="input-label col-sm-3 col-form-label text-sm-right mb-3 mt-2"
            >Item name:<span class="text-danger"> *</span></label
          >
          <div class="col-sm-9 mb-3 mt-2">
            <input
              type="text"
              class="form-control rounded-pill input-field"
              id="item-name"
              name="itemName"
              placeholder="e.g. Cropped top"
            />
          </div>

          <label
            for="brand"
            class="input-label col-sm-3 col-form-label text-sm-right mb-3 mt-2"
            >Brand:</label
          >
          <div class="col-sm-9 mb-3 mt-2">
            <input
              type="text"
              class="form-control rounded-pill input-field"
              id="brand"
              name="brand"
              placeholder="e.g. Zara"
            />
          </div>
          <label
            for="category-id"
            class="input-label col-sm-3 col-form-label text-sm-right mb-3 mt-2"
            >Category: <span class="text-danger"> *</span></label
          >
          <div class="col-sm-9 mb-3 mt-2 ">
            <select
              name="category_id"
              id="category-id"
              class="form-control rounded-pill input-field  "
            >
              <option value="" selected disabled>-- All -- </option>
            
              <?php while($row = $results_cat->fetch_assoc()): ?>
              <option value="<?php echo $row['cat_id']; ?>">
                <?php echo $row['cat_name'] ?>
            </option>
            <?php endwhile; ?>

            </select>
          </div>
          <label
            for="image-url"
            class="input-label col-sm-3 col-form-label text-sm-right mb-3 mt-2"
            >Image URL:</label
          >
          <div class="col-sm-9 mb-3 mt-2">
            <input
              type="text"
              class="form-control rounded-pill input-field"
              id="image-url"
              name="imgurl"
              placeholder="https://example.com"
            />
          </div>
          <label
            for="item-url"
            class="input-label col-sm-3 col-form-label text-sm-right mb-3 mt-2"
            >Item URL: <span class="text-danger"> *</span></label
          >
          <div class="col-sm-9 mb-3 mt-2">
            <input
              type="text"
              class="form-control rounded-pill input-field"
              id="item-url"
              name="itemurl"
              placeholder="https://example.com"
            />
          </div>
          <div class="col-4 form-group row">
            <div id="btns">
              <button type="submit" class="btn btn-dark rounded-pill">
                Add item
              </button>
            </div>
          </div>
        </div>

        <!-- .form-group -->
      </form>
    </div>
    <div id="footer">Weeshlists by Nemsiss Shahbazian &copy; 2022</div>
  </body>
</html>
