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
<a href="?page=admin_kontent">  <button class="tab">посты</button></a>
   <a href="?page=admin_kontent_otz"><button class="tabb">отзывы</button></a>
    <a href="?page=admin_kontent_news"><button class="tab">новости</button></a>
    <a href="?page=admin_kontent_polz"><button class="tab">пользователи</button></a>
    <a href="?page=admin_kontent_sob"><button class="tab">события</button></a>
</div>


<div class="c_post_i" id="с_otz_list">
<div class="kategory">
                <p>Категории:</p>
             <?php 
              $l = $link->query("SELECT * FROM cat_otz")->fetchAll(PDO::FETCH_ASSOC);
              
              foreach($l as $lo){?>
           
           <a href="?page=admin_kontent_otz&kat=<?=$lo['id']?>"><?=$lo['name']?></a>

           <?}
     
             
             ?>
             <a href="?page=admin_kontent_otz">показать все</a>
            </div>

            <div class="kat_mobile">
                <div class="form-group">
                    <label for="mySelect">Категория:</label>
                    <select id="mySelect" onchange="window.location.href=this.options[this.selectedIndex].value">
                        <option value="">выберите</option>
                        
                       
                        <?php 
                         $l = $link->query("SELECT * FROM cat_otz")->fetchAll(PDO::FETCH_ASSOC);
                         foreach($l as $lo){?>
                            <option value="?page=admin_kontent_otz&kat=<?=$lo['id']?>"><?=$lo['name']?></option>
                         <?}?>
                         <option value="?page=admin_kontent_otz">показать все</option>
              
                    
                    </select>
                </div>
            </div>
<div class="c_post_list">

<?php 
   $limit_otz = 6;
   $pages=isset($_GET['p_otz']) ? (int) $_GET['p_otz']:1;
   if($pages<1){
    $pages=1;
   }

   $offset_otz=($pages-1) * $limit_otz;
   $sql = "SELECT COUNT(*) FROM `otz`";
   $rows=$link->query($sql)->fetchColumn();
   $total_otz= ceil($rows/$limit_otz);
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
        echo '<script>document.location.href="?page=admin_kontent_otz"</script>'; 
    }
} 
$sql="SELECT * FROM `otz` $dop_sql LIMIT $limit_otz OFFSET $offset_otz" ;
$result=$link->query($sql);
foreach($result as $otz){?>
 <div class="c_post">

        <div class="c_post_text">
            <p class="zayavka">Отзыв №<?=$otz['id']?></p>
            <?php 
                $id = $otz['kat_id'];
                $kat = $link->query("SELECT * FROM cat_otz WHERE `id`='$id'")->fetch(2);
    ?>
<p><span class="dark-gray">Категория:</span> <?=$kat['name']?></p>
<p><span class="dark-gray">Заголовок поста:</span> <?=$otz['name']?></p>
<p class="z_opis"><span class="dark-gray">Подробное описание:</span> <?=$otz['opis']?></p>
<?php 
                $id_ath = $otz['author_id'];
                $author_otz = $link->query("SELECT * FROM user WHERE `id`='$id_ath'")->fetch(2);
 ?>
<p><span class="dark-gray">Автор:</span> <span class="black"><?=$author_otz['name']?> <?=$author_otz['surname']?>,</span> <?=$author_otz['student_group']?> группа</p>
<?php 

if($otz['anonim']==1){
    echo '<p><span class="dark-gray">Анонимность:</span> <span class="black">да</span></p>';
}else{
    
echo '
<p><span class="dark-gray">Анонимность:</span> <span class="black">нет</span></p>';
}


?>

<!-- 
<p><span class="dark-gray">Анонимность:</span> <span class="black">да</span></p> -->
        </div>

        <div class="c_post_but">
        <a href="#" onclick="confirmDelete(<?=$otz['id']?>); return false;">удалить отзыв</a>
        <a href="?page=red_otz&id=<?=$otz['id']?>">редакт. отзыв</a>
        <?php  
if($otz['anonim'] == 1) {
    echo '<a href="?page=admin_kontent_otz&id=' . $otz['id'] . '&anon"><p class="o_n">Выкл. анонимность</p></a>';
} else {
    echo '<a href="?page=admin_kontent_otz&id=' . $otz['id'] . '&anonim"><p class="o_n">Вкл. анонимность</p></a>';
}
?>
        </div>
   

   

    <div class="c_post_img">
    <form id="action-form-<?=$otz['id']?>" action="" method="POST">
            <input type="hidden" name="id" value="<?=$otz['id']?>" />
            <button type="button" class="del_button_post" onclick="confirmActionOtz('action-form-<?=$otz['id']?>', 'Вы уверены, что хотите удалить этот отзыв?', 'del_otz');" id="b_admin">
                <img src="assets/img/delKR.png" alt="Удалить">
            </button>
     </form>
     <a href="?page=red_otz&id=<?=$otz['id']?>"><img src="assets/img/redd.png" alt=""></a>
     <?php  
if($otz['anonim'] == 1) {
    
    echo '<a href="?page=admin_kontent_otz&id=' . $otz['id'] . '&anon"><p class="o_n">выкл. анонимность</p></a>';
} elseif ($otz['anonim'] == 0) {
   
    echo '<a href="?page=admin_kontent_otz&id=' . $otz['id'] . '&anonim"><p class="o_n">вкл. анонимность</p></a>';
}
?>
     
    </div>

</div>
<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;




if (isset($_GET['anonim'])) {
    // Переключаем анонимность
    $new_anonim = $otz['anonim'] == 0 ? 1 : 0;

    $sql = "UPDATE otz SET anonim = '$new_anonim' WHERE id = '$id'";
    $result = $link->query($sql);
    
    if($result) {
        // Успешное обновление, перенаправляем обратно для обновления состояния
      echo  '<script>document.location.href="?page=admin_kontent_otz"</script>';
    } else {
        echo 'Ошибка при изменении анонимности';
    }
}
?>



<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;




if (isset($_GET['anon'])) {
   

    $sql = "UPDATE otz SET anonim = 0 WHERE id = '$id'";
    $result = $link->query($sql);
    
    if($result) {
        // Успешное обновление, перенаправляем обратно для обновления состояния
      echo  '<script>document.location.href="?page=admin_kontent_otz"</script>';
    } else {
        echo 'Ошибка при изменении анонимности';
    }
}
?>

<? } ?>




