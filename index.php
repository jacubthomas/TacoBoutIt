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

$mysqli->set_charset('utf8');


$sql_drinks = "SELECT item_id,  item.name AS name, description, price, category.name AS category
FROM item
LEFT JOIN category
    ON item.category_id = category.category_id
WHERE item.category_id = 1;";
$results_drinks = $mysqli->query($sql_drinks);
if ( $results_drinks == false ) {
    echo $mysqli->error;
    exit();
}
$sql_apps = "SELECT item_id,  item.name AS name, description, price, category.name AS category
FROM item
LEFT JOIN category
    ON item.category_id = category.category_id
WHERE item.category_id = 2;";
$results_apps = $mysqli->query($sql_apps);
if ( $results_apps == false ) {
    echo $mysqli->error;
    exit();
}
$sql_entrees = "SELECT item_id,  item.name AS name, description, price, category.name AS category
FROM item
LEFT JOIN category
    ON item.category_id = category.category_id
WHERE item.category_id = 3;";
$results_entrees = $mysqli->query($sql_entrees);
if ( $results_entrees == false ) {
    echo $mysqli->error;
    exit();
}
$sql_desserts = "SELECT item_id,  item.name AS name, description, price, category.name AS category
FROM item
LEFT JOIN category
    ON item.category_id = category.category_id
WHERE item.category_id = 4;";
$results_desserts = $mysqli->query($sql_desserts);
if ( $results_desserts == false ) {
    echo $mysqli->error;
    exit();
}
    
    $sql_items = "SELECT item_id,  item.name AS name, description, price
    FROM item;";
    $results_items = $mysqli->query($sql_items);
    if ( $results_items == false ) {
        echo $mysqli->error;
        exit();
    }
    
