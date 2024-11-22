<?php



if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>


<?php 

$name='';
$category='';
$opis='';
$img='';



if(isset($_POST['add'])){
    $name=$_POST['name'];
    $opis=$_POST['opis'];
    $category=$_POST['category'];
    $img=$_FILES['img']; 
 
    $error_name='';
    $error_img='';
    $error_opis='';
    $error_cat='';



    if($name === ''){
        $error_name = "Введите заголовок новости!";
    }else if (strlen($name) < 5 || strlen($name)>100) {
        $error_name = "Некорректное количество символов";
    } 


    if ($opis === '') {
        $error_opis = "Введите  описание!";
    } else if (strlen($opis) < 30) {
        $error_opis = "Описание должно иметь не менее 30 символов";
    }  else if (strlen($opis) > 10000) {
        $error_opis = "Описание должно иметь не более 1000 символов";
    } 
    if($category == 0){
        $error_cat = "Выберите категорию новости!";}
    
    if($_FILES['img']['size'] > 2 * 1024 * 1024){ 
        $error_img= "Изображение не должно быть больше 2 МБ"; 
    } 

    if($_FILES['img']['type'] != 'image/png' && $_FILES['img']['type'] != 'image/jpeg'){ 
        $error_img= "Неверный формат файла"; 
    } 

    $route='images/'.time().$_FILES['img']['name'];

    if(empty($error_name) && empty($error_opis) && empty($error_img) && empty($error_cat) ){
        if(move_uploaded_file($_FILES['img']['tmp_name'],$route)){

        $sql = "INSERT INTO  `news` (`name`,`opis`,`kat_id`,`img`) 
        
      VALUES ('$name', '$opis', '$category', '$route')";
      $link->query($sql);
      echo '<script>document.location.href="?page=admin_kontent"</script>';
   
        }
    }
    }?>


<div class="container">
    <div class="forma">
        <p class="Name">Добавить новость</p>

        <form method="POST" name="add" class="form_inner" enctype="multipart/form-data">

            <div class="form-group">
                <label for="">Заголовок новости*</label>
                <input type="text" name="name" value=<?=$name?>>
            </div>
            <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>
        
            <div class="form-group">
                <label for="">Категория*</label>
                <select id="" class="input_select" name="category">
                    <option value="0">Выберите</option>
                    <?php 

                    $sql="SELECT * FROM cat_news";
                    $result=$link->query($sql);
                    foreach($result as $cat){?>
                    <option value="<?=$cat['id']?>"><?=$cat['name']?></option>
                    <?}



                    ?>
                    
                </select>
            </div>
            <p class="errors"><?php if(isset($error_cat)){echo $error_cat;}?></p>

            <div class="form-group">
                <label for="opis">Введите описание*</label>
               <textarea name="opis" id=""><?=$opis?></textarea>
               
            </div>
            <p class="errors"><?php if(isset($error_opis)){echo $error_opis;}?></p>

            
            <div class="form-group">
                <label for="file">Загрузите изображение новости</label>
              <input type="file" name="img">
            </div>
            <p class="errors"><?php if(isset($error_img)){echo $error_img;}?></p>



            
            <button type="submit" name="add" class="but_sub">добавить</button>
        </form>
        
      
    </div>
   </div>
