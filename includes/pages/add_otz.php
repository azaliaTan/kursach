<?php



if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>


<?php 
$modalVisible = false; // Флаг для отображения модального окна
$name='';
$category='';





if(isset($_POST['add'])){
    $name=$_POST['name'];
    $opis=$_POST['opis'];
    $category=$_POST['category'];
    $anonim=$_POST['anonim'];
   

   
 
    $error_name='';
   
    $error_opis='';
   $error_cat='';
    



    if($name === ''){
        $error_name = "Введите заголовок отзыва!";
    }else if (strlen($name) < 5 || strlen($name)>50 ) {
        $error_name = "Некорректное количество символов";
    } 


    if ($opis === '') {
        $error_opis = "Введите  отзыв!";
    } else if (strlen($opis) < 30) {
        $error_opis = "Описание должно иметь не менее 30 символов";
    }  else if (strlen($opis) > 400) {
        $error_opis = "Описание должно иметь не более 400 символов";
    } 

    if($category == 0){
        $error_cat = "Выберите категорию отзыва!";}


        if (isset($_POST['anonim'])) {
            $anonim = 1; 
        } else {
            $anonim = 0; 
        }



     $id_a=$SIGNIN_USER['id'];

    if(empty($error_name) && empty($error_opis)  && empty($error_cat) ){
       

        $sql = "INSERT INTO  `z_otz` (`name`,`opis`,`kat_id`,`author_id`,`anonim`) 
        
      VALUES ('$name', '$opis', '$category','$id_a', '$anonim')";
       $link->query($sql);
       $modalVisible = true; 
   
        
    }
    }?>


<div class="container">
    <div class="forma">
        <p class="Name">Публикация отзыва</p>

        <form method="POST" name="add" class="form_inner" id="ad">

            <div class="form-group">
                <label for="">Заголовок*</label>
                <input type="text" name="name" value="<?=$name?>">
            </div>
            <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>
        
            <div class="form-group">
                <label for="">Категория*</label>
                <select id="" class="input_select" name="category">
                    <option value="0">Выберите</option>
                    <?php 

                    $sql="SELECT * FROM cat_otz";
                    $result=$link->query($sql);
                    foreach($result as $cat){?>
                    <option value="<?=$cat['id']?>"><?=$cat['name']?></option>
                    <?}



                    ?>
                    
                </select>
            </div>
            <p class="errors"><?php if(isset($error_cat)){echo $error_cat;}?></p>

            <div class="form-group">
                <label for="opis">Отзыв*</label>
               <textarea name="opis" id=""><?=$opis?></textarea>
            </div>
            <p class="errors"><?php if(isset($error_opis)){echo $error_opis;}?></p>

            
            <div class="sogl">
                <input type="checkbox" class="sss" name="anonim" value="1">
                <p>оставить отзыв анонимно</p>
            </div>
            
            <button type="submit" name="add" class="but_sub" id="submitButton">добавить</button>
        </form>
        
      
    </div>
   </div>


      <!-- Модальное окно -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p class="hh"> отзыв отправлен на проверку!</p>
            <p  class="hhh">после проверки он попадет на страницу обратной связи</p>
            <a href="?page=zay"><button>супер!</button></a>
            <script src="assets/js/modal.js"></script>
        </div>

  
    </div>

        <script>
document.addEventListener("DOMContentLoaded", function() {
  
    <?php if ($modalVisible): ?>
        openModal();
    <?php endif; ?>
});
</script>

  
    </div>

