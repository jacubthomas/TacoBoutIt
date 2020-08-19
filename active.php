<?php
// Import this config php file
// this brings in the  DB credentials saved as constants
require "config/config.php";

// DB Connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
    echo $mysqli->connect_error;
    exit();
}

$sql = "SELECT table_id, order_sum, total FROM `_table_`;";
    
$results = $mysqli->query($sql);
if ( $results == false ) {
    echo $mysqli->error;
    exit();
}

$mysqli->set_charset('utf8');
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taco 'bout it: Order log</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  </head>
  <body>
    <div id="master_div" class="container-fluid mt-0 mx-auto px-0" style="background-color:#F8F4F1">
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
                          <a href="index.php" class="menu_link" style="text-decoration: none">
                              <h6>Menu</h6></a>
                      </li>
                      <li>
                        <a href="active.php" class="menu_link" style="text-decoration: none; color:#FFD151"><h6>Order log</h6></a>
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
        <div id="active_div"class="p-0">
            <table id="active_table"class="table table-hover">
                <thead class="thead">
                    <trstyle="border-color:black;">
                        <th>Table</th>
                        <th>Order</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $results->fetch_assoc() ) : ?>
                        <tr>
                            <td><?php echo $row['table_id']; ?></td>
                            <td><?php echo $row['order_sum']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
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
