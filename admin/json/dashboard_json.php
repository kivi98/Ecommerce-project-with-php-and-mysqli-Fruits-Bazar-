<?php 
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "ecommerce";

 $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

 
 if(isset($_POST['action'])){
    if($_POST['action']=='load_allorder'){
    $date = $_POST['did'];
    $dayquery = "SELECT * FROM all_order_info WHERE order_date BETWEEN ? and CURDATE();";
    $stmt = mysqli_prepare($connection, $dayquery);
    mysqli_stmt_bind_param($stmt, "s", $date);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $num_rows = mysqli_num_rows($result);
    echo $num_rows;
    }
    }

    if(isset($_POST['action'])){
        if($_POST['action']=='load_allsell'){
            $date = mysqli_real_escape_string($connection, $_POST['did']);
    
            $sumQuery = "SELECT SUM(`amount`) AS `sum` FROM `all_order_info` WHERE `order_date` BETWEEN '".$date."' and CURDATE();";
    
            $sum_row = mysqli_query($connection, $sumQuery);
            $asos = mysqli_fetch_assoc($sum_row);
            echo $asos['sum'];
    
        }
    }

    if(isset($_POST['action'])){
        if($_POST['action']=='load_allcustomer'){
            $date = $_POST['did'];
    
            $stmt = mysqli_prepare($connection, "SELECT * FROM `all_order_info` WHERE `order_date` BETWEEN ? and CURDATE() GROUP BY `customer_name`;");
            mysqli_stmt_bind_param($stmt, "s", $date);
            mysqli_stmt_execute($stmt);
    
            $cus_result = mysqli_stmt_num_rows($stmt);
            echo $cus_result;
    
            mysqli_stmt_close($stmt);
        }
    }


    if(isset($_POST['action']) && $_POST['action']=='load_delivered_order'){
        $date = mysqli_real_escape_string($connection, $_POST['did']);
    
        $deli_query = "SELECT * FROM `all_order_info` WHERE (`order_date` BETWEEN ? and CURDATE()) AND `order_status`=2";
    
        $deli_stmt = mysqli_prepare($connection, $deli_query);
        mysqli_stmt_bind_param($deli_stmt, "s", $date);
        mysqli_stmt_execute($deli_stmt);
        $deli_result = mysqli_stmt_get_result($deli_stmt);
        echo mysqli_num_rows($deli_result);
    }

    if(isset($_POST['action']) && $_POST['action'] == 'load_processing_order'){
        $date = mysqli_real_escape_string($connection, $_POST['did']);
    
        $pros_query = "SELECT * FROM `all_order_info` WHERE (`order_date` BETWEEN '".$date."' and CURDATE()) AND `order_status`=1";
    
        $pros_row = mysqli_query($connection, $pros_query);
        if($pros_row){
            $pros_result = mysqli_num_rows($pros_row);
            echo $pros_result;
        }
    }
    

    if(isset($_POST['action'])){
        if($_POST['action']=='load_pending_order'){
            $date = $_POST['did'];
    
            $pen_query = "SELECT * FROM `all_order_info` WHERE (`order_date` BETWEEN ? and CURDATE()) AND `order_status`=0";
            $pen_stmt = mysqli_prepare($connection, $pen_query);
            mysqli_stmt_bind_param($pen_stmt, "s", $date);
            mysqli_stmt_execute($pen_stmt);
            $pen_result = mysqli_stmt_get_result($pen_stmt);
            $pen_rows = mysqli_num_rows($pen_result);
            echo $pen_rows;
        }
    }
    
?>