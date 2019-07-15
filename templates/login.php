<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>unnatitech-medical-management</title>
    <link rel="icon" type="image/png" href="public/login/images/favicon.html">
    <link media="all" type="text/css" rel="stylesheet" href="public/login/css/screen.css">
    <link media="all" type="text/css" rel="stylesheet" href="public/login/css/font.css">
    <link media="all" type="text/css" rel="stylesheet" href="public/login/css/bootstrap.min.css">
        <style type="text/css">
         #loginForm label.error {
            margin-left: 10px;
            width: auto;
            display: inline;
            font-weight: 100;
        }  
    </style>
</head>
<body id="app-layout" class="login_back color_bg wrapper">     
<div>
<div class="container">
    <div class="row wrapper">
        <div class="col-md-6 col-md-offset-3">
        <div class="logo_image"><img src="public/login/public/images/logo-new.png" alt="logo"></div>
            <div class="panel panel-default">
              <div class="panel-heading login_header">Login</div>
                <div class="panel-body">
                  <div  id="error"></div> 
                    <form class="form-horizontal" role="form"  method="post" action="" id="loginForm">
                        <input type="hidden" name="_token" value="piEl2DZ2F5N8nGW2L1Y73MSFsdWVW4yVl4JNodAw">
                        <div class="col-md-12">
                                                  </div>  
                        <div class="form-group">     
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-user glyphiconLinkColor"></span>
                           
                                <input type="text" class="form-control new_form" name="username" onblur="check()"  id="uname" placeholder="User Name" autofocus required>
                                                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-lock glyphiconLinkColor"></span>
                                <input type="password" class="form-control new_form" name="password" id="password" placeholder="Password" required>
                                                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" > Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn col-md-12 col-xs-12 login_submit">
                                    <i class="fa fa-btn fa-sign-in"></i>Login
                                </button>
                            </div>
                        </div>
                    </form>
                    <!--<div> <a href="signup.php" class="sign-up">Don't have an account yet? <strong>Sign Up</strong></a> 
                   </div>--> 
                </div>
            </div>            
        </div>       
    </div>
</div>
</div>
<script type="text/javascript" src="public/assets/js/login.js"></script> 
    <script type="text/javascript" src="public/assets/js/libs/jquery-1.10.2.min.js"></script> 
    <script type="text/javascript" src="public/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
        function check(val)
        {
            $.ajax({
            type: 'post',
            url: 'cheak_cook.php',
            data: $('#loginForm').serialize(),
            success: function (datas) {
              var data = datas;
              console.log(data);              
              if(data){                        
                 $("#password").val(data);
              }
            }
        });
        }    
        $(function () {
        $('#loginForm').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: 'login_save.php',
            data: $('#loginForm').serialize(),
            success: function (datas) {
              var data = datas;
              console.log(data);              
              if(data == '1'){                        
                 window.location.href = 'index.php';
              }else{
                 document.getElementById("error").innerHTML = "Username Or Password Not Match";
              }
            }
          });
          return false;
        });
      });
</script>
</body>
</html>