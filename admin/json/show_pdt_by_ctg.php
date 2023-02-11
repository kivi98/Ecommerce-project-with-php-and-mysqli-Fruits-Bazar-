

<?php 
// include ("../class/adminback.php");
//     $obj = new adminback();

        $dbhost = "localhost";
        $dbuser = "root";
        $dbpass = "";
        $dbname = "ecommerce";

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);


    if(isset($_POST['action'])){
        if($_POST['action']=='load_product'){
            $cataId= $_POST['cid'];
            $query = "SELECT * FROM `product_info_ctg` WHERE ctg_id=$cataId AND pdt_status=1";

           
            if ($stmt = mysqli_prepare($connection, "SELECT pdt_id, pdt_name FROM products")) {
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $pdt_id, $pdt_name);
                $html = '';
                while (mysqli_stmt_fetch($stmt)) {
                    $html .= '<option value="'.$pdt_id.'">'.$pdt_name.'</option>';
                }
                echo $html;
                mysqli_stmt_close($stmt);
            }
        }
    }




    if(isset($_POST['action']) && $_POST['action']=='load_price'){
        $pId = intval($_POST['pid']);
        $pricequery = "SELECT `pdt_price` FROM `product_info_ctg` WHERE `pdt_id`=? AND `pdt_status`=1";

        $stmt = mysqli_prepare($connection, $pricequery);
        mysqli_stmt_bind_param($stmt, "i", $pId);
        mysqli_stmt_execute($stmt);
        $price_result = mysqli_stmt_get_result($stmt);

        if ($price = mysqli_fetch_array($price_result, MYSQLI_ASSOC)) {
            echo $price["pdt_price"];
        }
    }



    if(isset($_POST['action'])){
        if($_POST['action']=='total_price'){
            $pdtId = $_POST['pdt_id'];
            $quantity = $_POST['quantity'];
    
            $singlepricequery = "SELECT pdt_price FROM `product_info_ctg` WHERE `pdt_id`=? AND pdt_status=1";
    
            $stmt = mysqli_prepare($connection, $singlepricequery);
            mysqli_stmt_bind_param($stmt, "i", $pdtId);
            mysqli_stmt_execute($stmt);
            $prices_res = mysqli_stmt_get_result($stmt);
    
            if ($price_row = mysqli_fetch_array($prices_res)) {
                $single_price = $price_row["pdt_price"];
                echo $single_price * $quantity;
            } else {
                echo "Product not found";
            }
        }
    }
    

?>

    

