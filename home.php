<?php 
require './config/config.php';
if ( !isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false ) 
{ 
   header('Location: ./index.html'); 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homepage</title>

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
      #header,
      h2 {
        font-family: "regular", Arial, Arial;
      }
      #header h1 {
        padding-top: 50px;

        font-family: "yesevaone", Arial, Arial;
        color: black;
      }
      #button-addon2 {
        background-color: black !important ;
        font-family: "regular", Arial, Arial !important;
        color: white !important;
        border-top-right-radius: 90px;
        border-bottom-right-radius: 90px;
        width: 90px;
      }
      #button-addon2:hover {
        background-color: #e36866 !important ;
        border-color: #e36866 !important;
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
        color: #e36866;
      }
      .card-text,
      #emphText {
        font-family: "regular", Arial, Arial;
      }
      .scroll-text1,
      .scroll-text2 {
        font-family: "regular", Arial, Arial;
        font-size: medium;
        color: white !important;
        line-height: 50px;
      }
      .logo {
        font-family: "yesevaone", Arial, Arial;
        color: #e36866;
        font-size: larger !important;
      }
      #emphText {
        color: maroon;
      }
      body {
        background-color: #fcf1e1;
      }
      .form-control {
        outline: none !important;
        border-radius: 90px;
      }

      .scroll {
        width: 100%;
        height: 50px;
        background-color: black;
        margin-bottom: 50px;
      }
      #search-form {
        margin-bottom: 160px;
      }
      #items-container {
        margin-top: 70px;
      }
      .hidden {
        opacity: 0;
      }
      .marquee-container {
        height: 60px;
        overflow: hidden;
        line-height: 60px;
        background-color: black;
        color: white;
      }
      .marquee {
        top: 0;
        left: 100%;
        width: 100%;
        overflow: hidden;
        position: absolute;
        white-space: nowrap;
        animation: marquee 26s linear infinite;
      }

      .marquee2 {
        animation-delay: 13s;
      }
      b {
        padding-left: 10px;
      }

      @keyframes marquee {
        0% {
          left: 100%;
        }
        100% {
          left: -100%;
        }
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
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
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
    <!-- header -->
    <div id="header" class="container-fluid mb-3">
      <div class="col-10 col-lg-10 container ml-5">
        <h1>
          Some
          <br />Recommendations<br />
          For You
        </h1>
      </div>
      <div class="col-10 mt-4 mx-auto">
        <form id="search-form">
          <div class="row">
            <div class="col-12 input-group">
              <div class="col-10 col-sm-10 col-md-8 col-lg-7 col-xl-6 mx-auto">
                <label for="label-id" class="col-form-label"
                  >Search by keyword</label
                >
                <div class="input-group mb-3">
                  <input
                    name="label_id"
                    id="label-id"
                    type="text"
                    class="form-control"
                    placeholder="e.g. lamps..."
                  />
                  <button
                    class="btn btn-outline"
                    type="submit"
                    id="button-addon2"
                  >
                    Search
                  </button>
                </div>
                <small class="form-text text-danger">
                  <em class="hidden" id="emphText"
                    >Please enter a keyword to search!</em
                  >
                </small>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!--source: https://codepen.io/girish/pen/dgWqBr -->
      <div class="position-relative marquee-container d-none d-sm-block">
        <div class="marquee d-flex justify-content-around">
          <span class="txt">
            <b>
              <span class="logo">Weeshlits </span>helps you to keep all your
              wishlists in one place! Never lose track of your favorite
              items.</b
            >
          </span>
        </div>
        <div class="marquee marquee2 d-flex justify-content-around">
          <span class="txt">
            <b>
              <span class="logo">Weeshlits </span> helps you to keep all your
              wishlists in one place! Never lose track of your favorite
              items.</b
            >
          </span>
        </div>
      </div>
    </div>

    <!-- gallery of suggestions to be filled with items returned by API -->
    <div class="container">
      <div id="items-container" class="col-10 row mx-auto">
      
      </div>
    </div>

    <div id="footer">Weeshlists by Nemsiss Shahbazian &copy; 2022</div>
    <script src="http://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
      let limit = 12;
      //populate default recommendations
      const defaultRecs = {
        async: true,
        crossDomain: true,
        url:
          "https://kohls.p.rapidapi.com/products/list?limit=" +
          limit +
          "&offset=1&keyword=modern+lamps",
        method: "GET",
        dataType: "json",
        headers: {
          "X-RapidAPI-Key":
            "80f4217213msh3deaef20a3aee86p188209jsn2412218ffe01",
          "X-RapidAPI-Host": "kohls.p.rapidapi.com",
        },
      };
      $.ajax(defaultRecs)
        .then((response) => {
          
          document.querySelector("#items-container").innerHTML = "";
          for (let i = 0; i < response.payload.products.length; i++) {
            createCard(response.payload.products[i]);
          }
        })
        .fail((error) => {
          alert("AJAX error!");
        });
      document.querySelector("#search-form").onsubmit = function () {
        const searchKeyword = document.querySelector("#label-id").value.trim();

        if (searchKeyword.length > 0) {
   
          document.querySelector(".hidden").style.opacity = 0;
          const search = {
            async: true,
            crossDomain: true,
            url:
              "https://kohls.p.rapidapi.com/products/list?limit=" +
              limit +
              "${limit}&offset=1&keyword=" +
              searchKeyword,
            method: "GET",
            headers: {
              "X-RapidAPI-Key":
                "80f4217213msh3deaef20a3aee86p188209jsn2412218ffe01",
              "X-RapidAPI-Host": "kohls.p.rapidapi.com",
            },
          };
          $.ajax(search)
            .then((data) => {
              limit = 12;
              document.querySelector("#items-container").innerHTML = "";
              document.querySelector("#label-id").value = "";

              if (data.payload.products.length > 0) {
                if (data.payload.products.length < 8) {
                  limit = data.payload.products.length;
                }
                for (let i = 0; i < limit; i++) {
                  createCard(data.payload.products[i]);
                }
              } else {
                // NO RESULTS FOUNDF
                createNotFound();
              }
            })
            .fail((error) => {
              alert("AJAX error!");
            });
        } else {
          document.querySelector(".hidden").style.opacity = 1;
        }
        return false;
      };
      const createNotFound = function () {
        const h2 = document.createElement("h2");
        h2.innerHTML = "No results found.";
        document.querySelector("#items-container").appendChild(h2);
      };

      const createCard = function (item) {
        const outerdiv = document.createElement("div");
        const img = document.createElement("img");
        const innerdiv = document.createElement("div");
        const h5 = document.createElement("p");
        const p1 = document.createElement("p");
        const p2 = document.createElement("p");
        const a = document.createElement("a");
        const br = document.createElement("br");
        outerdiv.classList.add(
          "col-12",
          "col-md-3",
          "col-lg-3",
          "col-xl-4",
          "card",
          "mx-auto",
          "mt-5"
        );
        if (!item.image.url) {
          img.src = "https://via.placeholder.com/300";
        } else {
          img.src = item.image.url;
        }
        img.classList.add("card-img", "mt-2");
        img.alt = "Card image cap";
        innerdiv.classList.add("card-body");
        h5.classList.add("card-title");
        h5.innerHTML = item.productTitle;
        p1.classList.add("card-text");
        p2.classList.add("card-text");
        p1.innerHTML =
          "Price: $" +
          (item.prices[0].regularPrice.minPrice
            ? item.prices[0].regularPrice.minPrice
            : "N/A");
        p2.innerHTML =
          "Rating: " +
          (item.rating.avgRating ? item.rating.avgRating + "/5" : "N/A");
        a.href = "https://www.kohls.com/" + item.seoURL;
        a.classList.add("btn", "btn-dark", "mt-4", "rounded-pill");
        a.innerHTML = "Visit";
        a.target = "_blank";
        outerdiv.appendChild(img);
        outerdiv.appendChild(innerdiv);
        innerdiv.appendChild(h5);
        innerdiv.appendChild(p1);
        innerdiv.appendChild(p2);
        innerdiv.appendChild(a);
        document.querySelector("#items-container").appendChild(outerdiv);
      };
    </script>
  </body>
</html>
