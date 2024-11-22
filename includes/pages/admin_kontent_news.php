<?php

if ($SIGNIN_USER['role'] != 2) {
    echo '<script>document.location.href="?page=profile"</script>';
}

?>

<div class="container">

<div class="p-class">
    <div class="panel">
        <p>панель администратора</p>
    </div>
    <div class="href_a">
       <a href="?page=admin" >заявки на публикацию</a>

        <a href="?page=admin_kontent" id="l">контент портала</a>
    </div>
</div>

<div class="admin_vkladki">
   <a href="?page=admin_kontent"><button class="tab">посты</button></a>
   <a href="?page=admin_kontent_otz"><button class="tab">отзывы</button></a>
    <a href="?page=admin_kontent_news"><button class="tabb">новости</button></a>
    <a href="?page=admin_kontent_polz"><button class="tab">пользователи</button></a>
    <a href="?page=admin_kontent_sob"><button class="tab">события</button></a>
</div>



<div class="c_post_i" id="с_news_list">

        <div class="c_news_list" >

        
<?php 
   $limit = 5;
   $pages=isset($_GET['p']) ? (int) $_GET['p']:1;
   if($pages<1){
    $pages=1;
   }

   $offset=($pages-1) * $limit;
   $sql = "SELECT COUNT(*) FROM `news`";
   $rows=$link->query($sql)->fetchColumn();
   $total= ceil($rows/$limit);
   ?>

        <?php 
$sql="SELECT * FROM `news` LIMIT $limit OFFSET $offset " ;
$result=$link->query($sql);
foreach($result as $new){?>

            <div class="c_news">

                <div class="c_new_one">
                                
                <div class="c_post_text">
                    <p class="zayavka">Новость №<?=$new['id']?></p>
                    <?php 
                $id = $new['kat_id'];
                $kat = $link->query("SELECT * FROM cat_news WHERE `id`='$id'")->fetch(2);
    ?>
    <p><span class="dark-gray">Категория:</span> <?=$kat['name']?></p>
    <p><span class="dark-gray">Заголовок новости:</span> <?=$new['name']?></p>
    <p class="z_opis"><span class="dark-gray">Подробное описание:</span> <?=$new['opis']?></p>
   
</div>

                <div class="c_news_but">
                <a href="#" onclick="confirmDelete(<?=$new['id']?>); return false;">удалить новость</a>
                    <a href="?page=red_news&id=<?=$new['id']?>">редактировать новость</a>
                    
                </div>
           
<?php 

if (isset($_GET['del'])) {
    $id = $_GET['id'];

    $id = intval($id); 
    $sql = "DELETE FROM news WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent_news"</script>';
    } else {
        echo 'Ошибка при удалении новости.';
    }
}

?>
<script type="text/javascript">
function confirmDelete(newId) {
    var confirmation = confirm("Вы уверены, что хотите удалить эту новость?");
    if (confirmation) {
       
        window.location.href = "?page=admin_kontent_news&id=" + newId + "&del";
    }
}
</script>

            <div class="c_news_img">
            <form id="action-form-<?=$new['id']?>" action="" method="POST">
            <input type="hidden" name="id" value="<?=$new['id']?>" />
            <button type="button" class="del_button_post" onclick="confirmActionNew('action-form-<?=$new['id']?>', 'Вы уверены, что хотите удалить эту новость?', 'del_new');" id="b_admin">
                <img src="assets/img/delKR.png" alt="Удалить">
            </button>
     </form>
     <a href="?page=red_news&id=<?=$new['id']?>"> <img src="assets/img/redd.png" alt=""></a>
              
            </div>

        </div>

    <img src="<?=$new['img']?>" alt="news" class="www">

        </div>
         
        <?}?>
      

<script>
    function confirmActionNew(formId, message, actionType) {
        if (confirm(message)) {
            const formNew = document.getElementById(formId);
            const inputNew = document.createElement('input');

          
            if (actionType === 'del_new') {
                inputNew.setAttribute('name', 'del_new');
            } 

            formNew.appendChild(inputNew);
            formNew.submit();
        }
    }
</script>

<?php 

if (isset($_POST['del_new'])) {
    $id = $_POST['id'];

    $id = intval($id); 
    $sql = "DELETE FROM news WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent_news"</script>';
    } else {
        echo 'Ошибка при удалении поста.';
    }
}

?>

    </div>


    <div class="pagi">
<?php
  for($i=1; $i<=$total; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
      echo '<a href="?page=admin_kontent_news&p='.$i.'">'.$i.'</a> '; 
    }
  }
?>
</div>


<div class="new_add_b">
   <a href="?page=add_news"> <button>добавить новость</button></a>
</div>
        
</div>