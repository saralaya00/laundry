<html>
  <head>
    <title><?php echo $title; ?></title>
   
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  
   <!-- <script type="text/javascript" src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.1.2/css/select.dataTables.min.css" />
    <link rel="stylesheet" href="assets/css/mystyle.css">-->
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
      <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
      <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      <link rel="stylesheet" href="assets/css/mystyle.css">
  <style> 
      body  
            {  
                    margin:0;  
                    padding:0;  
                    background-color:#f1f1f1;  
            }  
            .box  
            { 
                   overflow-y: auto;
                   height: 700px;
                    background-color:#fff;  
                    border:1px solid #ccc;  
                    border-radius:5px;  
                    padding-top: 50px;
                   
            }  
            </style>
  </head>
  <body class="fix-header fix-sidebar">
  <div id="main-wrapper">
            <div class="header">
                
                   <nav class="navbar top-navbar navbar-expand-md navbar-light">
                                    <div class="container-fluid">
                                      <div class="navbar-header">
                                            <a class="navbar-brand" href="#">
                                                    <!-- Logo icon -->
                                       
                                                    <b><img src="assets/images/cloth.png" class="profile-pic" style="max-width: width 20px;max-height:30px;margin-top:-5px;" /></b>
                                                    <!--End Logo icon -->
                                                    <!-- Logo text -->
                                                    <span> <b> Laundry </b> </span>
                                                </a>
                                      </div>
                                     
                                      <div class="navbar-header navbar-right pull-right">
                                            <ul class="nav pull-right">
                                              <li class="pull-right nav-item dropdown"> <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                
                                                <i class="fas fa-user-lock"></i>
                                              </a>
                                              <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">New Messages:</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>David Miller</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome! These messages clip off when they reach the end of the box so they don't overflow over to the sides!</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>Jane Smith</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00 instead of 4:00. Thanks!</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <strong>John Doe</strong>
                  <span class="small float-right text-muted">11:21 AM</span>
                  <div class="dropdown-message small">I've sent the final files over to you for review. When you're able to sign off of them let me know and we can discuss distribution.</div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#">View all messages</a>
              </div>
            </li>
                                             
                                              <li class="pull-right"><a href="#">
                                                <i class="fas fa-clipboard-list"></i>
                                              </a></li>
                                              <li class="pull-right"><a href="#">
                                                <i class="fas fa-bell"></i>
                                              </a></li>
                                              <li class="pull-right"><a href="#">
                                                <i class="fas fa-cart-arrow-down"></i>
                                              </a></li>
                                              <li class="pull-right"><a href="#">
                                                <i class="far fa-thumbs-up"></i>
                                              </a></li>
                                            </ul>
                                          </div> <!--/.navbar-right -->
                                      
                                    </div>
                                  </nav>
            </div>
<!-- end of header part-->
 <div class="container-fluid">
    <div class="row">   
        <div class="col-sm-3 box">
          
            
           
                <div class="well" style="width:30%; ">iron

                </div>
              <!--<div class="well" style="width:30%">Basic Well

                </div>
                <div class="well" style="width:30%">Basic Well

                </div>
                <div class="well" style="width:30%">Basic Well

                </div>-->
           
         
          

       </div>

  <div class="col-sm-1">

        </div>


      
        
        <div class="col-sm-8 box">
           <h3 align="center"><?php echo $title; ?></h3><br/>
          <div class="table-responsive">
              <br/>
              <table id="user_data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10%">Image</th>
                        <th width="35%">First Name</th>
                        <th width="35%">last Name</th>
                        <th width="35%">Quantity</th>
                        <th width="35%">edit</th>
                        <th width="35%">Delete</th>
                        <th width="35%">select</th>
                    </tr>    
                </thead>  
              </table>
             </div> 
            
       </div> 
       </div>
</div>
<!--space>-->
<div class="container-fluid">
    <div class="row">
        </br>
        </div>
        </div>
<!-- end of space>-->

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10">
        </div>   
   <div class="col-sm-2">
    <button type="button" class="btn btn-success">Place Order</button>
    </div>
    </div>
 </div>

            <footer class="footer">
              <div class="container">
                <span class="text-muted">&copy; 2017 | pooja v tendulkar.| All rigths reserved.</span>
              </div>
            </footer>
</div>           
    
</body>   
</html> 
 
<script type="text/javascript" language="javascript">
$(document).ready(function(){
    var dataTable = $('#user_data').DataTable({
       "processing":true, 
       "serverSide":true,
       "order":[],
       "ajax":{
           url:"<?php echo base_url().'customer/fetch_user';?>",
           type:"POST"
       },
       "columnDefs":[
           {
              "targets":[0,1,2,3,4,5,6], 
              "orderable":false,
           }
       ]
    });
});
</script>


  