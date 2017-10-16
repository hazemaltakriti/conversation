<?php
$conn=new mysqli('localhost','root','','massanger');   

     function validate($var){
        $var=htmlspecialchars($var);
        $var=trim($var);
        $var=stripcslashes($var);
        return $var;
        }


class auth_signup{
    
    public $emailerr='';
    public $passworderr='';
    public $nameerr='';
    public $email;
    public $password;
    public $name;
    public $id;
    function __construct($name,$email,$password){
        $this->email=validate($email);
        $this->password=validate($password);
        $this->name=validate($name);
    }   
       function error(){
            $error=1;
            if (!preg_match("/^[a-zA-Z ]*$/",$this->name)) {
                $this->nameerr = "Only letters and white space allowed"; 
                $error=0;
              }

              if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $this->emailerr='invalid email';$error=0;   
            }
            else {
                $sql='select email from user where email="'.$this->email.'"';
                $res=$GLOBALS['conn']->query($sql);
               
                   if($res->num_rows>0){
                    $this->emailerr='this email was registered before';
                $error=0;
                }
            }
            if(strlen($this->password)<10){
                $this->passworderr='password must be 10 letters at least ';
                $error=0;
            };
            return $error;
        }
        // line for insert new row for make user online 
       function insertonline(){
        $password=sha1($this->password);
        $sql="select id from user where email='$this->email' and password='$password' ";
        $res=$GLOBALS['conn']->query($sql);
        echo $GLOBALS['conn']->error;
        $res=mysqli_fetch_assoc($res);
        $this->id=$res['id'];
        $time=time();
        $sql="insert into lastseen(id_u,lastseen) values('$this->id','$time')";
        $GLOBALS['conn']->query($sql);
       
        echo $GLOBALS['conn']->error;
    
      }
        function auth(){
            
            if($this->error()){
              $password=sha1($this->password);
            $sql='insert into user(name,email,password) values("'.$this->name.'","'.$this->email.'","'.$password.'")';
            $GLOBALS['conn']->query($sql);
            echo  $GLOBALS['conn']->error;
            $this->insertonline();  
            $_SESSION['id']=$this->id;
            $_SESSION['login']=1;
            header('location:index.php'); 
            
                }   
        }
}
/* class for login
--------------------
/------------------\
/------------------\
*/
class auth_login{
    public $emailerr='';
    public $passworderr='';  
    public $name='';
    public $email;
    public $password;
       function  __construct($email,$password){
            $this->email=validate($email);
            $this->password=validate($password);
        }
        function error(){
            $error=1;
              if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
                $this->emailerr='invalid email';$error=0;   
            }
            else {
                
                /* this lines  for validate if password is error and email is true*/
                $sql='select email from user where email="'.$this->email.'"';
                $res=$GLOBALS['conn']->query($sql);
                   if($res->num_rows==1){
                    $sql='select * from user where email="'.$this->email.'" and password="'.sha1($this->password).'"';
                        $res=$GLOBALS['conn']->query($sql);
                        if($res->num_rows==0){
                            $this->passworderr='password is uncorrect ';
                            $error=0;
                           
                        }
                }
                else {
                    $this->emailerr='this email is no there';$error=0;
                };
            }
            return $error;
        }
        /*this fucntion for get name and id */
        function get_name_id(){
            $sql='select id,name from user where email="'.$this->email.'"and password="'.sha1($this->password).'"';
            $res=$GLOBALS['conn']->query($sql);
            $res=mysqli_fetch_assoc($res);
            $this->id = $res['id'];
            $this->name=$res['name'];
        }
        //function for insert online 
       
    
    
        function auth(){
            if($this->error()){
             
                $this->get_name_id();
               
                $_SESSION['name']=$this->name;
                $_SESSION['id']=$this->id;
                 $_SESSION['login']=1;
                header('location:index.php'); 
            }
        }
}




?>