<?php
if ( !isset($_POST['_table_']) || empty($_POST['_table_']) ) {

    // Missing required fields.
    $error = "Please ensure you have selected your table prior to submitting.<br><br>";
    echo "<div id='error_page'class='container-fluid'><span style='color: red'>" . $error . "</span> " . "<button onclick='index.php' id='prev_page' type='button' class='btn btn-primary'>
    <a id='error_link' href='index.php' style='text-decoration:none'>Previous page</a>
        </button></div>";
} else
{
    // All required fields provided.
    require "config/config.php";
    
    // DB Connection
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ( $mysqli->errno ) {
        echo $mysqli->error;
        exit();
    }
    $num_results = 0;
//    if(isset($_POST["order"]) && !empty($_POST["order"]) &&
//       isset($_POST["quantity"]) && !empty($_POST["quantity"])
//       && $_POST["quantity"] >= 1)
    foreach( $_POST["items"] as $key=>$item )
    {
        $items[] = $item;
    }
    foreach( $_POST["prices"] as $key=>$price )
    {
        $prices[] = $price;
    }

    if( isset($_POST["quantity"]) && !empty($_POST["quantity"])
           && $_POST["quantity"] >= 1)
    {
        
        foreach( $_POST["quantity"] as $key=>$quantity )
        {
            $quantities[] = $quantity;
        }
        
    }
    $sql_tab = "SELECT item_id,  item.name AS name, description, price, category.name AS category FROM item LEFT JOIN category ON item.category_id = category.category_id;";
    $results_tab = $mysqli->query($sql_tab);
    $num_rows = $results_tab->num_rows;
    if ( $results_tab == false ) {
        echo $mysqli->error;
        exit();
    }
    $rows_all = array();
    for($i=0;$i<$num_rows;$i++)
    {
        $row = $results_tab->fetch_assoc();
        array_push($rows_all, $row);
    }
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Taco 'bout it: Running tab</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  </head>
  <body>
    <div id="master_div" class="container-fluid mx-auto px-0" style="background-color:#F8F4F1">
        <form action="add_order.php" method="POST">
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
            <h2 class="my-3"> Order Summary </h2>
            <hr>
            <h4> Table # <?php echo $_POST['_table_'] ?>
            </h4>
            <input type="hidden" name="_table_" value="<?php echo $_POST['_table_']?>"></input>
            <div id="order_sum"class=" row">
                <div class="order_col col-4 d-flex flex-column pt-4">
                    <?php
                        echo "<h5>Item</h5>";
                        for( $i = 0; $i<sizeof($quantities); $i++)
                        {
                            if($quantities[$i] > 0)
                            {
                                echo "<div>" . $items[$i] . "</div>";
                            }
                        }
                    ?>
                </div>
                <div class="order_col col-4 d-flex flex-column pt-4">
                        <?php
                            // Create a new array.
                            $quant_array = array();
                            echo "<h5>Quantity</h5>";
                                foreach ( $quantities as $quantity )
                                {
                                    if($quantity > 0)
                                    {
                                        echo "<div>" . $quantity  . "</div>";
                                        array_push($quant_array, $quantity);
                                    }
                                }
                        ?>
                </div>
                <?php $order_summary = ""; ?>
                <div class="order_col col-4 d-flex flex-column pt-4">
                        <?php
                            echo "<h5>Unit-price</h5>";
                            for( $i = 0; $i<sizeof($quantities); $i++)
                            {
                                if($quantities[$i] > 0)
                                {
                                    echo "<div>" . $prices[$i] . "</div>";
                                }
                            }
                            $subtotal = 0.0;
                            $i = 0;
                            for( $i=0; $i<sizeof($quantities); $i++)
                            {
                                if($quantities[$i] > 0)
                                {
                                    $subtotal += ( $prices[$i] * $quantities[$i] );
                                    $order_summary .= $quantities[$i] . " " . $items[$i] . "<br>";
                                }
                            }
                        ?>
                </div>
                <input type="hidden" name="order_post" value="<?php echo $order_summary ?>"></input>
                <div class="order_col col-12 d-flex flex-row">
                    <div class="col-12">
                    <br>
                    <hr>
                    </div>
                </div>
                <div class="order_col col-12 d-flex flex-row pt-5">
                    <div class="col-10">
                        <?php
                            echo "Subtotal:";
                        ?>
                    </div>
                    <div class="col-2">
                        <?php
                            echo number_format($subtotal, 2, '.', '');
                        ?>
                    </div>
                </div>
                <div class="order_col col-12 d-flex flex-row">
                    <div class="col-10">
                        <?php
                            echo "Tax:";
                        ?>
                    </div>
                    <div class="col-2">
                        <?php
                            echo number_format($subtotal * 0.08, 2, '.', '');
                        ?>
                    </div>
                </div>
                <div class="order_col col-12 d-flex flex-row">
                    <div class="col-10">
                        <?php
                            echo "Total:";
                        ?>
                    </div>
                    <div class="col-2">
                        <?php
                            $total = number_format($subtotal + $subtotal * 0.08, 2, '.', '');
                            echo $total;
                        ?>
                        <input type="hidden" name="total" value="<?php echo $total ?>"></input>
                    </div>
                </div>
                <div class="col-7">
                </div>
                <div class="col-5 py-4 pl-2 pr-5 form-group">
                    <button onclick="add_order.php" type="submit" class="btn" style="background-color:#B02E0C; color:white;">
                        Confirm Order
                    </button>
                </div>
            </div>
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
