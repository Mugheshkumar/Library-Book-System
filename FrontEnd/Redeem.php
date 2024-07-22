<?php
session_start();

if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
    // Redirect to the login page
    header("Location: ../FrontEnd/login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Redeem Page</title>
    <link rel="stylesheet" type="text/css" href="loginstyle.css" />
    <style>
      .btn {
        margin: 3px;
      }
    </style>
    <script>
      session_start();

      // Check if the user is logged in
      if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true) {
        // Redirect to the login page
        header("Location: ../FrontEnd/login.html");
        exit;
      }
    </script>
  </head>
  <body>
    <div class="topbar">
      <div class="left-items">
        <a id="logo" href="../FrontEnd/Homepage.html">Library Booking System</a>
      </div>
      <div class="right-items">
        <a
          id="Cart-link"
          class="right-link"
          style="font-family: InterVariable"
          href=""
        >
          <img src="../image/cart.png" alt="Home Image" style="height: 40px" />
        </a>
        <a id="home-link" class="right-link" style="font-family: InterVariable"
          >Home</a
        >
        <a
          id="redeem-link"
          class="right-link"
          href="../FrontEnd/SearchBookList.php"
          >Search Book List</a
        >
        <a id="about-link" class="right-link">About Us</a>
        <a id="profile-link" class="right-link">My Profile</a>

        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
      </div>
    </div>
    <br /><br /><br /><br />

    <div class="redeemBody">
      <div class="title-container">
        <h1>Redeem System</h1>
        <hr />
      </div>
      <div class="container-flex">
        <div><h1 style="opacity: 0">s</h1></div>
        <div class="left-side">
          <div class="container-image" style="height: 95px">
            <img src="../image/gala.png" />
            <div class="inner-container">
              <h4>Ticket To University Gala Night</h4>
              <h5>T&C Applied</h5>
              <button type="submit" styl class="btn" style="width: 350px">
                Redeem Points
              </button>
            </div>
            <p class="top-right" id="points">
              10 points
              <br />
              <br />
              <span id="endDate-1"
                >Expires in: <span id="date-left-1"></span
              ></span>
            </p>
          </div>
          <div class="container-image" style="height: 95px">
            <img src="../image/book.png" />
            <div class="inner-container">
              <h4>RM 10 waive for book purchase</h4>
              <h5>T&C Applied</h5>
              <button type="submit" class="btn" style="width: 350px">
                Redeem Points
              </button>
              <br />
            </div>
            <p class="top-right" id="points1">
              20 points
              <br />
              <br />
              <span id="endDate-2"
                >Expires in: <span id="date-left-2"></span
              ></span>
            </p>
          </div>
          <div class="container-image" style="height: 95px">
            <img src="../image/money.png" />
            <div class="inner-container">
              <h4>RM 100 waive for tuition fee</h4>
              <h5>T&C Applied</h5>
              <button type="submit" class="btn" style="width: 350px">
                Redeem Points
              </button>
            </div>
            <p class="top-right" id="points1">
              30 points
              <br />
              <br />
              <span id="endDate-3"
                >Expires in: <span id="date-left-3"></span
              ></span>
            </p>
          </div>
        </div>

        <div class="right-side">
          <div class="container">
            <div>
              <div class="point-container">
                <p>Accumulated Points</p>
                <p id="accumulated-points">Loading..</p>
              </div>
              <div class="point-container">
                <p>Redeemed Points</p>
                <p id="redeemed-points">Loading...</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="../backend/Redeem.Js"></script>
  </body>
</html>
