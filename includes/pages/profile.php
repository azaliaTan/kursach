<?php

 if(!isset($_SESSION['uid'])){
    echo '<script>document.location.href="?page=vhod"</script>';
}


 if ($SIGNIN_USER['role'] == 0) {
     echo '<script>document.location.href="?page=ban"</script>';
 }


?>


<div class="container">

        <div class="profile">

            <p class="Name">Личный кабинет</p>
          
            <div class="my_prof">
                <?php 

                if($SIGNIN_USER['img']==''){?>
                    <img src="assets/img/ava.png" alt="ava" class="avpr">
               <? }else{?>
                
                <img src="<?=$SIGNIN_USER['img']?>" alt="ava" class="avpr">
             <?  }
                
                
                ?>
               
                <div class="prof_name">
                    <p><?=$SIGNIN_USER['name']?> <?=$SIGNIN_USER['surname']?></p>
                    <p>группа <?=$SIGNIN_USER['student_group']?></p>

                    <?php 
             if ($SIGNIN_USER['role'] == 1) {
                echo ' <p class="rol">
                        студент
                    </p>';
            }else if ($SIGNIN_USER['role'] == 2){
                echo '<p class="rol">
                        админ
                    </p>';
            }else if ($SIGNIN_USER['role'] == 3){
                echo '<p class="rol">
                        препод
                    </p>';
            }
            
            ?>
                </div>
                <a class="r_d" href="?do=exit">выйти из профиля</a>
            </div>
            <a class="rr" href="?do=exit">выйти из профиля</a>

            <div class="text_sec_p">
                 <p class="DO">
                дополнительная информация</p>

                <div class="text_DOP">
                  <?=$SIGNIN_USER['opis']?>
                </div>
                <?php 
                
                if( empty($SIGNIN_USER['tg'])||empty($SIGNIN_USER['vk']) || empty($SIGNIN_USER['tel'])||empty($SIGNIN_USER['inst']) ){
                    echo ' <a class="r" href=?page=prof_red&id='. htmlspecialchars($SIGNIN_USER['id']) . '">добавить</a>';
                }else{
                    echo ' <a class="r" href="?page=prof_red&id='. htmlspecialchars($SIGNIN_USER['id']) . '">редактировать</a>';
                }
                ?>
               

                <p class="DO">
                  Контакты</p>

                  <div class="cont_DOP">
                    <p>Телеграмм: <a href="https://t.me/<?=$SIGNIN_USER['tg']?>">  <?=$SIGNIN_USER['tg']?></a></p>
<p>Вконтакте: <a href=" <?=$SIGNIN_USER['vk']?>">  <?=$SIGNIN_USER['vk']?></a></p>
<p>Номер телефона: <a href="tel:+ <?=$SIGNIN_USER['tel']?>"> <?=$SIGNIN_USER['tel']?></a></p>
<p>Инстаграм: <a href="https://vk.com/ <?=$SIGNIN_USER['inst']?>"> <?=$SIGNIN_USER['inst']?></a></p>
                  </div>
                  <?php 
                
                if( empty($SIGNIN_USER['tg'])||empty($SIGNIN_USER['vk']) || empty($SIGNIN_USER['tel'])||empty($SIGNIN_USER['inst']) ){
                    echo ' <a class="r" href=?page=prof_red&id='. htmlspecialchars($SIGNIN_USER['id']) . '">добавить</a>';
                }else{
                    echo ' <a class="r" href="?page=prof_red&id='. htmlspecialchars($SIGNIN_USER['id']) . '">редактировать</a>';
                }
                ?>
    

            </div>

            
        </div>
    </div>

    <div class="container">
        <p class="Name_three">
мои посты и отклики
        </p>

        <div class="prof_vkl">
            <a href="" class="tabss active">Посты</a>
            <a href="" class="tabss">Отклики</a>
            <a href="?page=zay" class="">Заявки</a> <?php
            if ($SIGNIN_USER['role'] == 2){
                echo ' <a href="?page=admin" class="" >админка</a>';
            }?>
          
        
        </div>


<!-- ===================================================================разделение вкладок====================================================== -->
    

