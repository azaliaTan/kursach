<?php 
if(!isset($_SESSION['uid'])){
    echo '<script>document.location.href="?page=vhod"</script>';
}

if ($SIGNIN_USER['role'] == 0) {
    echo '<script>document.location.href="?page=ban"</script>';
}


?>


<?php 

if(isset($_GET['id'])){
    $get_id=$_GET['id'];
    $sql="SELECT * FROM post WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $post=$result ->fetch(); }


                

$colors = [
    1 => 'rgba(255, 84, 13, 0.74)',      
    2 => 'rgba(0, 173, 104, 1)',      
    3 => 'rgba(112, 124, 192, 1)',
    4 => 'rgba(34, 86, 156, 1)',     
    
];
?>
<div class="container">
    <div class="one_post">
        <p class="Name">Подробнее о посте</p>
      <div class="one_post_inner">
        <div class="item_img">
            <?php 
            
            
            $id_cat = $post['kat_id'];
            $cat = $link->query("SELECT * FROM cat_post WHERE `id`='$id_cat'")->fetch(2);
         
            
            ?>
            <img src="<?=$cat['img']?>" alt="">
            <p>
                <span class="kat_color">категория:</span> 
                <span class="event"  style="color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>"><?=$cat['name']?></span>
            </p>
           
        </div>

        <div class="item_text_one" >
            <p class="opis_name"><?=$post['name']?></p>
            <div class="item_img_mob" >
                <img src=<?=$cat['img']?> alt="">
                <p>
                    <span class="kat_color">категория:</span> 
                    <span class="event"  style="color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>"><?=$cat['name']?></span>
                </p>
               
            </div>
            <p class="opis_ine"><?=$post['opis']?></p>

            <?php $us = $SIGNIN_USER['id'];
    $check_response_query = $link->prepare("SELECT COUNT(*) FROM otkl WHERE user_id = :user_id AND post_id = :post_id");
    $check_response_query->execute([':user_id' => $us, ':post_id' => $post['id']]);
    $hasResponded = $check_response_query->fetchColumn() > 0;
  
    ?>
    
            <?php if ($hasResponded): ?>
                <button  class="off" style="background-color: green; cursor: not-allowed;" disabled>ура!</button>
            <?php else: ?>
                <a href="?page=one_post&id=<?= $post['id'] ?>&otkl">
                    <button  class="off" style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">Откликнуться!</button>
                </a>
            <?php endif; ?>
                       
            
        </div>
        <?php if ($hasResponded): ?>
                <button  class="mob_b" style="background-color: green; cursor: not-allowed; padding: 13px 40px" disabled>ура!</button>
            <?php else: ?>
                <a href="?page=one_post&id=<?= $post['id'] ?>&otkl">
                    <button  class="mob_b" style="background-color: <?= isset($colors[$post['kat_id']]) ? $colors[$post['kat_id']] : 'black'; ?>">Откликнуться!</button>
                </a>
            <?php endif; ?>
        
    </div>
    <a href="?page=doska" class="nazad">вернуться назад</a>
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
        echo '<script>document.location.href="?page=one_post&id=' . htmlspecialchars($post['id']) . '"</script>';
    } else {
        echo "Ошибка: " . $link->error; // Выводим сообщение об ошибке
    }
}
?>