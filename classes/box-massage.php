<?php
 $conn=new mysqli('localhost','root','','massanger');
class boxmassage{
    public $sender='';
    public $receiver='';
    public $massage='';
    function validate($var){
        $var=htmlspecialchars($var);
        $var=trim($var);
        $var=stripcslashes($var);
        return $var;
    }
    function __construct($sender,$receiver,$massage){
        $this->sender=$this->validate($sender);
        $this->receiver=$this->validate($receiver);
        $this->massage=$this->validate($massage);
    }
    public function sendmassage(){
        
         if($this->massage==''||$this->receiver==''||$this->sender=='')
                return "";
            
        $sql="insert into massages(id_sender,id_receiver,massage) values('$this->sender','$this->receiver','$this->massage')";
        $GLOBALS['conn']->query($sql);
        echo $GLOBALS['conn']->error;
   
    }
    //function for confirm if function wasread 
    function wasreadmassage($id){
         $sql="update massages set state='read' where id='$id'";
        $GLOBALS['conn']->query($sql);
        echo $GLOBALS['conn']->error; 
        echo '';
    }
    
    public function printmassage(){
        $sql='select * from massages  where id_sender="'.$this->sender.'" and id_receiver="'.$this->receiver.'" or id_sender="'.$this->receiver.'" and id_receiver="'.$this->sender.'"';
            ;
         $res=$GLOBALS['conn']->query($sql);
       
        echo $GLOBALS['conn']->error;
       $i=0;
        while($row=mysqli_fetch_assoc($res)){
            $state=$row['state'];
            if($row['id_sender']==$_SESSION['id']){
              if($state=='read')
              echo "<div class=' col-lg-12 receiver'  data-toggle=tooltip title='$state' >"."<span class=col-lg-12>".$row['massage'].'</span>'.'<p class=col-lg-12 style=direction:rtl> &#x2713;&#x2713;</p>'."</div>";//this line for if i am send massage 
              else 
               echo "<div class=' col-lg-12 receiver'  data-toggle=tooltip title='$state' >"."<span class=col-lg-12>".$row['massage'].'</span>'.'<p class=col-lg-12 style=direction:rtl> &#x2713;</p>'."</div>";
            
            }
            else  {  
                             
               //$this->wasreadmassage($row['id']);      
                    echo "<div class=' col-lg-12 sender'  data-toggle=tooltip title=read >"."<span class=col-lg-12>".$row['massage'].'</span>'.'<p class=col-lg-12 style=direction:rtl> &#x2713;&#x2713;</p>'."</div>";//this line for if i am send massage     
            }
                $i++;
        }
     
    }
}

?>