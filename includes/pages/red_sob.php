<?php

if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}
?>


<?php 

if(isset($_GET['id'])){

    $get_id=$_GET['id'];
    $sql="SELECT * FROM sob WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $sob=$result ->fetch(); }


if(isset($_POST['red'])){
    $name=$_POST['name'];
   
    $data=$_POST['data'];

   
 
    $error_name='';
    $error_data='';
   



    if($name === ''){
        $error_name = "Введите заголовок поста!";
    }else if (strlen($name) < 5 || strlen($name)>20 ) {
        $error_name = "Некорректное количество символов";
    } 
    
        if($data === ''){
        $error_data = "Введите дату события или дату публикации!";}


     

    if(empty($error_name)  && empty($error_data)  ){
       

        $sql = "UPDATE sob SET name='$name', data='$data' WHERE id='$get_id'";
       $link->query($sql);
       echo '<script>document.location.href="?page=admin_kontent_sob"</script>';
   
        
    }
    }?>


<div class="container">
    <div class="forma">
        <p class="Name">редактировать событие</p>

        <form method="POST" name="red" class="form_inner" id="ad">

            <div class="form-group">
                <label for="">Заголовок события*</label>
                <input type="text" name="name" value="<?=$sob['name']?>">
            </div>
            <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>
        
   


            <div class="form-group">
                <label for="data">Введите дату события\публикации*</label>
               <input name="data" id="" type="text" value="<?=$sob['data']?>">
            </div>
            <p class="errors"><?php if(isset($error_data)){echo $error_data;}?></p>

        


            
            <button type="submit" name="red" class="but_sub" id="submitButton">сохранить</button>
        </form>
        
      
    </div>
   </div>




            
