

<?php 

if(isset($_GET['id'])){
    $get_id=$_GET['id'];
    $sql="SELECT * FROM user WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $user=$result ->fetch(); }
?>
<div class="conatiner">
        <div class="profile">

            <p class="Name">Личный кабинет</p>
          
            <div class="prof_sec">
            <?php 

if($user['img']==''){?>
    <img src="assets/img/ava.png" alt="ava" class="avpr">
<? }else{?>

<img src="<?=$user['img']?>" alt="ava" class="avpr">
<?  }


?>
                <div class="prof_name">
                    <p><?=$user['name']?> <?=$user['surname']?></p>
                    <p>группа <?=$user['student_group']?></p>
                    <?php 
             if ($user['role'] == 1) {
                echo ' <p class="rol">
                        студент
                    </p>';
            }else if ($user['role'] == 2){
                echo '<p class="rol">
                        админ
                    </p>';
            }else if ($user['role'] == 3){
                echo '<p class="rol">
                        препод
                    </p>';
            }
            
            ?>
                </div>
            </div>

            <div class="text_sec_p">
                 <p class="DO">
                дополнительная информация</p>

                <div class="text_DOP">
                <?=$user['opis']?>
                </div>

                <p class="DO">
                  Контакты</p>

                  <div class="cont_DOP">
                    <p>Телеграмм: <a href="https://t.me/<?=$user['tg']?>"><?=$user['tg']?></a></p>
<p>Вконтакте: <a href="https://vk.com/<?=$user['vk']?>"><?=$user['vk']?></a></p>
<p>Номер телефона: <a href="tel:+<?=$user['tel']?>"><?=$user['tel']?></a></p>
<p>Инстаграм: <a href="https://vk.com/<?=$user['inst']?>"><?=$user['inst']?></a></p>
                  </div>
    

            </div>

            
        </div>
    </div>