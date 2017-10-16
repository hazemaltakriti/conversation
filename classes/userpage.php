<?php
 $conn=new mysqli('localhost','root','','massanger');
class userpage{
    public $id;
    function  __construct($id=''){
        $this->id=$id;
    }   
    public function isonline($id){
        
        $sql="select lastseen from lastseen where id_u='$id'";
        $res=$GLOBALS['conn']->query($sql);
        echo $GLOBALS['conn']->error;
        $res=mysqli_fetch_assoc($res);
        $lastseen=$res['lastseen'];
  
         if(time()-$lastseen<20)
         return '<div class="online col-lg-4">online</div>';
         return '<div class="offline col-lg-4">offline</div>';
        
    }
    public function printusers(){
        $sql='select id,name  from user where id<>"'.$_SESSION["id"].'"';
        $res=$GLOBALS['conn']->query($sql);
        echo $GLOBALS['conn']->error;
     
        while($row=mysqli_fetch_assoc($res)){
            if(!$this->isblock($this->id,$row['id']))
                echo '<div class="col-lg-12 text-capitalize  bg-primary users" id=',$row['id'],'>','<div class="col-lg-8 col-md-12" id=name>',$row['name'],'</div>',
                    $this->isonline($row['id']),'</div>';
            }
    }
    // this function for print all user which we ve make conversation with them 
    public function lastconv(){
        $sql='select id_sender,id_receiver,massage from massages where id_sender="'.$this->id.'" or id_receiver="'.$this->id.'" order by id desc';
        $res=$GLOBALS['conn']->query($sql);
        echo $GLOBALS['conn']->error;
        $visit=array();
        $id_users=array();
       while($row=mysqli_fetch_assoc($res)){
           $spec_id = $row['id_sender'] ;//this variable smbol specefic id
           if($spec_id==$this->id)   
           $spec_id = $row['id_receiver'] ;  
           if(isset($visit[$spec_id]))      
                continue;
        $sql="select id,name from user where id='$spec_id'";
          
          $r=$GLOBALS['conn']->query($sql);
          $r=mysqli_fetch_assoc($r);
          echo $GLOBALS['conn']->error;
          if(!$this->isblock($this->id,$r['id']))
            echo '<div class="col-lg-12 text-capitalize  bg-primary users" id=',$r['id'],'>','<div class=col-lg-12 id=name>',$r['name'],'</div>','<br>','<span style=font-size:15px id=massage>',$row['massage'],'</span>','</div>';
            $visit[$spec_id]=1;
       }
    }
  
     public function block(){
        print_r($_POST);
       if(isset($_POST['id_blocked']))
        $id_blocked=$_POST['id_blocked'];
      
        else return ;
         if($this->isblock($this->id,$id_blocked))
            return ;
            
        $sql="insert into block(blocking,blocked) values('$this->id','$id_blocked')" ;      
          
          $res=$GLOBALS['conn']->query($sql);
          echo $GLOBALS['conn']->error;
    }
    //function for validate if user is blocked 
     function isblock($id_blocking,$id_blocked){
       
         $sql="select id from block where blocked='$id_blocked' and  blocking ='$id_blocking' or blocked='$id_blocking' and blocking='$id_blocked'";

         $res=$GLOBALS['conn']->query($sql);
         echo $GLOBALS['conn']->error;
            return $res->num_rows;  
    }
    /*update for user which connect in website */
    public function update_online(){
    
        $time=time();
            $sql="update lastseen set lastseen='$time' where id_u='$this->id'";
            $res=$GLOBALS['conn']->query($sql);
            echo $GLOBALS['conn']->error;         
    }
    public function logout(){
        session_unset();
    }
    public function printblock(){
       
        $sql="select blocked from block where blocking='$this->id'";
        $res=$GLOBALS['conn']->query($sql);
        echo $GLOBALS['conn']->error; 
        while($row=mysqli_fetch_assoc($res)){
            $id_blocked=$row['blocked'];
            $sql="select name from user where id='$id_blocked'";
            $r=$GLOBALS['conn']->query($sql);
            $r=mysqli_fetch_assoc($r);
            echo '<div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 text-capitalize  bg-primary users" id=',$id_blocked,'>','<div class=col-lg-12 id=name>',$r['name'],'</div>','</div>';
            echo '<button class="btn btn-success  col-lg-2 col-md-4 col-xs-4 col-sm-4 unblock" id="'.$id_blocked.'">unblock','</button>';
          
        }
    }
    public function unblock(){
        if(!isset($_POST['id_blocked']))
        return "";
       
        $blocked=$_POST['id_blocked'];
        $sql="delete from block where blocking='$this->id' and blocked='$blocked'";
        $GLOBALS['conn']->query($sql);
        echo $GLOBALS['conn']->error;
    }

}




?>