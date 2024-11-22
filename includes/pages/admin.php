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
       <a href="?page=admin" id="l">заявки на публикацию</a>

        <a href="?page=admin_kontent">контент портала</a>

    </div>
</div>

<div class="admin_vkladki">
    <button onclick="showSection('posts')" id="post_tab" class="tab  ">посты</button>
    <button onclick="showSection('feedbacks')" id="feedback_tab" class="tab">отзывы</button>
</div>

<div class="z_post_list" id="z_post_list">

<?php 
   $limit = 5;
   $pages=isset($_GET['p']) ? (int) $_GET['p']:1;
   if($pages<1){
    $pages=1;
   }

   $offset=($pages-1) * $limit;
   $sql = "SELECT COUNT(*) FROM `z_post`";
   $rows=$link->query($sql)->fetchColumn();
   $total= ceil($rows/$limit);
   ?>

<?

$sql="SELECT * FROM `z_post` LIMIT $limit OFFSET $offset" ;
$result=$link->query($sql);
foreach($result as $post){?>

<div class="z_post">

<div class="z_post_text">
    <p class="zayavka">Заявка №<?=$post['id']?></p>
    <?php 
                
                $id_cat = $post['kat_id'];
                $cat = $link->query("SELECT * FROM cat_post WHERE `id`='$id_cat'")->fetch(2);
               ?>
<p><span class="dark-gray">Категория:</span><?=$cat['name']?> </p>
<p><span class="dark-gray">Заголовок поста:</span> <?=$post['name']?></p>
<p class="z_opis"><span class="dark-gray">Подробное описание:</span><?=$post['opis']?></p>
<?php 
                
                $id_a = $post['author_id'];
                $author = $link->query("SELECT * FROM user WHERE `id`='$id_a'")->fetch(2);
               ?>
<p><span class="dark-gray">Автор:</span> <?=$author['name']?> <?=$author['surname']?>,<span class="black"></span> <?=$author['student_group']?> группа</p>
</div>



<div class="z_post_button">
<form action="" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить эту заявку?');">
    <input type="hidden" name="id" value="<?=$post['id']?>" />
    <input type="submit" value="Удалить заявку" class="del_button_post" name="del">
</form>

<form action="" method="POST" onsubmit="return confirm('Вы уверены, что хотите опубликовать эту заявку?');">
    <input type="hidden" name="id" value="<?=$post['id']?>" />
    <input type="submit" value="Опубликовать пост" class="pub_button_post" name="add">
</form>

</div>

<div class="z_post_img">
        <form id="action-form-<?=$post['id']?>" action="" method="POST">
            <input type="hidden" name="id" value="<?=$post['id']?>" />
            <button type="button" class="del_button_post" onclick="confirmActionP('action-form-<?=$post['id']?>', 'Вы уверены, что хотите удалить эту заявку?', 'del');" id="b_admin">
                <img src="assets/img/delKR.png" alt="Удалить">
            </button>
            <button type="button" class="pub_button_post" onclick="confirmActionP('action-form-<?=$post['id']?>', 'Вы уверены, что хотите опубликовать эту заявку?', 'pub');" id="b_admin">
                <img src="assets/img/like.png" alt="Опубликовать">
            </button>
          
        </form>
</div>

</div>


<script>
    function confirmActionP(formId, message, actionType) {
        if (confirm(message)) {
            const formP = document.getElementById(formId);
            const inputP = document.createElement('input');

            if (actionType === 'del') {
                inputP.setAttribute('name', 'del');
            } else {
                inputP.setAttribute('name', 'add');
            }

            formP.appendChild(inputP);
            formP.submit();
        }
    }
</script>


<?}?>

<?php

if (isset($_POST['add'])) {
    $id = $_POST['id'];

   
    $sql_select = "SELECT * FROM z_post WHERE id='$id'";
    $result = $link->query($sql_select);
    $post=$result->fetch(2);

    if ($post) {
        $name = $post['name'];
        $opis = $post['opis'];
        $kat_id = $post['kat_id'];
        $author_id = $post['author_id'];
        $data=$post['data'];

        $sql_insert = "INSERT INTO post (name, opis, kat_id, author_id, data ) VALUES ('$name', '$opis', '$kat_id', '$author_id', '$data')";
        $result_e = $link->query($sql_insert);
        
    

        $sql_delete = "DELETE FROM z_post WHERE id='$id'";
        $result_ee = $link->query($sql_delete);
        
        echo '<script>document.location.href="?page=admin"</script>';
    }

   
}
?>

<?php 

if (isset($_POST['del'])) {
    $id = $_POST['id'];

        $sql_del = "DELETE FROM z_post WHERE id='$id'";
        $result_d = $link->query($sql_del);
        
        echo '<script>document.location.href="?page=admin"</script>';
    }



?>

<div class="pagi">
<?php
  for($i=1; $i<=$total; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
      echo '<a href="?page=admin&p='.$i.'">'.$i.'</a> '; 
    }
  }
?>
</div>


</div>
</div>



 
<div class="container">
<div class="z_otz_list" id="z_otz_list">

<?php 

