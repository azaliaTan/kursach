
<?php 

if(isset($_SESSION['uid'])){
    echo '<script>document.location.href="?page=profile"</script>';
}


$SIGNIN_USER = array();
$login='';

    
if(isset($_POST['vhod'])){
  
    $login=$_POST['login'];
    $password=$_POST['password'];
    
   $sql="SELECT * FROM user WHERE login='$login'";
   $result=$link->query($sql);
   $temp_user=$result->fetch();

   
    $error_log = '';
    $error_pas = '';
 

    

    if($log===''){
        $error_log="Введите логин!";
     
    }else if($temp_user==false){
        $error_log="Вас нет в базе";
    }

    
    if ($password === '') {
        $error_pas = "Введите пароль!";
    } else if (!password_verify($password,$temp_user['password'])){
        $error_pas="Неверный пароль";
    
    }


    if(empty($error_log)  && empty($error_pas)){

       
        if(empty($error_log)  && empty($error_pas)){
            $_SESSION['uid'] = $temp_user['id'];
           
  $SIGNIN_USER['role'] = $temp_user['role']; 
  if($SIGNIN_USER['role'] == 1){
      echo '<script>document.location.href="?page=profile"</script>';
  } elseif ($SIGNIN_USER['role'] == 0) {
    echo '<script>document.location.href="?page=ban"</script>';
  }elseif ($SIGNIN_USER['role'] == 2) {
    echo '<script>document.location.href="?page=profile"</script>';
  }
         
                
        }
            }}
        ?>
<div class="container">
    <div class="forma">
        <p class="Name">Вход в личный кабинет</p>

        <form method="POST" name="vhod" class="form_inner">

            <div class="form-group">
                <label for="username">Логин</label>
                <input type="text"  name="login" >
                <p class="errors"><?php if(isset($error_log)){echo $error_log;}?></p>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password"  name="password" >
                <p class="errors"><?php if(isset($error_pas)){echo $error_pas;}?></p>

            </div>
            <button type="submit" name="vhod" class="but_sub">Войти</button>
        </form>
        <a href="assets/doc/pamyatka.docx" target="_blank" rel="noopener noreferrer">Памятка, если забыл пароль или логин</a>
      
    </div>
   </div>
