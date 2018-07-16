<html>
  <head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/mystyle.css">
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
                                              <li class="pull-right"><a href="#">
                                                <i class="fas fa-user-lock"></i>
                                              </a></li>
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
          
          <?php
            if($fetch_data->num_rows() > 0)
              {
                foreach($fetch_data->result() as $row)
                {
           ?>
                <div>
                  <button type="button" class="btn btn-success" style=" padding:10%; margin:12%; width:50%;" ><?php echo $row->service_name; ?></button><br/>
                  </div>
                  <?php
                }
              }
              else
              {
               ?>
               <div>No data found</div>
               <?php
              }
              ?>
        </div>

        <div class="col-sm-1"> </div>      
        
        <div class="col-sm-8 box">
          <h3 align="center"><?php echo $title; ?></h3>
            <br/>
            <div class="table-responsive">
              <br/>
              <table id="order_details" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="35%">id</th>
                        <th width="35%">Item</th>
                        <th width="35%">Service</th>
                        <th width="35%">Rate</th>
                        <th width="35%">Quantity</th>
                        <th width="35%">Price</th>
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
        <div class="col-sm-10"></div>   
          <div class="col-sm-2"><button type="button" class="btn btn-success">Place Order</button></div>
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
    var dataTable = $('#order_details').DataTable({
       "processing":true, 
       "serverSide":true,
       "order":[],
       "ajax":{
           url:"<?php echo base_url().'customer_controller/getItemServiceDetails';?>",
           type:"POST",
       },
       "columnDefs":[
           {
              "targets":[0,1,2,3,4,7,8], 
              "orderable":false,
           }
       ]
    });
});
  </script>
 