$sql = "SELECT * FROM z_otz ";
$result=$link->query($sql);
foreach($result as $otz){?>



<div class="z_post">



<div class="z_post_text">

    <p class="zayavka">Заявка №<?=$otz['id']?></p>
    <?php 
                $id_c = $otz['kat_id'];
                $kat = $link->query("SELECT * FROM cat_otz WHERE `id`='$id_c'")->fetch(2);
    ?>
<p><span class="dark-gray">Категория:</span> <?=$kat['name']?></p>
<p><span class="dark-gray">Заголовок отзыва:</span><?=$otz['name']?></p>
<p class="z_opis"><span class="dark-gray">Подробный отзыв:</span> <?=$otz['opis']?></p>
<?php 
                $id_ath = $otz['author_id'];
                $author_otz = $link->query("SELECT * FROM user WHERE `id`='$id_ath'")->fetch(2);
 ?>
<p><span class="dark-gray">Автор:</span> <span class="black"><?=$author_otz['name']?> <?=$author_otz['surname']?></span> <?=$author_otz['student_group']?> группа</p>
<?php 
if ($otz['anonim'] == 1) {
    echo '<p><span class="dark-gray">Анонимность:</span> <span class="black">да</span></p>';
} else if ($otz['anonim'] == 0) {
    echo '<p><span class="dark-gray">Анонимность:</span> <span class="black">нет</span></p>'; 
}
?>
</div>

<div class="z_post_button">
<form action="" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот отзыв?');">
    <input type="hidden" name="id" value="<?=$otz['id']?>" />
    <input type="submit" value="Удалить отзыв" class="del_button_post" name="del_otz">
</form>

<form action="" method="POST" onsubmit="return confirm('Вы уверены, что хотите опубликовать не анонимно этот отзыв?');">
    <input type="hidden" name="id" value="<?=$otz['id']?>" />
    <input type="submit" value="Опубликовать отзыв" class="pub_button_post" name="add_otz">
</form>

<form action="" method="POST" onsubmit="return confirm('Вы уверены, что хотите опубликовать анонимно этот отзыв?');">
    <input type="hidden" name="id" value="<?=$otz['id']?>" />
    <input type="submit" value="Опубликовать анонимно" class="anon_button_post" name="add_otz_anon">
</form>

</div>

<div class="z_post_img">
    <form id="action-form-<?=$otz['id']?>" action="" method="POST">
        <input type="hidden" name="id" value="<?=$otz['id']?>" />
        
        <button type="button" class="del_button_post" onclick="confirmAction('action-form-<?=$otz['id']?>', 'Вы уверены, что хотите удалить эту заявку?', 'delete');" id="b_admin">
            <img src="assets/img/delKR.png" alt="">
        </button>
        
        <button type="button" class="pub_button_post" onclick="confirmAction('action-form-<?=$otz['id']?>', 'Вы уверены, что хотите опубликовать не анонимно эту заявку?', 'publish');" id="b_admin">
            <img src="assets/img/like.png" alt="">
        </button>

        <button type="button" class="pub_button_post" onclick="confirmAction('action-form-<?=$otz['id']?>', 'Вы уверены, что хотите опубликовать анонимно эту заявку?', 'publish_anonymous');" id="b_admin">
            <img src="assets/img/anon.png" alt="">
        </button>
    </form>
</div>



</div>


<script>
    function confirmAction(formId, message, actionType) {
        if (confirm(message)) {
            const form = document.getElementById(formId);
            const input = document.createElement('input');

          
            if (actionType === 'delete') {
                input.setAttribute('name', 'del_otz');
            } else if (actionType === 'publish') {
                input.setAttribute('name', 'add_otz');
            } else if (actionType === 'publish_anonymous') {
                input.setAttribute('name', 'add_otz_anon');
            }

            form.appendChild(input);
            form.submit();
        }
    }
</script>

<?}?>

<?php

if (isset($_POST['add_otz'])) {
    $id = $_POST['id'];

   
    $sql_select_otz = "SELECT * FROM z_otz WHERE id='$id'";
    $result = $link->query($sql_select_otz);
    $otz=$result->fetch(2);

    if ($otz) {
        $name = $otz['name'];
        $opis = $otz['opis'];
        $kat_id = $otz['kat_id'];
        $author_id = $otz['author_id'];
        


        $sql_insert_otz = "INSERT INTO otz (name, opis, kat_id, author_id, anonim) VALUES ('$name', '$opis', '$kat_id', '$author_id',0)";
        $result_otz = $link->query($sql_insert_otz);
        
    

        $sql_delete_otz = "DELETE FROM z_otz WHERE id='$id'";
        $result_del_o = $link->query($sql_delete_otz);
        
        echo '<script>document.location.href="?page=admin"</script>';
    }

   
}
?>

<?php

if (isset($_POST['add_otz_anon'])) {
    $id = $_POST['id'];

   
    $sql_select_otz = "SELECT * FROM z_otz WHERE id='$id'";
    $result = $link->query($sql_select_otz);
    $otz=$result->fetch(2);

    if ($otz) {
        $name = $otz['name'];
        $opis = $otz['opis'];
        $kat_id = $otz['kat_id'];
        $author_id = $otz['author_id'];
 


        $sql_insert_otz = "INSERT INTO otz (name, opis, kat_id, author_id, anonim) VALUES ('$name', '$opis', '$kat_id', '$author_id',1)";
        $result_otz = $link->query($sql_insert_otz);
        
    

        $sql_delete_otz = "DELETE FROM z_otz WHERE id='$id'";
        $result_del_o = $link->query($sql_delete_otz);
        
        echo '<script>document.location.href="?page=admin"</script>';
    }

   
}
?>

<?php 

if (isset($_POST['del_otz'])) {
    $id = $_POST['id'];

        $sql_del_otz = "DELETE FROM z_otz WHERE id='$id'";
        $result_d_o = $link->query($sql_del_otz);
        
        echo '<script>document.location.href="?page=admin"</script>';
    }

?>








</div>


</div>

<script src="assets/js/admin_vkl.js"></script>

