<?php
$conn=new mysqli('localhost','root','','massanger');
class autoload{
    private $classname;
    private $func;
        function __construct(){
        $url=$_SERVER['REQUEST_URI'];
        $url=trim($url,'/');
        list($notimportant,$notimportant,$this->classname,$this->func)=explode('/',$url,4);
        }
        function autoloading(){
        include 'classes/'.$this->classname.'.php';
        $class_call='';
            switch($this->classname){
                case 'userpage':$class_call=new userpage($_SESSION['id']);
                break;
                case 'box-massage':
                if(isset($_POST['massage']))
                $class_call=new  boxmassage($_SESSION['id'],$_POST['id_receiver'],$_POST['massage']);
                else 
                $class_call=new  boxmassage($_SESSION['id'],$_POST['id_receiver'],'');
                break; 
               }
        $class_call->{$this->func}();
        }
}


?>