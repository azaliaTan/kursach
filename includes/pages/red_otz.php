<?php 
if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>
<div class="container">
    <div class="forma">
        <p class="Name">редактирование отзыва</p>


        <?php

        
if(isset($_GET['id'])){

    $get_id=$_GET['id'];
    $sql="SELECT * FROM otz WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $otz=$result ->fetch(); }



if(isset($_POST['red'])){
    $name=$_POST['name'];
    $opis=$_POST['opis'];
    $category=$_POST['category'];
   
  
    

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


    if(empty($error_name) && empty($error_opis)  && empty($error_cat) ){
       
         $sql = "UPDATE otz SET name='$name', opis='$opis', kat_id='$category'  WHERE id='$get_id'";
        $link->query($sql);
        echo '<script>document.location.href="?page=admin_kontent_otz"</script>';

}}
        ?>

        <form method="post" name="add" class="form_inner">

            <div class="form-group">
                <label for="name">Заголовок*</label>
                <input type="text" name="name" value=<?=$otz['name']?>>
                <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>
            </div>
            <div class="form-group">
                <label for="">Отзыв*</label>
                <input type="text" name="opis" value=<?=$otz['opis']?>>
            </div>  <p class="errors"><?php if(isset($error_opis)){echo $error_opis;}?></p>
        
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


            
            <button type="submit" name="red" class="but_sub">сохранить</button>
        </form>
        
      
    </div>
   </div>
