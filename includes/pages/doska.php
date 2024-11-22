<?php
 if(!isset($_SESSION['uid'])){
    echo '<script>document.location.href="?page=vhod"</script>';
}
?>

<div class="container">
        <div class="doska">
            <p class="Name">Доска объявлений</p>

            <div class="kategory">
            <p>Категории:</p>

            <a href="?page=doska">показать все</a>

            <?php 
              $k = $link->query("SELECT * FROM cat_post")->fetchAll(PDO::FETCH_ASSOC);
              foreach($k as $kat){?>
           
           <a href="?page=doska&kat=<?=$kat['id']?>"><?=$kat['name']?></a>

           <?}

             
             ?>
        </div> 


        <div class="kat_mobile">
            <div class="form-group">
            <label for="mySelect">Категория:</label>
                    <select id="mySelect" onchange="window.location.href=this.options[this.selectedIndex].value">
                        <option value="">выберите</option>
                       
                        <?php 
                         $k = $link->query("SELECT * FROM cat_post")->fetchAll(PDO::FETCH_ASSOC);
                         foreach($k as $kat){?>
                            <option value="?page=doska&kat=<?=$kat['id']?>"><?=$kat['name']?></option>
                         <?}?>
                         <option value="?page=doska">показать все</option>
              
                    
                    </select>
            </div>
        </div>


            <div class="list">
          
            <?php 
   $limit= 12;
   $pages=isset($_GET['p']) ? (int) $_GET['p']:1;
   if($pages<1){
    $pages=1;
   }

   $offset=($pages-1) * $limit;
   $sql = "SELECT COUNT(*) FROM `post`";
   $rows=$link->query($sql)->fetchColumn();
   $total= ceil($rows/$limit);
   ?>

           <?php 
$dop_sql = ''; 
if(isset($_GET['kat'])) {
    $get_id = $_GET['kat'];

    $sql = "SELECT * FROM cat_post WHERE id='$get_id'";
    $result = $link->query($sql);
    $temp_kat = $result->fetch();

    if($temp_kat != false) {
        $dop_sql = "WHERE kat_id='$get_id'"; 
    } else {
        echo '<script>document.location.href="?page=doska"</script>'; 
    }
} 

$colors = [
    1 => 'rgba(255, 84, 13, 0.74)',      
    2 => 'rgba(0, 173, 104, 1)',      
    3 => 'rgba(112, 124, 192, 1)',
    4 => 'rgba(34, 86, 156, 1)',     
    
];


$sql = "SELECT * FROM post $dop_sql LIMIT $limit OFFSET $offset";
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
                       <?php $us = $SIGNIN_USER['id'];
    $check_response_query = $link->prepare("SELECT COUNT(*) FROM otkl WHERE user_id = :user_id AND post_id = :post_id");
    $check_response_query->execute([':user_id' => $us, ':post_id' => $post['id']]);
    $hasResponded = $check_response_query->fetchColumn() > 0;
  
    ?>            
                        <?php if ($hasResponded): ?>
                <button style="background-color: rgb(71,167,106,1); cursor: not-allowed; padding: 13px 55px" disabled>ура!</button>
                
                <?php elseif ($post['author_id']===$SIGNIN_USER['id']): ?>
                    <button style="background-color: rgb(218,189,171,1); cursor: not-allowed; padding: 13px 55px" disabled>мой пост</button>
            <?php else: ?>
                <a href="?page=doska&id=<?= $post['id'] ?>&otkl">
                    <button style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">Откликнуться!</button>
                </a>
                

            <?php endif; ?>
                        
              

                        <!-- <a href="?page=doska&id=<?=$post['id']?>&otkl"> <button style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">Откликнуться!</button></a>  -->
                    </div>
                    <div class="text_item">
                        <p class="title"><?=$post['name']?> </p>
                        <p class="opis">  <?= mb_substr($post['opis'], 0,60) ?>...</p>
                        <a class="more" href="?page=one_post&id=<?=$post['id']?>">подробнее</a>
                        <?php if ($hasResponded): ?>
                <button style="background-color: rgb(71,167,106,1); cursor: not-allowed;" disabled class="yra">ура!</button>
                <?php elseif ($post['author_id']===$SIGNIN_USER['id']): ?>
                    <button style="background-color: rgb(218,189,171,1); cursor: not-allowed; padding: 13px 55px" disabled>мой пост</button>
            <?php else: ?>
                <a href="?page=doska&id=<?= $post['id'] ?>&otkl">
                    <button style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">Откликнуться!</button>
                </a>
            <?php endif; ?>
                       
                    </div>
                </div>

             

<?}   ?>


               
            </div>

            


        </div>


        <?php 


// Обработка откликов
if (isset($_GET['otkl']) && !$hasResponded && isset($_GET['id'])) {
    $id_pp = $_GET['id']; // Получаем ID поста из GET-параметров
    $us=$SIGNIN_USER['id'];


    $insert_query = $link->prepare("INSERT INTO otkl (`user_id`, `post_id`) VALUES (:user_id, :post_id)");
    if ($insert_query->execute([':user_id' => $us, ':post_id' => $id_pp])) {
        // Редирект только после успешного выполнения вставки
        echo '<script>document.location.href="?page=doska"</script>';
    } else {
        echo "Ошибка: " . $link->error; // Выводим сообщение об ошибке
    }
}
?>
       
            
        <div class="pagi">
<?php
  for($i=1; $i<=$total; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
      echo '<a href="?page=doska&p='.$i.'">'.$i.'</a> '; 
    }
  }
?>
</div>




    <div class="add_block">
        <div class="add_one">
            <p class="text_one">не стесняйся! </p>
            <p class="text_two">скорее публикуй!</p>
        </div>

        <div class="but_add">
           <a href="?page=add_post"><button>создать пост</button></a> 
        </div>
    </div>

    </div>

<script src="assets/js/doska.js"></script>
