<!--topbar!-->
<?php
include 'topbar.php';
?>
<!-- content !-->
<?php
session_start();
if(!isset($_SESSION['login']))
    include 'login.php';
    else{    
        include 'userpage.php';
        /*include js for userpage */
        echo '<script src=js/userpage.js></script>';
    }

?>