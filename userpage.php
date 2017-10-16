<?php
/*include class for userpage*/
include 'classes/userpage.php';
    $userpage=new userpage($_SESSION['id']);
?>
    <html>
    <link rel="stylesheet" href="css/userpage.css">

    <body>

        <div class- 'col-lg-12 col-md-12 col-sm-12 col-xs-12' style='padding:0px;'>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='height:30px;border-bottom:solid 1px;background-color:#d73a31;padding:0px;'>
                <div style='height:inherit' class='col-lg-3 col-md-3 col-sm-3 col-xs-3 lead bg-primary text-center'>
                    Last Massage
                </div>
                <div class='col-lg-9 col-md-9 col-sm-9 col-xs-9 ' style='border-left:solid 1px;height:inherit;padding-left:0px;'>
                    <!--print name user click!-->
                    <div class='col-lg-6 col-md-6-col-sm-6 col-xs-6' style='padding-left:0px;'>
                        <div class="dropdown col-lg-12" style='padding-left:0px;'>
                            <div class=' dropdown-toggle bg-primary text-capitalize text-center' data-toggle="dropdown" id='user_name' style='height:30px;'></div>

                            <ul class="dropdown-menu ">
                                <li><a href="#" id='block'>block this user</a></li>
                            </ul>
                        </div>

                        <!--end of print name user click!-->
                    </div>
                    <!--make logout!-->
                    <div class='col-lg-3'>
                        <button class='col-lg-4 btn btn-success' style='height:inherit;padding-left:4px' id='signout'>sign out</button>
                        
                    </div>
                    <div class='col-lg-3 '>
                        <button type="button" class="btn btn-info  col-lg-12 " data-toggle="modal" data-target="#myModal" id='blockeduser'>blocked user</button>
                    </div>

                </div>


            </div>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' style='height:70%;border-right:solid 1px;padding:0px;' id='lastconv'>
                <?php $userpage->lastconv()?>
            </div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' style='height:70%;border-right:solid 1px;' id='box-massage_parent'>
                <div id='box-massage' class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                </div>
            </div>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' style='height:70%;' id='allusers'>
                <?php $userpage->printusers()?>
            </div>
            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='border-top:solid 1px;'></div>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' style='height:30%;border-right:solid 1px;'>
            </div>
            <div class='col-lg-6 col-md-6 col-sm-6 col-xs-6' style='height:30%;border-right:solid 1px;'>

                <textarea id='sendmassage' class='form-control' style='margin-top:20px;'></textarea>
                <button class='btn btn-success form-control' style='margin-top:20px;' id='send'>send</button>
            </div>
            <div class='col-lg-3 col-md-3 col-sm-3 col-xs-3' style='height:50px;'>
            </div>
        </div>
        <!--modal body for print user got block from user !-->

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Blocked user</h4>
                    </div>
                    <div class="modal-body" id='usersblock'>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!--end modal block!-->

    </body>

    </html>
