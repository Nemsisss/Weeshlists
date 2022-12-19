<?php 
 require './config/config.php';
    if ( !isset($_SESSION['logged_in']) ||  $_SESSION['logged_in']==false) {
      // User IS NOT logged in.
      header('Location: ./index.php');
    }
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if( $mysqli->connect_errno)
    {
      echo $mysqli->connect_error;
    }
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
    <title>View</title>
    
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
      #btns {
        font-family: regular, Arial, Arial;
      }
      .button{
        margin-top:50px;
      }
      .btn-dark {
        background-color: black;
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
      #category-id  {
        font-family: regular, Arial, Arial;
      }
      h3, #h5{
        font-family: regular, Arial, Arial;
  
      }
      body{
        background-color: #fcf1e1;
      }

      .container{
        height: 77vh;
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
                  <a class="dropdown-item" aria-current="page" href="view.php">View my wishlist</a>
                </li>
                <li>
                  <a class="dropdown-item"  href="add.php"
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
    <div id="search_form" class="container mt-5 d-flex aligns-items-center justify-content-center ">
      <form action="view_results.php" method="GET">
      <input type="hidden" name="user_id" value="<?php echo $user_id['user_id'];?>">
        <div class="col-12 col-md-10 col-lg-8 col-xl-7 mb-4 mt-4 form-group row mx-auto ">
           <h3>Search your wishlist using the following filters</h3>
           <div class="ticker scroll">
        <div class="weeshlists">


                <span>
              <small id="h5">Or simply click on search to view all of your <em>Weeshlist</em> !</small></span>

        </div>
      </div>
        </div>
        <div class="col-12 col-md-10 col-lg-8 col-xl-7 form-group row mx-auto">
          <label
            for="item-name"
            class="input-label col-sm-3 col-form-label text-sm-right m1-3 mt-2"
            >Item name:</label
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
            class="input-label col-sm-3 col-form-label text-sm-right mb-1 mt-2"
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
            class="input-label col-sm-3 col-form-label text-sm-right mb-1 mt-2"
            >Category:</label
          >
          <div class="col-sm-9 mb-1 mt-2">
    
            <select
              name="category_id"
              id="category-id"
              class="form-control rounded-pill input-field"
            >
            
              <option value="" disabled selected>-- All --</option>
              <?php while($row = $results_cat->fetch_assoc()): ?>
              <option value="<?php echo $row['cat_id']; ?>">
                <?php echo $row['cat_name'] ?>
            </option>
            <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group row button">
            <div id="btns">
              <button type="submit" class="btn btn-dark rounded-pill">
                Search
              </button>
            </div>
          </div>
        </div>
        <!-- .form-group -->
      </form>
    </div>
    <div id="footer">Weeshlists by Nemsiss Shahbazian &copy; 2022</div>
    <!-- .container -->
  </body>
</html>
