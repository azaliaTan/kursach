<div class="container">
        <p class="Name_three" id="wqe">
мои заявки
        </p>

        <div class="prof_vkl">
            <a href="?page=profile">в профиль</a>
            <a href="" class="tabss active">Посты</a>
            <a href="" class="tabss">Отзывы</a>
       
    
        
        </div>



      
        

<!-- ===================================================================разделение вкладок====================================================== -->
    


<!-- ===================================================================разделение вкладок====================================================== -->
        <div class="list_2" >


        <?php 
        $id=$SIGNIN_USER['id'];
        $colors = [
            1 => 'rgba(255, 84, 13, 0.74)',      
            2 => 'rgba(0, 173, 104, 1)',      
            3 => 'rgba(112, 124, 192, 1)',
            4 => 'rgba(34, 86, 156, 1)',    
           
        ];


$id=$SIGNIN_USER['id'];

$sql = "SELECT * FROM z_post WHERE author_id='$id'";
$result = $link->query($sql)->fetchAll(PDO::FETCH_ASSOC);
     foreach($result as $post){?>
     
     
   
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
                        <button style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">Откликнуться!</button>
                    </div>
                    <div class="text_item">
                        <p class="title"><?=$post['name']?> </p>
                        <p class="opis"><?=$post['opis']?></p>
                        <a class="more" href="?page=one_post&id=<?=$post['id']?>">подробнее</a>
                        <button style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">откликнуться!</button>
                       
                    </div>
                </div>
     
     
     
     
     
     
     <?}?>



   

          
    </div>





<!-- ===================================================================разделение вкладок====================================================== -->
    


<div class="list" >
    <div class="otz_block">
<?php
    $id=$SIGNIN_USER['id'];

$sql = "SELECT * FROM z_otz WHERE author_id='$id'";
$result = $link->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $obr){?>

      
<div class="otzyv" >
            <div class="otz_kart">

            <?php 
                $id = $obr['kat_id'];
                $kat = $link->query("SELECT * FROM cat_otz WHERE `id`='$id'")->fetch(2);
    ?>
                <button><?=$kat['name']?></button>
                <img src="assets/img/ava2.png" alt="">

                <?php 

if($obr['anonim'] == 0) {
    echo '<p>аноним</p>';
} else {
    $user_id = $obr['author_id'];
    $user = $link->query("SELECT * FROM user WHERE id='$user_id'")->fetch(PDO::FETCH_ASSOC);  

    if ($user) {
        echo '<p>' . htmlspecialchars($user['name']) . ' ' . htmlspecialchars($user['surname']) . '</p>';
    } else {
        echo '<p>Пользователь не найден</p>'; 
    }
}
    ?>         
            </div>


            
            <div class="text_otz">
               
<p class="op"> < <?=$obr['name']?> ></p>
                <p class="text_otz short-text">
                <?= mb_substr($obr['opis'], 0, 70) ?>...
                </p>
                <p class="text_otz full-text" style="display: none;">
                <?=$obr['opis']?>
                </p>
           
                <p class="read" onclick="toggleReadMore(this)">
                    читать подробнее
                </p>
            </div>



            <div class="name_otz">
                   
                    <button><?=$kat['name']?></button>
                </div>
            
        </div>
<?}?>


        
        
    
    </div>
</div>


</div>

    </div>

<!-- ===================================================================разделение вкладок====================================================== -->
    
<!-- ===================================================================разделение вкладок====================================================== -->
<script src="assets/js/otz.js"></script>
<script src="assets/js/zay.js"></script>