<script>
    function confirmActionOtz(formId, message, actionType) {
        if (confirm(message)) {
            const formOtz = document.getElementById(formId);
            const inputOtz = document.createElement('input');

          
            if (actionType === 'del_otz') {
                inputOtz.setAttribute('name', 'del_otz');
            } 

            formOtz.appendChild(inputOtz);
            formOtz.submit();
        }
    }
</script>

<?php 

if (isset($_POST['del_otz'])) {
    $id = $_POST['id'];

    $id = intval($id); 
    $sql = "DELETE FROM otz WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent_otz"</script>';
    } else {
        echo 'Ошибка ';
    }
}

?>



<?php 

if (isset($_GET['del'])) {
    $id = $_GET['id'];

    $id = intval($id); 
    $sql = "DELETE FROM otz WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent_otz"</script>';
    } else {
        echo 'Ошибка при удалении отзыва.';
    }
}

?>



<script type="text/javascript">
function confirmDelete(otzId) {
    var confirmation = confirm("Вы уверены, что хотите удалить этот отзыв?");
    if (confirmation) {
       
        window.location.href = "?page=admin_kontent_otz&id=" + otzId + "&del";
    }
}
</script>

</div>
   


<div class="pagi">
<?php
  for($i=1; $i<=$total_otz; $i++){
   
    if($i == $pages) {
    
      echo '<span style="color: rgba(34, 86, 156, 1);; font-weight: bold;">'.$i.'</span> '; 
    } else {
      echo '<a href="?page=admin_kontent_otz&p_otz='.$i.'">'.$i.'</a> '; 
    }
  }

?>
</div>


<div class="panel">
        <p>Категории отзывов  </p>
    </div>
<div class="kat_list">
    <?php 
    $sql="SELECT * FROM cat_otz";
    $result=$link->query($sql);
    foreach($result as $otzyv){?>
    <div class="kat_list_item">
        <div class="kat_list_item_text">
        <p><?=$otzyv['name']?></p>
        </div>
        <div class="kat_list_item_icon">

    <a href="?page=red_kat_o&id=<?=$otzyv['id']?>"><img src="assets/img/edit.png" alt="del"></a>
    <a href="?page=admin_kontent_otz&id=<?=$otzyv['id']?>&del"><img src="assets/img/del.png" alt="red"></a>
    </div>
    </div>
    <?}
    ?>

<?php 

if (isset($_GET['del'])) {
    $id = $_GET['id'];

    $id = intval($id); 
    $sql = "DELETE FROM cat_otz WHERE id='$id'";
    $result = $link->query($sql);
    
    if($result) {
        echo '<script>document.location.href="?page=admin_kontent_otz"</script>';
    } else {
        echo 'Ошибка .';
    }
}

?>
   
</div>

<div class="new_add_b">
   <a href="?page=add_kat_o"> <button>добавить категорию</button></a>
</div>

</div>





