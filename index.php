<?php 
include('includes/database/connect.php');
include('includes/session.php');
include('includes/helpers.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="shortcut icon" href="assets/img/fav.png" type="image/x-icon">
 
    <title>POCHTA MCK-KTITS</title>
</head>
<body>
<div class="container">

<?php 

include('includes/header.php');
if(isset($_GET['page'])){
    $page=$_GET['page'];
    if($page =='profile'){
        include('includes/pages/profile.php');
    }

    if($page =='admin'){
        include('includes/pages/admin.php');
    }

    if($page =='doska'){
        include('includes/pages/doska.php');
    }

    if($page =='contact'){
        include('includes/pages/contact.php');
    }

    if($page =='news'){
        include('includes/pages/news.php');
    }

    if($page =='one_post'){
        include('includes/pages/one_post.php');
    }

    if($page =='one_news'){
        include('includes/pages/one_news.php');
    }

    if($page =='vhod'){
        include('includes/pages/vhod.php');
    }

    if($page =='add_news'){
        include('includes/pages/add_news.php');
    }
    if($page =='red_news'){
        include('includes/pages/red_news.php');
    }
    if($page =='red_kat'){
        include('includes/pages/red_kat.php');
    }
    if($page =='red_user'){
        include('includes/pages/red_user.php');
    }
    if($page =='red_sob'){
        include('includes/pages/red_sob.php');
    }
    if($page ==='reg'){
        include('includes/pages/reg.php');
    }
     
    if($page ==='admin_kontent'){
        include('includes/pages/admin_kontent.php');
    }
    if($page ==='admin_kontent_otz'){
        include('includes/pages/admin_kontent_otz.php');
    }
    if($page ==='admin_kontent_polz'){
        include('includes/pages/admin_kontent_polz.php');
    }
    if($page ==='admin_kontent_news'){
        include('includes/pages/admin_kontent_news.php');
    }
    if($page ==='admin_kontent_sob'){
        include('includes/pages/admin_kontent_sob.php');
    }
    
    if($page =='user_profile'){
        include('includes/pages/user_profile.php');
    }
    
    if($page =='add_post'){
        include('includes/pages/add_post.php');
    }
    if($page =='zay'){
        include('includes/pages/zay.php');
    }

    if($page =='add_kat'){
        include('includes/pages/add_kat.php');
    }
    if($page =='add_sob'){
        include('includes/pages/add_sob.php');
    }

    if($page =='prof_red'){
        include('includes/pages/prof_red.php');
    }

    if($page =='add_otz'){
        include('includes/pages/add_otz.php');
    }


    if($page =='add_kat_o'){
        include('includes/pages/add_kat_o.php');
    }

    if($page =='red_kat_o'){
        include('includes/pages/red_kat_o.php');
    }

    if($page =='red_post'){
        include('includes/pages/red_post.php');
    }


    if($page =='obr'){
        include('includes/pages/obr.php');
    }
    if($page =='ban'){
        include('includes/pages/ban.php');
    }

    if($page =='admin_pol'){
        include('includes/pages/admin_pol.php');
    }


    
    if($page =='red_otz'){
        include('includes/pages/red_otz.php');
    }






}else{
    include('includes/start.php');
}


include('includes/footer.php');

?>
</div>


</body>
</html>