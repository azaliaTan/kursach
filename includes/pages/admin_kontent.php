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
  <a href="?page=admin_kontent"></a> <button class="tabb">посты</button>
   <a href="?page=admin_kontent_otz"><button class="tab">отзывы</button></a>
    <a href="?page=admin_kontent_news"><button class="tab">новости</button></a>
    <a href="?page=admin_kontent_polz"><button class="tab">пользователи</button></a>
    <a href="?page=admin_kontent_sob"><button class="tab">события</button></a>
</div>




<div class="c_post_i" id="с_post_list">

<div class="kategory">
                <p>Категории:</p>
             <?php 
              $l = $link->query("SELECT * FROM cat_post")->fetchAll(PDO::FETCH_ASSOC);
              
              foreach($l as $lo){?>
           
           <a href="?page=admin_kontent&kat=<?=$lo['id']?>"><?=$lo['name']?></a>

           <?}
     
             
             ?>
             <a href="?page=admin_kontent">показать все</a>
            </div>

            <div class="kat_mobile">
                <div class="form-group">
                    <label for="mySelect">Категория:</label>
                    <select id="mySelect" onchange="window.location.href=this.options[this.selectedIndex].value">
                        <option value="">выберите</option>
                        
                       
                        <?php 
                         $l = $link->query("SELECT * FROM cat_post")->fetchAll(PDO::FETCH_ASSOC);
                         foreach($l as $lo){?>
                            <option value="?page=admin_kontent&kat=<?=$lo['id']?>"><?=$lo['name']?></option>
                         <?}?>
                         <option value="?page=admin_kontent">показать все</option>
              
                    
                    </select>
                </div>
            </div>
<div class="c_post_list">


<?php 
   $limit_post = 6;
   $pages=isset($_GET['p_post']) ? (int) $_GET['p_post']:1;
   if($pages<1){
    $pages=1;
   }

   $offset_post=($pages-1) * $limit_post;
   $sql = "SELECT COUNT(*) FROM `post`";
   $rows=$link->query($sql)->fetchColumn();
   $total_post= ceil($rows/$limit_post);
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
        echo '<script>document.location.href="?page=news"</script>'; 
    }
} 
    
$sql="SELECT * FROM `post`  $dop_sql LIMIT $limit_post OFFSET $offset_post" ;
$result=$link->query($sql);
foreach($result as $post){?>
 <div class="c_post">

        <div class="c_post_text">
            <p class="zayavka">Пост №<?=$post['id']?></p>
            <?php 
             $id_p = $post['kat_id'];
             $kat = $link->query("SELECT * FROM cat_post WHERE `id`='$id_p'")->fetch(2);
            ?>
<p><span class="dark-gray">Категория:</span> <?=$kat['name']?></p>
<p><span class="dark-gray">Заголовок поста:</span> <?=$post['name']?></p>
<p class="z_opis"><span class="dark-gray">Подробное описание:</span><?=$post['opis']?></p>
<?php 
                $id_ath = $post['author_id'];
                $author_otz = $link->query("SELECT * FROM user WHERE `id`='$id_ath'")->fetch(2);
 ?>
<p><span class="dark-gray">Автор:</span> <span class="black"><?=$author_otz['name']?> <?=$author_otz['surname']?></span>, <?=$author_otz['student_group']?> группа</p>
<p><span class="dark-gray">Дата:</span> <?=$post['data']?></p>
        </div>
   
        <div class="c_post_but">
      
        <a href="#" onclick="confirmDelete(<?=$post['id']?>); return false;">удалить пост</a>
            <a href="?page=red_post&id=<?=$post['id']?>">редактировать пост</a>
            <?php 
    $check_response_query = $link->prepare("SELECT COUNT(*) FROM otkl WHERE  post_id = :post_id");
    $check_response_query->execute([':post_id' => $post['id']]);
    $hasResponded = $check_response_query->fetchColumn() > 0;
  
    ?>     

    <?php 
            // Используем подготовленный запрос для подсчета количества откликов
            $check_response_query = $link->prepare("SELECT COUNT(*) FROM otkl WHERE post_id = :post_id");
            $check_response_query->execute([':post_id' => $post['id']]);
            $numberOfResponses = $check_response_query->fetchColumn();
            ?>
     <a href="">кол-во откликов: <?=$numberOfResponses?> </a>
   
           
        </div>

    <div class="c_post_img">
    <form id="action-form-<?=$post['id']?>" action="" method="POST">
            <input type="hidden" name="id" value="<?=$post['id']?>" />
            <button type="button" class="del_button_post" onclick="confirmActionPost('action-form-<?=$post['id']?>', 'Вы уверены, что хотите удалить этот пост?', 'del_post');" id="b_admin">
                <img src="assets/img/delKR.png" alt="Удалить">
            </button>
     </form>
    <a href="?page=red_post&id=<?=$post['id']?>"> <img src="assets/img/redd.png" alt="Опубликовать"></a>
      <p class="o_n">Кол-во откликов: 8</p>
    </div>

</div>

<?}?>


<script>
    function confirmActionPost(formId, message, actionType) {
        if (confirm(message)) {
            const formPost = document.getElementById(formId);
            const inputPost = document.createElement('input');

          
            if (actionType === 'del_post') {
                inputPost.setAttribute('name', 'del_post');
            } 

            formPost.appendChild(inputPost);
            formPost.submit();
        }
    }
</script>

<?php 

if (isset($_POST['del_post'])) {
    $id = $_POST['id'];

    $id = intval($id); 
    $sql = "DELETE FROM post WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent"</script>';
    } else {
        echo 'Ошибка при удалении поста.';
    }
}

?>





<script type="text/javascript">
function confirmDelete(postId) {
    var confirmation = confirm("Вы уверены, что хотите удалить этот пост?");
    if (confirmation) {
       
        window.location.href = "?page=admin_kontent&id=" + postId + "&del";
    }
}
</script>

<?php 

if (isset($_GET['del'])) {
    $id = $_GET['id'];

    $id = intval($id); 
    $sql = "DELETE FROM post WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent"</script>';
    } else {
        echo 'Ошибка при удалении поста.';
    }
}

?>


</div>

<div class="pagi">
<?php
  for($i=1; $i<=$total_post; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
      echo '<a href="?page=admin_kontent&p_post='.$i.'">'.$i.'</a> '; 
    }
  }
?>
</div>
<div class="panel">
        <p>Категории постов</p>
    </div>
<div class="kat_list">
    <?php 
    $sql="SELECT * FROM cat_post";
    $result=$link->query($sql);
    foreach($result as $kate){?>
    <div class="kat_list_item">
        <div class="kat_list_item_text">
        <p><?=$kate['name']?></p>
        <img src="<?=$kate['img']?>" alt="">
        </div>
        <div class="kat_list_item_icon">

    <a href="?page=red_kat&id=<?=$kate['id']?>"><img src="assets/img/edit.png" alt="del"></a>
    <a href="?page=admin_kontent&id=<?=$kate['id']?>&del"><img src="assets/img/del.png" alt="red"></a>
    </div>
    </div>
    <?}
    ?>

<?php 

if (isset($_GET['del'])) {
    $id = $_GET['id'];

    $id = intval($id); 
    $sql = "DELETE FROM cat_post WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent"</script>';
    } else {
        echo 'Ошибка при удалении поста.';
    }
}

?>
   
</div>

<div class="new_add_b">
   <a href="?page=add_kat"> <button>добавить категорию</button></a>
</div>
</div>

<!-- ===================================================================разделение вкладок====================================================== -->

</div>

