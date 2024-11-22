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
    $sql="SELECT * FROM news WHERE id='$get_id'"; 
    $result=$link -> query($sql);
    $new=$result ->fetch(); }


                
                $id_cat = $new['kat_id'];
                $cat = $link->query("SELECT * FROM cat_news WHERE `id`='$id_cat'")->fetch(2);
               ?>


<div class="container">

<div class="one_post">
    <p class="Name">Подробнее о новости</p>

    <div class="one_news">
        <div class="one_news_inner">
            <div class="item_img_new">
                <img src="<?=$new['img']?>" alt="">
              
                <p>
                    <span class="kat_color">категория:</span> 
                    <span class="event_news"><?=$cat['name']?></span>
    
                </p>
        
            </div>


            <div class="item_text_news">
                <p class="opis_name"><?=$new['name']?></p>
                <p class="k_mob">
            
                    <span class="kat_color">категория:</span> 
                    <span class="event_news"><?=$cat['name']?></span>
    
                </p>
                <p class="opis_ine"><?=$new['opis']?></p>

                <a href="?page=news" class="nazad_news">вернуться назад</a>
            </div>
    </div>
</div>

</div>





