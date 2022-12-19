<?php 
require './config/config.php';
    if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false ) {
      // User IS NOT logged in.
      header('Location: ./index.html');
    }
    if(!isset($_GET['user_id']) || trim($_GET['user_id'])=='')
    {
      $nonFound="No results found.";
    }
    else
    {
      
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
      if( $mysqli->connect_errno)
      {
        echo $mysqli->connect_error;
      }
      $sql= "SELECT item_url, image_url, item_name, brand, category.cat_name, item_id
              FROM wishlist_item
              LEFT JOIN category
              ON wishlist_item.category_id=category.cat_id WHERE 1=1";
  
      
  $user_id= $_GET['user_id'];
  $sql=$sql. " AND user_id = $user_id ";
  
      if(isset($_GET['itemName']) && !empty($_GET['itemName']))
      {
          $item_name= $_GET['itemName'];
          $sql= $sql . " AND wishlist_item.item_name LIKE '%$item_name%'";
      }
      if(isset($_GET['brand']) && !empty($_GET['brand']))
      {
   
          $brand= $_GET['brand'];
          $sql= $sql . " AND wishlist_item.brand LIKE '%$brand%'";
      }
      if(isset($_GET['category_id']) && !empty($_GET['category_id']))
      {
          $category_id= $_GET['category_id'];
      
          $sql= $sql . " AND wishlist_item.category_id = $category_id ";
      }
      $sql= $sql . ';';
      $results= $mysqli->query($sql);
      if(!$results)
      {
        echo $mysqli->error;
        $mysqli->close();
        exit();
      }
    if(!$results->num_rows)
      {
          $nonFound="No results found.";
          // echo $nonFound;
  
      }

	$current_page=1;


	$results_per_page=12; //the second param
	$total_results= $results->num_rows;
	$last_page= ceil($total_results/$results_per_page);
	if(isset($_GET['page']) && trim($_GET['page'])!='')
	{
		$current_page=$_GET['page'];
	}
	else
	{
		$current_page=1; //default it to 1
	}
	//edge cases
	if($current_page<1 || $current_page> $last_page)
	{
		$current_page=1; //reset it to 1
	}
	$start_index=($current_page-1)* $results_per_page;

	$sql= rtrim($sql,';');

	$sql=$sql . " LIMIT $start_index, $results_per_page;";

	$results = $mysqli->query($sql);

	if ( !$results ) {
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
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
  rel="stylesheet"
/>
<title>View Results</title>

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

  body {
    background-color: #fcf1e1;
      
  }
.card .btn-dark:hover {
    background-color: #ff792b !important;
    color: white !important;
    border-color: #ff792b !important;
  }
  .btn-dark {
    font-family: "regular", Arial, Arial !important;
    background-color: black !important ;
  }
  .thumbnail {
    max-width: 100%;
  }

  .card {
    width: 15rem;
    margin-left: 2rem;
    margin-right: 2rem;
    border: 1px solid black;
    
  }
  .card-title {
    font-family: "yesevaone", Arial, Arial;
    
  }
  .card-text,
  #emphText {
    font-family: "regular", Arial, Arial;
  }
  .link{
    text-decoration: none;
    color: #e36866;
  }
  .link:hover{
    color: black;
  }
  h3{
    font-family: "regular", Arial, Arial;
  }
  .btn-dark {
    background-color: black;
  }
  .btn-outline-dark {
    color: black;
  }
  .btn-dark:hover, .btn-outline-dark:hover {
    background-color: #ff792b !important;
    color: white !important;
    border-color: #ff792b !important;
  }
  .logo , .pagination{
    font-family: regular, Arial, Arial;

  }
  #first{
    
    border-top-left-radius: 90px;
    border-bottom-left-radius: 90px;
  }
  #last{
    border-top-right-radius: 90px;
    border-bottom-right-radius: 90px;
  }

  #active{
    background-color: black !important;
    border-color: black !important;
  }
  .pbtn{
  color: black;
  border: 1px solid black !important;
  }
  .pbtn:hover{
    color:white;
    background-color:#ff792b !important;
    border-color: #ff792b !important;
  }

