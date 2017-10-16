<html>
<style>
.form-border {
        border: solid 10px #e4d4d4;
        padding: 20px;
        background-color: #f8f8f8;
    }
    .error{
        color:red;
    }
   

</style>
<?php
include 'classes/login.php';
if(isset($_POST['signup'])){
    $signup=new auth_signup($_POST['namesignup'],$_POST['emailsignup'],$_POST['passwordsignup']);
    $signup->auth();
  
 }
if(isset($_POST['login'])){
 $login=new auth_login($_POST['emaillogin'],$_POST['passwordlogin']);
 $login->auth();
}
?>

<link href="login.css" stylesheet='css'>
<!--  log in design !-->

<nav class="navbar navbar-default">
    <form class="col-lg-12" method='post' action='index.php'>
        <div class="col-lg-12" style="height:20px;"></div>
        <div class="col-lg-3">
            <div class="col-lg-3">
                Email:
            </div>
            <div class="col-lg-9">
                <input required class="form-control" placeholder="Email" name='emaillogin' value=<?php if(isset($login)) echo $login->email ?>>
            </div>
           
        </div>
        <?php if(isset($login))
                if($login->emailerr!='')
                    echo '<div class="col-lg-1 error">',$login->emailerr,'</div>';
        ?>
        
        <div class="col-lg-3">
            <div class="col-lg-3">
                password:
            </div>
            <div class="col-lg-9">
                <input required class="form-control" placeholder="password" name='passwordlogin' value=<?php if(isset($login)) echo $login->password ?>>
            </div>


        </div>
        <?php if(isset($login))
        if($login->passworderr!='')
            echo '<div class="col-lg-1 error">',$login->passworderr,'</div>';
            ?>
        <div class="col-lg-2">
            <button type='submit' class='form-control btn btn-info' name='login'>login</button>
        </div>
    </form>
</nav>

<!--signup!-->
<div class="col-lg-6 col-lg-offset-3">
    <form class="col-lg-12 form-border" method='post' action='index.php'>
        <div class="col-lg-12" style="height:30px;"></div>
        <div class='col-lg-12'>
            <div class="col-lg-12">Name</div>
            <div class="col-lg-10">
                <input required placeholder="name" class="form-control" name='namesignup' value=<?php if(isset($signup)) echo $signup->name?>>
            </div>
            <div class='col-lg-12 error'>
            <?php if(isset($signup)) echo $signup->nameerr?>
            </div>          
        </div>
        <div class="col-lg-12" style="height:20px;"></div>
        <div class='col-lg-12'>
            <div class="col-lg-12 ">Email</div>
               
            <div class="col-lg-10">
                <input required placeholder='email' name='emailsignup' value='<?php if(isset($signup)) echo $signup->email; ?>' class='form-control'>
                <div class='col-lg-12 error'>
                <?php if(isset($signup)) echo $signup->emailerr;?>
                    </div>
            </div>
        </div>
        <div class="col-lg-12" style="height:20px;"></div>
        <div class='col-lg-12'>
            <div class="col-lg-12 ">passowrd</div>
            <div class="col-lg-10">
                <input required placeholder="password" name='passwordsignup' type='password' class="form-control" value= <?php if(isset($signup)) echo $signup->password;?>>
                <div class='col-lg-12 error'>
                    <?php if(isset($signup)) echo $signup->passworderr;?>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="height:20px;"></div>
        <div class=" col-lg-12">

            <div class="col-lg-10">
                <button type='submit' name="signup" class="btn btn-info form-control">signup</button>
            </div>
        </div>
    </form>
</div>

</html>
