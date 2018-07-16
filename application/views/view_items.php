<!-- Probable Dead Webpage-->
<html>
    <head>
        <title><?php echo $title?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
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
                    width:900px;  
                    padding:20px;  
                    background-color:#fff;  
                    border:1px solid #ccc;  
                    border-radius:5px;  
                    margin-top:10px;  
            }  
        </style>  
    </head> 

    <body>
        <div class="container box">
            <h3 align="center"> <?php echo $title;?> </h3>
            <br>
            <div class="table-responsive">
                <br>
                <table id="items_table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="40%">Item ID</th>
                            <th width="40%">Name</th>
                            <th width="20%">Operation</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </body>
</html>