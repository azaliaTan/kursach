<?php

if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>


<?php 

if(isset($_GET['id'])){

    $get_id=$_GET['id'];
    $sql="SELECT * FROM cat_otz WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $kat=$result ->fetch(); }


if(isset($_POST['red'])){
    $name=$_POST['name'];
  
   

 
    $error_name='';

    



    if($name === ''){
        $error_name = "Введите заголовок новости!";
    }else if (strlen($name) < 5 || strlen($name)>50 ) {
        $error_name = "Некорректное количество символов";
    } 

    
  

    if(empty($error_name)   ){
       
        $sql =  $sql = "UPDATE cat_otz SET name='$name' WHERE id='$get_id'";
      $link->query($sql);
      echo '<script>document.location.href="?page=admin_kontent"</script>';
   
        }
    
    }?>


<div class="container">
    <div class="forma">
        <p class="Name">Редактировать категорию отзывов</p>

        <form method="POST" name="red" class="form_inner" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Название категории*</label>
                <input type="text" name="name" value=<?=$kat['name']?>>
            </div>
            <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>
        
            



            
            <button type="submit" name="red" class="but_sub">сохранить</button>
        </form>
        
      
    </div>
   </div>
