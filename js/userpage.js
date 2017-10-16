$('#right_aside').css('height',Math.max(window.innerHeight,$('body').innerHeight()));
var id_user='';
var last_row=0;
var block=[];
var id_u=''; //this varaible point to id to user in toppar 
$('body').on('click','.users',function(){
    $('#user_name').css('display','block');
    $('#user_name').attr('id_u',$(this).attr('id'));
    var id_u= $('#user_name').attr('id_u',id_u);
    $('#user_name').html($(this).children('#name').html());
   
    id_user=$(this).attr('id');
    var massage_length=[];//this array for record length massages from user which user click for specefic if user got new massage 
    var visit=[];//this array for specefic if user got new massage 
setInterval(function(){
    if(block[id_user]==1){
    $('#user_name').css('display','none')
    $('#sendmassage').css('display','none')
    $('#sendmassage').next().css('display','none');
    return ;
    }
    if(id_user!=''||block[id_user]==1){
        $('#sendmassage').css('display','block')
        $('#sendmassage').next().css('display','block');
    }
    $.post('autoload.php/box-massage/printmassage',{
        id_receiver:id_user
        ,lastrow:last_row
    },
    function (data ,status){
    $('#box-massage').children().remove();
    $('#box-massage').append(data);
     if(visit[id_user]!=1)
        massage_length[id_user]=$('#box-massage').children().length; 
        else 
            if(massage_length[id_user]<$('#box-massage').children().length){
           
                massage_length[id_user]=$('#box-massage').children().length; 
               
                var audio=new Audio();
                audio.src='communication-channel.mp3';
               
                audio.play();
                $('#box-massage_parent').scrollTop(100000);
               

            }
     visit[id_user]=1;

            
        });
},1000);
});
/*lat conversatio  */
setInterval(function(){

    $.post('autoload.php/userpage/lastconv',{
    },
    function (data ,status){
    $('#lastconv').children().remove();
  
    $('#lastconv').append(data);
      
        });
},5*1000);
//this for onclick send 
$('#send').click(function(){
var massage=$('#sendmassage').val();

$('#sendmassage').val('');

$.post('autoload.php/box-massage/sendmassage',{
     id_receiver:id_user
    ,massage:massage
},
function (data ,status){
    
    });
});
$('body').on('click','#block',function(){
$('#user_name').children().remove();
$('#box-massage').children().remove();
    block[id_user]=1;
    $('#user_name').html('');
    $.post('autoload.php/userpage/block',{
        id_blocked:$('#user_name').attr('id_u')
   },
   function (data ,status){
     
       }); 
});
$massage_length=[];//this array for record length massages from user which user click for specefic if user received massage

setInterval(function(){
    
        $.post('autoload.php/userpage/printusers',{
          
       },
       function (data ,status){
         $('#allusers').children().remove();
         $('#allusers').append(data);
           })
},2*1000);  
setInterval(function(){
    
        $.get('autoload.php/userpage/update_online',{
        },
        function (data ,status){          
            });
    },10*1000);
    /* print block user  */
    $('#blockeduser').click(function(){
      
        $.get('autoload.php/userpage/printblock',{
        },
        function (data ,status){   
            $('#usersblock').children().remove();   
            $('#usersblock').append(data);  
            //alert(data);
            });
      
    }
    );
    /*end block user  */
    /*unblock user */
    $('body').on('click','.unblock',function(){
            var id_blocked=$(this).attr('id');
            $(this).prev().remove();
            $(this).remove();
            block[id_user]=0;
            id_user='';
            console.log(id_user,'what the fuck');
            $.post('autoload.php/userpage/unblock',{
                id_blocked:id_blocked
           },
           function (data ,status){
            
               }); 
        });
    /*end unblcok user  */
/*this line for make signout */
$('#signout').click(function(){
    if(confirm('are you sure you want sign out from this website')){
    $.get('autoload.php/userpage/logout',{
    },
    function (data ,status){      
        location.href='http://localhost:1080/conversation/index.php';    
        });
    }
}
);
/*end of signout */