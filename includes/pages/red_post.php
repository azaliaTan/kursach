<?php

if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>


<?php 
if(isset($_GET['id'])){

    $get_id=$_GET['id'];
    $sql="SELECT * FROM post WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $post=$result ->fetch(); }





if(isset($_POST['red'])){
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



    if(empty($error_name) && empty($error_opis) && empty($error_data) && empty($error_cat) ){
       
        $sql = "UPDATE post SET name='$name', opis='$opis', kat_id='$category', data='$data'  WHERE id='$get_id'";
        $link->query($sql);
        echo '<script>document.location.href="?page=admin_kontent"</script>';
   
        
    }
    }?>


<div class="container">
    <div class="forma">
        <p class="Name">Редактировать пост</p>

        <form method="POST" name="red" class="form_inner" id="ad">

            <div class="form-group">
                <label for="">Заголовок поcта*</label>
                <input type="text" name="name" value="<?=$post['name']?>">
            </div>
            <p class="errors"><?php if(isset($error_name))
            {echo $error_name;}?></p>
        
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
               <textarea name="opis" id=""><?=$post['opis']?></textarea>
            </div>
            <p class="errors"><?php if(isset($error_opis)){echo $error_opis;}?></p>


            <div class="form-group">
                <label for="data">Введите дату события\публикации*</label>
               <input name="data" id="" type="date" value="<?=$post['data']?>">
            </div>
            <p class="errors"><?php if(isset($error_data)){echo $error_data;}?></p>

        


            
            <button type="submit" name="red" class="but_sub" id="submitButton">добавить</button>
        </form>
        
      
    </div>
   </div>


      
  
    



            
