<?php

require "config/config.php";

// DB Connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$mysqli->set_charset('utf8');

    
$sql_update =
"UPDATE `_table_` SET order_sum = '" . $_POST['order_post'] . "', total = " . $_POST['total'] . " WHERE table_id = " . $_POST['_table_'] . ";";
$results_update = $mysqli->query($sql_update);
if ( !$results_update ) {
    echo $mysqli->error;
    exit();
}

// Close DB Connection
$mysqli->close();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taco 'bout it: Order Confirmation</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  </head>
  <body>
    <div id="master_div" class="container-fluid mx-auto px-0" style="background-color:#F8F4F1">
    <div id="brand">
        <nav class="navbar navbar-dark row">
            <a href="#" class="col-10"style="text-decoration: none"><h1>Taco 'bout it </h1></a>
            <button class="navbar-toggler col-2" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          <div id="drop_nav" class="show mx-auto" id="navbarToggleExternalContent">
            <div class="p-4">
              <ul id="drop_list" class="">
                  <li>
                      <a href="index.php" class="menu_link" style="text-decoration: none; color:#FFD151">
                          <h6>Menu</h6></a>
                  </li>
                  <li>
                    <a href="active.php" class="menu_link" style="text-decoration: none"><h6>Order log</h6></a>
                  </li>
                  <li>
                      <a href="locations.php" class="menu_link" style="text-decoration: none"><h6>Locations</h6></a>
                  </li>
                  <li>
                      <a href="careers.php" class="menu_link" style="text-decoration: none"><h6>Careers</h6></a>
                  </li>
              </ul>
            </div>
          </div>
      </nav>
    </div>
        <h2 class="my-3"> Order Confirmed! </h2>
        <hr>
        <div class="m-3 py-4">
            <?php echo "<h4>Table: ". $_POST['_table_'] . "</h4><br>" . $_POST['order_post'] . "<br>" . "Total " . $_POST['total'];?>
        <div>
    </div>
</div>
</div>
    <div id="footer">
        <p>
        Created by <i> Jacob Harrington </i>
        </p>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
