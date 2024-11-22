<?
if(!isset($_SESSION['uid'])){
    echo '<script>document.location.href="?page=vhod"</script>';
}?>

<?php

 if(!isset($_SESSION['uid'])){
     echo '<script>document.location.href="?page=vhod"</script>';
 }



?>

<?php 
if(isset($_GET['id'])){
    $get_id=$_GET['id'];
    $sql="SELECT * FROM user WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $user=$result ->fetch();

    if ($SIGNIN_USER['id'] != $user['id']) {
        echo '<script>document.location.href="?page=profile"</script>';
    }
    
   
}
?>


<div class="container">
<p class="Name">редактировать профиль</p>


<?php 




if(isset($_POST['red'])){
   
    $opis=$_POST['opis'];
    $tg=$_POST['tg'];
    $vk=$_POST['vk'];
    $inst=$_POST['inst'];
    $tel=$_POST['tel'];
    $img=$_FILES['img']; 
    
 
    $error_opis='';
    $error_vk='';
    $error_tel='';
    $error_img='';
    $error_inst='';
    $error_tg='';
   

     if (strlen($opis) < 30) {
    $error_opis = "Доп.инф должна иметь не менее 30 символов";
     }else if (strlen($opis) > 10000) {
        $error_opis = "Доп.инф должна иметь не более 1000 символов";
    } 
    
    if($_FILES['img']['size'] > 2 * 1024 * 1024){ 
        $error_img= "Изображение не должно быть больше 2 МБ"; 
    } 

    if($_FILES['img']['type'] != 'image/png' && $_FILES['img']['type'] != 'image/jpeg'){ 
        $error_img= "Неверный формат файла"; 
    } 

    $route='images/'.time().$_FILES['img']['name'];

    if ($tel === '') {
        $error_tel = "Введите  номер телефона!";
    } else {
       
        $tel_clean = preg_replace('/[^\d]/', '', $tel);
        
       
        if (strlen($tel_clean) != 10) {
            $error_tel = "Неверный номер телефона! Он должен содержать 10 цифр";
        } elseif (!preg_match('/^\d{10}$/', $tel_clean)) {
           
            $error_tel = "Номер телефона должен состоять только из цифр";
        }
    }

    if ($vk === '') {
        $error_vk = "Введите  ссылку на аккаунт вк!";
    } else {
        
        $vk_pattern = '/^https?:\/\/(www\.)?vk\.com\/\w+$/';
        
        if (!preg_match($vk_pattern, $vk)) {
            $error_vk = "Некорректная ссылка на аккаунт ВК! 
            Она должна иметь формат: https://vk.com/имя_аккаунта или http://vk.com/имя_аккаунта";
        }
    }

        //  корректность ссылки на Instagram
        $instagram_pattern = '/^@[A-Za-z0-9_]+$/';
    
        if (!preg_match($instagram_pattern, $inst)) {
            $error_inst = "Некорректный тег  на аккаунт Instagram! 
            Имя аккаунта должно начинаться  с @, ";
        }
      
            // Проверяем корректность ссылки на Telegram
         $telegram_tag_pattern = '/^@[A-Za-z0-9_]+$/';
        
            if (!preg_match($telegram_tag_pattern, $tg)) {
                $error_tg = "Некорректный ввод! 
                тег должен начинаться с @, например, @имя_пользователя"; 
            } 

    
            if(empty($error_tg) && empty($error_opis) && empty($error_vk) && empty($error_tel) && empty($error_inst) 
             && empty($error_img)){
                if(move_uploaded_file($_FILES['img']['tmp_name'],$route)){
                    $id=$SIGNIN_USER['id'];
                $sql = "UPDATE user SET  tg='$tg', opis='$opis', tel='$tel', vk='$vk', inst='$inst', img='$route' WHERE id='$id'";
                $link->query($sql);
                echo '<script>document.location.href="?page=profile"</script>';
              
           
                }
            }
        

}?>

<div class="forma">
    <form method="POST"  class="form_inner" name="red" enctype="multipart/form-data" >

        <div class="form-group">
            <label for="">Дополнительная информация</label>
           
            <textarea name="opis" id=""><?=$user['opis']?></textarea>
           
        </div>

        <p class="errors"><?php if(isset($error_opis)){echo $error_opis;}?></p>

        <div class="form-group">
            <label for="">Аккаунт вконтакте*</label>
            <input type="text" name="vk" value="<?=$user['vk']?>">
        </div>
        <p class="errors"><?php if(isset($error_vk)){echo $error_vk;}?></p>

        <div class="form-group">
            <label for="">Аккаунт телеграмм</label>
            <input type="text" name="tg" value="<?=$user['tg']?>">
        </div>
        <p class="errors"><?php if(isset($error_tg)){echo $error_tg;}?></p>

        <div class="form-group">
            <label for="">Аккаунт инстаграм</label>
            <input type="text" name="inst" value="<?=$user['inst']?>">
        </div>
        <p class="errors"><?php if(isset($error_inst)){echo $error_inst;}?></p>

        <div class="form-group">
            <label for="">Номер телефона*</label>
            <input type="tel" name="tel" value="<?=$user['tel']?>">
        </div>      <p class="errors"><?php if(isset($error_tel)){echo $error_tel;}?></p>

        <div class="form-group">
            <label for="">Аватарка</label>
            <input type="file" name="img">
        </div>
        <p class="errors"><?php if(isset($error_img)){echo $error_img;}?></p>

        
        <button type="submit"  class="but_sub" name="red">Сохранить </button>
    </form>
    
  
</div>
