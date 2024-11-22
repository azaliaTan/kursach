
<?php 
if(!isset($_SESSION['uid'])){
    echo '<script>document.location.href="?page=vhod"</script>';
}

?>
<div class="banner">
        <div class="text_banner">
            <p>онлайн-портал
            </p>
            <p>
                коммуникации </p>
                <div class="text">
                <p id="text1">студентов   <p id="text2">мцк-ктитс</p></p></div>
            <img src="assets/img/logoBOL.png" alt="">
        </div>

    </div>

    <div class="banner_2">
        <div class="banner_inner">
            <div class="text_inner">
            <p>Есть предложение? </p>
            <p id="tee">Или с чем-то не согласен?</p>
        </div>
        <img src="assets/img/meg.png" alt="">
                  
        </div>

       
            <div class="banner_inner_two">
                <div class="text_inner_two">
                <p>  Ваше мнение имеет значение! Делитесь своими предложениями и рассказывайте 
                    о своем опыте. Каждый ваш отзыв помогает нам стать лучше. Мы всегда готовы выслушать вас и сделать всё возможное, 
                    чтобы ваша студенческая жизнь стала ещё ярче и комфортнее. </p>
            </div>

        <p id="tex">Делись. публикуй. обсуждай</p>
 
                      
            </div>

    </div>





      
    <div class="news">
       <p class="Name" id="kat">Обратная связь</p>

       
       <div class="kategory">
                <p>Категории:</p>
             <?php 
              $k = $link->query("SELECT * FROM cat_otz")->fetchAll(PDO::FETCH_ASSOC);
              foreach($k as $kat){?>
           
           <a href="?page=obr&kat=<?=$kat['id']?>#kat"><?=$kat['name']?></a>

           <?}
           
           
             
             ?>

<a href="?page=obr">Показать все</a>
            </div>

            <div class="kat_mobile">
                <div class="form-group">
                    <label for="mySelect">Категория:</label>
                    <select id="mySelect" onchange="window.location.href=this.options[this.selectedIndex].value">
                        <option value="">выберите</option>
                       
                        <?php 
                         $k = $link->query("SELECT * FROM cat_otz")->fetchAll(PDO::FETCH_ASSOC);
                         foreach($k as $kat){?>
                         <option value="?page=obr&kat=<?=$kat['id']?>#kat"><?=$kat['name']?></option>
                         <?}?>
                         <option value="?page=obr">показать все</option>
              
                    
                    </select>
                </div>
            </div>

    <div class="otz_block">
  
    <?php 
   $limit= 6;
   $pages=isset($_GET['p']) ? (int) $_GET['p']:1;
   if($pages<1){
    $pages=1;
   }

   $offset=($pages-1) * $limit;
   $sql = "SELECT COUNT(*) FROM `otz`";
   $rows=$link->query($sql)->fetchColumn();
   $total= ceil($rows/$limit);
   ?>

           <?php 
$dop_sql = ''; 
if(isset($_GET['kat'])) {
    $get_id = $_GET['kat'];

    $sql = "SELECT * FROM cat_otz WHERE id='$get_id'";
    $result = $link->query($sql);
    $temp_kat = $result->fetch();

    if($temp_kat != false) {
        $dop_sql = "WHERE kat_id='$get_id'"; 
    } else {
        echo '<script>document.location.href="?page=obr"</script>'; 
    }
} 



$sql = "SELECT * FROM otz $dop_sql LIMIT $limit OFFSET $offset";
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

if($obr['anonim'] == 1) {
    echo '<p>аноним</p>';
} else {
    $user_id = $obr['author_id'];
    $user = $link->query("SELECT * FROM user WHERE id='$user_id'")->fetch(PDO::FETCH_ASSOC);  

    if ($user) {
        echo '<p>' . htmlspecialchars($user['name']) . ' ' . htmlspecialchars($user['surname']) . '</p>';
    } else {
        echo '<p>удалено</p>'; 
    }
}
    ?>         
            </div>


            
            <div class="text_otz">
               
<p class="op"> < <?=$obr['name']?> ></p>
                <p class="text_otz short-text">
                <?= mb_substr($obr['opis'], 0, 60) ?>...
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


    <div class="pagi">
<?php
  for($i=1; $i<=$total; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
        echo '<a href="?page=obr&p='.$i.'">'.$i.'</a>';
    }
  }
?>
</div>


    <div class="add_block">
        <div class="add_one">
            <p class="text_one">не стесняйся! </p>
            <p class="text_two">твое мнение важно! </p>
        </div>

        <div class="but_add">
            <a href="?page=add_otz"><button>добавить отзыв</button></a>
        </div>
    </div>

  
    </div>


    <script src="assets/js/otz.js"></script>