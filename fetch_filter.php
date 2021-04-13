<?php
include('db.php'); //Database connection

if (isset($_POST["action"])) {
    $query= "SELECT * FROM products WHERE status='1'";
    
    if (isset($_POST["pro_type"])) {
        $type_filter = implode("','", $_POST["pro_type"]);
        $query.= "AND product_type IN('" . $type_filter . "')";
    }
    if (isset($_POST["pro_brand"])) {
        $brand_filter = implode("','", $_POST["pro_brand"]);
        $query.= "AND product_brand IN('" .$brand_filter. "')";
    }   
    $statement = $connect->prepare($query);
    $statement->execute();
    $result    = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output    = '';
    if ($total_row > 0) {
        foreach ($result as $row) {
            $output .= '
                <div class="col-md-4 col-sm-6 borderoverall">
                <div class="filter-grid">
                    <div class="filter-image">
                        <a href="#">
                            <img class="pic" src="image/' . $row['product_image'] . '">
                        </a>
                    </div>
                    <div class="description">
                        <h3 class="title">'. $row['product_name'] .'</h3>
                        <br/>
                            Brand: '.$row['product_brand'].' <br/>
                            Type: '.$row['product_type'].' <br/>
                            Price: '.$row['product_price'].' <br/>
                        </p>
                    </div>
                </div>
                </div>';
        }
    } else {
        $output = '<h3>0 results found</h3>';
    }
    echo $output;
}
?>







