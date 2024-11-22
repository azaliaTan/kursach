<?php

if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>


<?php 


if(isset($_POST['add'])){
    $name=$_POST['name'];
  
   
    $img=$_FILES['img']; 
 
    $error_name='';
    $error_img='';
    



    if($name === ''){
        $error_name = "Введите заголовок новости!";
    }else if (strlen($name) < 5 || strlen($name)>50 ) {
        $error_name = "Некорректное количество символов";
    } 

    
    if($_FILES['img']['size'] > 2 * 1024 * 1024){ 
        $error_img= "Изображение не должно быть больше 2 МБ"; 
    } 

    if($_FILES['img']['type'] != 'image/png' && $_FILES['img']['type'] != 'image/jpeg'){ 
        $error_img= "Неверный формат файла"; 
    } 

    $route='images/'.time().$_FILES['img']['name'];

    if(empty($error_name)  && empty($error_img)  ){
        if(move_uploaded_file($_FILES['img']['tmp_name'],$route)){

         $sql = "INSERT INTO  cat_post (`name`, `img`) VALUES ('$name', '$route')";
      $link->query($sql);
      echo '<script>document.location.href="?page=admin_kontent"</script>';
   
        }
    }
    }?>


<div class="container">
    <div class="forma">
        <p class="Name">Добавить категорию поста</p>

        <form method="POST" name="add" class="form_inner" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Название категории*</label>
                <input type="text" name="name" value=<?=$name?>>
            </div>
            <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>
        
            

            
            
            <div class="form-group">
                <label for="file">Загрузите изображение категории</label>
              <input type="file" name="img">
            </div>
            <p class="errors"><?php if(isset($error_img)){echo $error_img;}?></p>



            
            <button type="submit" name="add" class="but_sub">добавить</button>
        </form>
        
      
    </div>
   </div>