$sql_tables = "SELECT table_id FROM `_table_`;";
$results_tables = $mysqli->query($sql_tables);
if ( $results_tables == false ) {
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
    <title>Taco 'bout it: Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
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
        <div id="menu_box">
        <form action="running_tab.php" method="POST">
            <div class="label">
                <h3>Beverages</h3>
            </div>
            <div class="item_img">
                <img src="https://images.unsplash.com/photo-1541975902628-b157a9411603?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1947&q=80";>
            </div>
            <div class="show p-0">
                <table class="table table-hover table-responsive p-0">
                    <thead class="thead"  bgcolor= "#B02E0C" style="color:white; border-color:#B02E0C;">
                        <tr style="border-color:black;">
                            <th style="border-color:#B02E0C;">Drink</th>
                            <th style="border-color:#B02E0C;">Description</th>
                            <th style="border-color:#B02E0C;">Price</th>
                            <th style="border-color:#B02E0C;">Quantity</th>
                            <!-- <th style="border-color:#B02E0C;">Select</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ( $row = $results_drinks->fetch_assoc() ) : ?>
                            <tr>
                                <td class="menu_name"><input type="hidden" name="drinks[]" value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></input></td>
                                <td><?php echo $row['description']; ?></input></td>
                                <td><input type="hidden" name="drink_prices[]" value="<?php echo $row['price']; ?>"><?php echo $row['price']; ?></input></td>
                                <td><input type="number" class="mx-auto quant" name="quantity[]"></td>
                                <!--
                                <td class="form-check form-check-inline">
                                    <input type="checkbox" name="order[]" value="<?php echo $row['name']; ?>" class="form-check-input m-auto">
                                </td> --> <!-- .form-check -->
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="label">
                <hr>
                <h3>Appetizers</h3>
            </div>
            <div class="item_img">
                <img src="https://images.unsplash.com/photo-1570716774271-ab30ad4924a8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80";>
            </div>
            <div class="show p-0">
            <table class="table table-hover table-responsive p-0">
                <thead class="thead"  bgcolor= "#B02E0C" style="color:white; border-color:#B02E0C;">
                        <tr style="border-color:black;">
                           <th style="border-color:#B02E0C;">Dish</th>
                           <th style="border-color:#B02E0C;">Description</th>
                           <th style="border-color:#B02E0C;">Price</th>
                           <th style="border-color:#B02E0C;">Quantity</th>
                           <!-- <th style="border-color:#B02E0C;">Select</th> -->
                       </tr>
                   </thead>
                   <tbody>
                       <?php while ( $row = $results_apps->fetch_assoc() ) : ?>
                           <tr>
                               <td class="menu_name"><input type="hidden" name="apps[]" value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></input></td>
                               <td><?php echo $row['description']; ?></td>
                               <td><input type="hidden" name="app_prices[]" value="<?php echo $row['price']; ?>"><?php echo $row['price']; ?></input></td>
                               <td><input type="number" class="mx-auto quant" name="quantity[]"></td>
                                <!--
                               <td class="form-check form-check-inline">
                                    <input type="checkbox" name="order[]" value="<?php echo $row['name']; ?>" class="form-check-input m-auto">
                               </td> --> <!-- .form-check -->
                                
                           </tr>
                       <?php endwhile; ?>
                   </tbody>
               </table>
           </div>
            <div class="label">
                <hr>
                <h3>Entrees</h3>
            </div>
            <div class="item_img">
                <img src= "https://images.unsplash.com/photo-1512838243191-e81e8f66f1fd?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80";>
            </div>
            <div class="show p-0">
                <table class="table table-hover table-responsive p-0">
                    <thead class="thead"  bgcolor= "#B02E0C" style="color:white; border-color:#B02E0C;">
                        <tr style="border-color:black;">
                            <th style="border-color:#B02E0C;">Dish</th>
                            <th style="border-color:#B02E0C;">Description</th>
                            <th style="border-color:#B02E0C;">Price</th>
                            <th style="border-color:#B02E0C;">Quantity</th>
                            <!-- <th style="border-color:#B02E0C;">Select</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ( $row = $results_entrees->fetch_assoc() ) : ?>
                            <tr>
                                <td class="menu_name"><input type="hidden" name="entrees[]" value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></input></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><input type="hidden" name="entree_prices[]" value="<?php echo $row['price']; ?>"><?php echo $row['price']; ?></input></td>
                                <td><input type="number" class="mx-auto quant" name="quantity[]"></td>
                                <!--
                                <td class="form-check form-check-inline">
                                    <input type="checkbox" name="order[]" value="<?php echo $row['name']; ?>" class="form-check-input m-auto">
                                </td> --> <!-- .form-check -->
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="label">
                <hr>
                <h3>Desserts</h3>
            </div>
            <div class="item_img">
                <img src= "https://images.unsplash.com/photo-1505851498219-ee2449c18936?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80";>
            </div>
            <div class="show p-0">
                <table class="table table-hover table-responsive p-0">
                    <thead class="thead"  bgcolor= "#B02E0C" style="color:white; border-color:#B02E0C;">
                        <tr style="border-color:black;">
                            <th style="border-color:#B02E0C;">Dessert</th>
                            <th style="border-color:#B02E0C;">Description</th>
                            <th style="border-color:#B02E0C;">Price</th>
                            <th style="border-color:#B02E0C;">Quantity</th>
                            <!-- <th style="border-color:#B02E0C;">Select</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ( $row = $results_desserts->fetch_assoc() ) : ?>
                            <tr>
                                <td><input type="hidden" name="desserts[]" value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></input></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><input type="hidden" name="dessert_prices[]" value="<?php echo $row['price']; ?>"><?php echo $row['price']; ?></input></td>
                                <td><input type="number" class="mx-auto quant" name="quantity[]"></td>
                                <!--
                                <td class="form-check form-check-inline">
                                    <input type="checkbox" name="order[]" value="<?php echo $row['name'];?>" class="form-check-input m-auto">
                                </td> --><!-- .form-check -->
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <?php while ( $row = $results_items->fetch_assoc() ) : ?>
                <input type="hidden" name="items[]" value="<?php echo $row['name']; ?>">
                </input>
                <input type="hidden" name="prices[]" value="<?php echo $row['price']; ?>">
                </input>
            <?php endwhile; ?>
        </div>
    <div class="form-group row my-4 mx-auto">
        <label for="name-id" class="col-sm-3 col-form-label text-sm-right">
            Table #: <span class="text-danger">*</span>
        </label>
        <div class="col-4 mx-auto">
            <select name="_table_" id="table_id" class="form-control">
                <option> </option>
                <?php while ( $row = $results_tables->fetch_assoc() ) : ?>
                        <option><?php echo $row['table_id']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    <div class="form-group row my-4 mx-auto">
        <div class="column mx-auto">
            <button onclick="running_tab.php" id="submit" type="submit" class="btn btn-dark"
            style="background-color:#B02E0C;">Submit</button>
            <button type="reset" class="btn btn-dark" style="background-color:#B02E0C;">Reset</button>
        </div>
    </div> <!-- .form-group -->
    </form>
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