#body {
  background-color: white;
  border: 1px solid black !important;
  margin-top:50px;
  padding: 0;
  color: black;
  font-size: 120px;
  font-family: regular, Arial, Arial;
  font-weight: bold;
}

.marquee {
  position: relative;
  width: 100vw;
  max-width: 100%;
  height: 200px;
  overflow-x: hidden;
}

.track {
  position: absolute;
  white-space: nowrap;
  will-change: transform;
  animation: marquee 32s linear infinite;
}

/* marquee code is taken from https://codepen.io/Knovour/pen/boJNPN */
@keyframes marquee {
  from { transform: translateX(0); }
  to { transform: translateX(-50%); }
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
    <?php if (!isset($nonFound) && empty($nonFound)): ?>

          <div id="body" >
          <div class="marquee">
            <div class="track">
              <div class="content">
              Click on titles to explore more !    Click on titles to explore more !    Click on titles to explore more !    Click on titles to explore more !    Click on titles to explore more !
              </div>
            </div>
        </div>
      </div>


        <?php endif;?>

    <!-- card container -->
    <div class="container ">

      <div id="items-container" class="col-10 row mx-auto  ">
        <?php if (!isset($nonFound) && empty($nonFound)): ?>
        <?php while ($row= $results->fetch_assoc()):?>
        <!-- cards -->
        <div class="col-12 col-md-3 col-lg-3 col-xl-4 card mx-auto mt-5 ">
        <img class="card-img img-fluid mt-2" src="<?php echo $row['image_url']; ?>" alt="Item image" />
        <div class="card-body ">
          <div>          <p class="card-title"> <a class="link" target="_blank" href="<?php echo $row['item_url']; ?>"><?php echo $row['item_name'] ?></a></p>
          <p class="card-text">Brand: <?php  if($row['brand']){ echo $row['brand']; } else{echo "N/A" ; }  ?></p></div>
        </div>
        <div class="btns mb-3">   
             <a href="edit.php?user_id=<?php echo urlencode($user_id)."&item_id=". urlencode($row['item_id']);?>" class="btn btn-outline-dark mt-4 rounded-pill ">Edit </a>
          <a href="delete.php?item_id=<?php echo urlencode($row['item_id']). "&item_name=". urlencode($row['item_name'])."&user_id=".urlencode($user_id);?>" class="btn btn-dark mt-4 rounded-pill ">Delete </a>
        </div> 
      </div>

      <?php endwhile; ?>
      <?php else: ?>
        <div class="row mt-5 mb-3 nonfound">
             <h3><?php echo $nonFound;?></h3>
             </div>
             <form action="view.php">
             <input
             type="submit"
             value="Go Back"
             class="btn btn-dark rounded-pill"
             >
             </form>

        <?php endif; ?>
      </div>
    </div>
    <div class="col-12 mt-5">
				<nav aria-label="Page navigation ">
					<ul class="pagination justify-content-center">
						<li  class="page-item <?php if($current_page<=1){echo 'disabled';} ?>">
							<a id="first" class="page-link pbtn" href="<?php 
							$_GET['page']=1; 
							echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
							 ?>">First</a>
						</li>
						<li class="page-item <?php if($current_page<=1){echo 'disabled';} ?>">
							<a class="page-link pbtn" href="<?php 
							$_GET['page']= $current_page-1; 
							echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
							 ?>">Previous</a>
						</li>
						<li class="page-item active">
							<a  id="active" class="page-link" href=""><?php echo $current_page; ?></a>
						</li>
						<li class="page-item  <?php if($current_page>=$last_page){echo 'disabled';} ?>">
							<a class="page-link pbtn" href="<?php 
							$_GET['page']=$current_page+1; 
							echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
							 ?>">Next</a>
						</li>
						<li class="page-item <?php if($current_page>=$last_page){echo 'disabled';} ?>">
							<a id="last" class="page-link pbtn" href="<?php 
							$_GET['page']= $last_page; 
							echo $_SERVER['PHP_SELF'] . "?" . http_build_query($_GET);
							 ?>">Last</a>
						</li>
					</ul>
				</nav>
			</div> 
    <div id="footer">Weeshlists by Nemsiss Shahbazian &copy; 2022</div>

</body>

</html>