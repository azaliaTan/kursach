<?php

if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>


<?php 

$name='';

if(isset($_POST['add'])){
    $name=$_POST['name'];
  
   

 
    $error_name='';

    



    if($name === ''){
        $error_name = "Введите заголовок новости!";
    }else if (strlen($name) < 5 || strlen($name)>50 ) {
        $error_name = "Некорректное количество символов";
    } 

    

    if(empty($error_name)    ){
       

         $sql = "INSERT INTO  cat_otz (`name`) VALUES ('$name')";
      $link->query($sql);

      echo '<script>document.location.href="?page=admin_kontent"</script>';

     
   
        }
    
    }?>


<div class="container">
    <div class="forma">
        <p class="Name">Добавить категорию отзыва</p>

        <form method="POST" name="add" class="form_inner" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Название категории*</label>
                <input type="text" name="name" value=<?=$name?>>
            </div>
            <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>
        
            

            
            
            

            
            <button type="submit" name="add" class="but_sub">добавить</button>
        </form>
        
      
    </div>
   </div>
