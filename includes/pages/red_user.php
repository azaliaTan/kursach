<?


if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}

?>



<?php 
if(isset($_GET['id'])){
    $get_id=$_GET['id'];
    $sql="SELECT * FROM user WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $user=$result ->fetch();

   
}
?>


<div class="container">
<p class="Name">редактировать профиль пользователя</p>


<?php 




if(isset($_POST['red'])){
   
    $opis=$_POST['opis'];
    $tg=$_POST['tg'];
    $vk=$_POST['vk'];
    $inst=$_POST['inst'];
    $tel=$_POST['tel'];
    
    $name=$_POST['name']; 
    $surname=$_POST['surname']; 
    $student_group=$_POST['student_group']; 
    
 
    $error_opis='';
    $error_vk='';
    $error_tel='';
    $error_img='';
    $error_inst='';
    $error_tg='';
    $error_name='';
    $error_surname='';
    $error_gr='';
   
    if (strlen($name) < 2) {
        $error_name = "Имя должно иметь не менее 2 символов";
    }  else if (strlen($name) > 100) {
        $error_name = "Имя должно иметь не более 100 символов";
    } 
    if (strlen($surname) < 2) {
        $error_surname = "Фамилия должна иметь не менее 2 символов";
    }  else if (strlen($surname) > 100) {
        $error_surname = "Фамилия должна иметь не более 100 символов";
    } 

    $gr_clean = preg_replace('/[^\d]/', '', $student_group);
    if (strlen($student_group) < 3) {
        $error_gr = "Группа должна иметь не менее 3 символов";
    }  elseif (!preg_match('/^\d{10}$/', $gr_clean)) {
           
        $error_gr = "Группа должна состоять только из цифр";
    }



    if (strlen($opis) < 30) {
        $error_opis = "Доп.инф должна иметь не менее 30 символов";
    }  else if (strlen($opis) > 1000) {
        $error_opis = "Доп.инф должна иметь не более 1000 символов";
    } 
    
 

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
            $error_vk = "Некорректная ссылка на аккаунт ВК! Она должна иметь формат: https://vk.com/имя_аккаунта или http://vk.com/имя_аккаунта";
        }
    }



        //  корректность ссылки на Instagram
        $instagram_pattern = '/^https?:\/\/(www\.)?instagram\.com\/[A-Za-z0-9._]+\/?$/';
    
        if (!preg_match($instagram_pattern, $inst)) {
            $error_inst = "Некорректная ссылка на аккаунт Instagram! Она должна иметь формат: https://instagram.com/имя_аккаунта ";
        }

      
            // Проверяем корректность ссылки на Telegram
         $telegram_tag_pattern = '/^@[A-Za-z0-9_]+$/';
        
            if (!preg_match($telegram_tag_pattern, $tg)) {
                $error_tg = "Некорректный ввод! тег должен начинаться с @, например, @имя_пользователя"; 
            } 

    
            if(empty($error_tg) && empty($error_opis) && empty($error_vk) && empty($error_tel) && empty($error_inst)&& empty($error_name)&& empty($error_surname)&& empty($error_gr) ){
               
                    $id=$user['id'];
                $sql = "UPDATE user SET  tg='$tg', opis='$opis', tel='$tel', vk='$vk', inst='$inst', `name`='$name', surname='$surname', student_group='$student_group' WHERE id='$id'";
                $link->query($sql);
                echo '<script>document.location.href="?page=admin_kontent_polz"</script>';
              
           
                }
            
        

}?>

<div class="forma">
    <form method="POST"  class="form_inner" name="red"  >
     
    
        
    <div class="form-group">
            <label for="">Имя пользователя</label>
            <input type="text" name="name" value="<?=$user['name']?>">
        </div>
        <p class="errors"><?php if(isset($error_name)){echo $error_name;}?></p>

 
        <div class="form-group">
            <label for="">фамилия пользователя</label>
            <input type="text" name="surname" value="<?=$user['surname']?>">
        </div>
        <p class="errors"><?php if(isset($error_surname)){echo $error_surname;}?></p>

        <div class="form-group">
            <label for="">группа пользователя</label>
            <input type="text" name="student_group" value="<?=$user['student_group']?>">
        </div>
        <p class="errors"><?php if(isset($error_gr)){echo $error_gr;}?></p>



    <div class="form-group">
            <label for="">Дополнительная информация</label>
            <input type="text" name="opis" value="<?=$user['opis']?>">
          
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

        

        
        <button type="submit"  class="but_sub" name="red">Сохранить </button>
    </form>
    
  
</div>