<div class="list">

        <?php 

$colors = [
    1 => 'rgba(255, 84, 13, 0.74)',      
    2 => 'rgba(0, 173, 104, 1)',      
    3 => 'rgba(112, 124, 192, 1)',
    4 => 'rgba(34, 86, 156, 1)',    
   
];
$id=$SIGNIN_USER['id'];



$post_id_query = "SELECT post.* 
    FROM otkl 
    JOIN post ON otkl.post_id = post.id 
    WHERE otkl.user_id = '$id'
";
$result = $link->query($post_id_query);

foreach($result as $post){
?> 

             
     <div class="item" data-index="0" style="border: 4px solid <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">
                <div class="kateg">
                <?php 
             $id_p = $post['kat_id'];
             $kat = $link->query("SELECT * FROM cat_post WHERE `id`='$id_p'")->fetch(2);
            ?>
                    <img src="<?=$kat['img']?>" alt="kat">
                    <p style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>"><?=$kat['name']?></p>
                    <p class="data"><?=$post['data']?></p>
                    
                </div>

                <div class="text_item_short">
                    <p><?=$post['name']?></p>
                    <button style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">увидеть автора!</button>
                </div>
                <div class="text_item">
                    <p class="title"><?=$post['name']?> </p>
                    <p class="opis"><?= mb_substr($post['opis'], 0, 15) ?>...</p>
                    <a class="more" href="?page=one_post&id=<?=$post['id']?>">подробнее</a>
                    <?php 
             $id_a = $post['author_id'];
             $u = $link->query("SELECT * FROM user WHERE `id`='$id_a'")->fetch(2);
            ?>
                   <a href="?page=user_profile&id=<?=$u['id']?> " style="color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>" class="auth">Автор: <?=$u['name']?> <?=$u['surname']?></a>
                   
                </div>
            </div>

           <?}
            ?>

         
            <script src="assets/js/doska.js"></script>
        
        
        </div>

<!-- ===================================================================разделение вкладок====================================================== -->
       
        <div class="list_2">
        <?php
         
       

        $colors = [
            1 => 'rgba(255, 84, 13, 0.74)',      
            2 => 'rgba(0, 173, 104, 1)',      
            3 => 'rgba(112, 124, 192, 1)',
            4 => 'rgba(34, 86, 156, 1)',    
           
        ];
        $id=$SIGNIN_USER['id'];


        $sql= "SELECT * FROM post WHERE author_id='$id'";
        $result=$link->query($sql);
        
     foreach($result as $post){
  ?>
     
     
     <div class="item" data-index="0" style="border: 4px solid <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">
                <div class="kateg">
                <?php 
             $id_p = $post['kat_id'];
             $kat = $link->query("SELECT * FROM cat_post WHERE `id`='$id_p'")->fetch(2);
            ?>
                    <img src="<?=$kat['img']?>" alt="kat">
               
                   
                    <p style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>"><?=$kat['name']?></p>

                    <p class="data"><?=$post['data']?></p>
                    
                </div>

                <div class="text_item_short">
                    <p><?=$post['name']?></p>
                    <button style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">увидеть отклики!</button>
                </div>
     
                <div class="two_list_text">
                    <p class="title_two"><?=$post['name']?></p>
                    <div class="list_otkl">
                        <?php 
                           $id_aa=$post['id'];

                        $sql="SELECT * FROM otkl WHERE post_id= '$id_aa'";
                        $result=$link->query($sql);
                        foreach($result as $o){?>

<?php 
             $id = $o['user_id'];
             $us = $link->query("SELECT * FROM user WHERE `id`='$id'")->fetch(2);
            ?>

                            <a href="?page=user_profile&id=<?=$us['id']?>"><?=$us['name']?> <?=$us['surname']?></a>
                   <?     }
                        
                        
                        ?>
                     

                       
                        
                    </div>
                </div>
            </div>
     
     
    
     
     
     
     <?}
    ?>
          
    </div>




    </div>
    <script src="assets/js/prof.js"></script>

<!-- ===================================================================разделение вкладок====================================================== -->
    
<!-- ===================================================================разделение вкладок====================================================== -->

       
  







