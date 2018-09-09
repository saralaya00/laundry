<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/mystyle.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
</head> 
<body class="fix-header fix-sidebar bg" data-baseurl=<?php base_url(); ?>>
    <div class="main-wrapper">
            <div class="container">
                    <div class="row text-center "> 
                        <div class="col-md-12">
                                
                                        <br /><br />
                                        <h2>Laundry</h2>
                         
                                        <h5>(Enter your details to continue)</h5>
                                         <br />
                                    
                          
                        </div>
                    </div>
                     <div class="row ">
             
                              <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" />
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                    <strong style="color:blue;">LOGIN</strong>  
                                        </div>
                                        <div class="panel-body">
                                           
                                                   <br />
                                                 <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                                        <input id="text_username" type="text" class="form-control" name="user_name" placeholder="Enter your Username" autofocus="autofocus" required />
                                                    </div>
                                                        <div class="form-group input-group">
                                                        <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                                        <input id="text_password" type="password" class="form-control"  placeholder="Enter your Password" required />
                                                    </div>
                                                <div class="form-group">
                                                        <label class="checkbox-inline">
                                                            <input type="checkbox" /> Remember me
                                                        </label>
                                                        <span class="pull-right">
                                                               <a href="#" >Forgot password ? </a> 
                                                        </span>
                                                    </div>
                                                    
                                                    <button class="btn_login btn btn-success">Login</button>
                                                   <!--OR
                                                 <input type="submit" class="btn btn-success" name="Login" value="Login" />-->
                                                <hr /> 
                                                Not yet registered ? <a href="register.html" >click here </a> 
                                                
                                        </div>
             
                                    </div>
                                </div>
             
             
                    </div>
                </div>

    </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.redirect.js"></script>

        <script>
            let baseURL = $('body').data('baseurl');

            $(document).on('click', '.btn_login', function(){
                let username = $('#text_username').val();
                let password = $('#text_password').val();

                let postData = {
                    username: username,
                    password: password
                };

                $.post(baseURL + 'Homepage_Controller/verify_login', postData)
                .done(function(data){
                    let redir = JSON.parse(data);
                    // console.log(redir);
                    $.redirect(redir.link.toString(), {'slug': redir.slug, 'customer_id': redir.customer_id}, 'POST');
                });
            });
        </script>
</body> 
</html>
     