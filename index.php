<?php 
include('db.php'); //Database Connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filters</title>
    <!-- JQUERY CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- Filter Content -->
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h5>Brand</h5>
            <div class="list-group">
                <?php
                $query = "SELECT product_brand FROM brand";
                $statement = $connect->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                foreach($result as $row)
                {
                ?>
                    <div class="list-group-item checkbox">
                        <label>
                            <input type="checkbox" class="filter_all pro_brand" value="<?php echo $row['product_brand']; ?>">
                            <?php echo $row['product_brand']; ?>
                        </label>
                    </div>
                    <?php
                }
                ?>
            </div>
            <h5>Type</h5>
            <div class="list-group">                   
                <?php
                $query = "SELECT product_type FROM type";
                $statement = $connect->prepare($query);
                $statement->execute();
                $result = $statement->fetchAll();
                foreach($result as $row)
                {
                ?>
                        <div class="list-group-item checkbox">
                            <label>
                                <input type="checkbox" class="filter_all pro_type" value="<?php echo $row['product_type']; ?>">
                                <?php echo $row['product_type']; ?>
                            </label>
                        </div>
                        <?php
                }
                ?>
            </div>
    </div>
    <div class="col-md-9">
        <div class="row filter_data"> </div>
    </div>
</div>
</div>

<script>
$(document).ready(function() {

    filter_data();

    function filter_data() {
        $('.filter_data');
        var action = 'fetch_data';
        var pro_type = get_filter('pro_type');
        var pro_brand = get_filter('pro_brand');
        $.ajax({
            url: "fetch_filter.php",
            method: "POST",
            data: {
                action: action,
                pro_type: pro_type,
                pro_brand: pro_brand,
            },
            success: function(data) {
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ":checked").each(function() {
            filter.push($(this).val());
        });
        return filter;
    }

    $('.filter_all').click(function() {
        filter_data();
    });

});
</script>
</body>
</html>