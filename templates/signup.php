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
         #signupForm label.error {
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
         <div class="panel panel-default">
              <div class="panel-heading login_header">Sign Up</div>
                <div class="panel-body">
                  <div  id="error"></div> 
                    <form class="form-horizontal" role="form"  method="post" action="" id="signupForm">
                        <input type="hidden" name="_token" value="piEl2DZ2F5N8nGW2L1Y73MSFsdWVW4yVl4JNodAw">
                        <div class="col-md-12">
                                                  </div>  
                        <div class="form-group">     
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-user glyphiconLinkColor"></span>
                           
                                <input type="text" class="form-control new_form" name="name" id="name" placeholder="Name" autofocus required>
                                                            </div>
                        </div>

                        <div class="form-group">     
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-user glyphiconLinkColor"></span>
                           
                                <input type="text" class="form-control new_form" name="username" id="uname" placeholder="User Name" autofocus required>
                                                            </div>
                        </div>

                        <div class="form-group">     
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-user glyphiconLinkColor"></span>
                           
                                <input type="text" class="form-control new_form" name="email" id="email" placeholder="Email" pattern="[^@\s]+@[^@\s]+"  required>
                                                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-lock glyphiconLinkColor"></span>
                                <input type="password" class="form-control new_form" name="password" id="password"  placeholder="Password" required>
                                                            </div>
                        </div>

                        <div class="form-group"> 
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-lock glyphiconLinkColor"></span>
                                <input type="password" class="form-control new_form" name="confirm_password" id="confirm_password"  placeholder="Confirm Password" required>
                                                            </div>
                        </div>

                        <div class="form-group"> 
                            <div class="col-md-12 login-input">
                            <span class="glyphicon glyphicon-lock glyphiconLinkColor"></span>
                                <input type="text" class="form-control new_form" name="phone" id="phone"  placeholder="Phone" pattern="[7-9]{1}[0-9]{9}" required>
                                                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn col-md-12 col-xs-12 login_submit">
                                    <i class="fa fa-btn fa-sign-in"></i>Sign Up
                                </button>
                            </div>
                        </div>
                    </form>
                    <div> <a href="login.php" class="sign-up"><strong>Log In</strong></a> 
                   </div> 
                </div>
            </div>            
        </div>       
    </div>
</div>
</div>


 
<script type="text/javascript">
    
        $(function () {
        $('#signupForm').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: 'signup_save.php',
            data: $('#signupForm').serialize(),
            success: function (datas) {
              var data = datas;                          
              if(data == '1'){
                
                  window.location.href = 'index.php';
              }else{
                 document.getElementById("error").innerHTML = "Username Already Exist";
              }
            }
          });
          return false;
        });
      });


var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
</script>
</body>
</html>