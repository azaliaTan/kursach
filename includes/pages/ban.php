<p class="ban">вы в бане!</p>
<p class="ban_p">напишите администратору портала, чтобы Вас разблокировали</p>
<a href="?do=exit">выйти из профиля</a>


<?php 

if ($SIGNIN_USER['role'] != 0) {
    echo '<script>document.location.href="?page=profile"</script>';
}

?>


