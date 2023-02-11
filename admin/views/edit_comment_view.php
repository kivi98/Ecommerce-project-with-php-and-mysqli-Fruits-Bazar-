<?php 
    if(isset($_GET['status'])){
        $comment_id = $_GET['id'];
        if($_GET['status']=='editcomment'){
            
           $array =  $obj->edit_comment($comment_id);
           $row = mysqli_fetch_assoc($array);

        }
    }

    if(isset($_POST['update_comment'])){
       $update_msg =  $obj->update_comment($_POST);
    }

?>



<form action="#" method="POST">

<h5 class="text-success">
    
<?php 
    if(isset($update_msg)){
        echo $update_msg;
    }
?>
</h5> <br> <br>
    
        <h5>User Id: <?php echo htmlspecialchars($row['user_id'], ENT_QUOTES, 'UTF-8'); ?> </h5> <br>
        <h5>User Name: <?php echo htmlspecialchars($row['user_name'], ENT_QUOTES, 'UTF-8' ) ?> </h5> <br>
        <h5>Product Id: <?php echo htmlspecialchars($row['pdt_id'], ENT_QUOTES, 'UTF-8' ) ?> </h5> <br>

        <h5>Comment: </h5> <br>
        
   

    <div class="form-group">
        <input type="hidden" name="cmt_id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8' ) ?>">
        <textarea name="u_comment" id="" cols="30" rows="10"><?php echo htmlspecialchars($row['comment'], ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="update comment" name="update_comment" class="btn btn-lg btn-primary">
    </div>

    
</form>
