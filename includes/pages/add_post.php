<?php

if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>


<?php 
$modalVisible = false; // Флаг для отображения модального окна
$name='';
$category='';
$opis='';
$data='';




if(isset($_POST['add'])){
    $name=$_POST['name'];
    $opis=$_POST['opis'];
    $category=$_POST['category'];
    $data=$_POST['data'];

   
 
    $error_name='';
    $error_data='';
    $error_opis='';
   $error_cat='';
    



    if($name === ''){
        $error_name = "Введите заголовок поста!";
    }else if (strlen($name) < 5 || strlen($name)>50 ) {
        $error_name = "Некорректное количество символов";
    } 


    if ($opis === '') {
        $error_opis = "Введите  описание!";
    } else if (strlen($opis) < 30) {
        $error_opis = "Описание должно иметь не менее 30 символов";
    }  else if (strlen($opis) > 400) {
        $error_opis = "Описание должно иметь не более 400 символов";
    } 


    if($category == 0){
        $error_cat = "Выберите категорию поста!";}
    

        if($data === ''){
            $error_data = "Введите дату события или дату публикации!";}


     $id_a=$SIGNIN_USER['id'];

    if(empty($error_name) && empty($error_opis) && empty($error_data) && empty($error_cat) ){
       

        $sql = "INSERT INTO  `z_post` (`name`,`opis`,`kat_id`,`data`,`author_id`) 
        
      VALUES ('$name', '$opis', '$category', '$data','$id_a')";
       $link->query($sql);
       $modalVisible = true; 
   
        
    }
    }?>


<div class="container">
    <div class="forma">
        <p class="Name">Добавить пост</p>

        <form method="POST" name="add" class="form_inner" id="ad">

            <div class="form-group">
                <label for="">Заголовок поcта*</label>
                <input type="text" name="name" value="<?=$name?>">
            </div>
            <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>
        
            <div class="form-group">
                <label for="">Категория*</label>
                <select id="" class="input_select" name="category">
                    <option value="0">Выберите</option>
                    <?php 

                    $sql="SELECT * FROM cat_post";
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
                <label for="data">Введите дату события\публикации*</label>
               <input name="data" id="" type="date" value="<?=$data?>">
            </div>
            <p class="errors"><?php if(isset($error_data)){echo $error_data;}?></p>

        


            
            <button type="submit" name="add" class="but_sub" id="submitButton">добавить</button>
        </form>
        
      
    </div>
   </div>


       <!-- Модальное окно -->
       <div id="myModal" class="modal">
        <div class="modal-content">
            <p class="hh"> пост отправлен на проверку!</p>
            <p  class="hhh">после проверки он попадет на доску объявлений</p>
            <a href="?page=zay"><button>супер!</button></a>
            <script src="assets/js/modal.js"></script>
        </div>

        <script>
document.addEventListener("DOMContentLoaded", function() {
  
    <?php if ($modalVisible): ?>
        openModal();
    <?php endif; ?>
});
</script>

  
    </div>



            
