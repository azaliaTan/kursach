<?php
    session_start();
    if(isset($_SESSION['uid'])){
        $USER_ID = $_SESSION['uid'];
        $sql = "SELECT * FROM user WHERE id='$USER_ID'";
        $result = $link->query($sql);
        $SIGNIN_USER = $result->fetch();
        
    }
    if(isset($_GET['do'])){
        if($_GET['do'] == 'exit'){
            session_unset();
            echo '<script>document.location.href="?"</script>';
        }
    }
?>