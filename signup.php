<?php
    
    session_start();

    $errorMessage = ""; $successMessage = ""; $randOTP = ""; $email = "";
    $randOTP = $_SESSION['randOTP']; $email = $_SESSION['email'];

    if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: index.php");
        
    } else {
        ?>
        <style>
            #otpForm {
                display: block;
            }
            #signUpForm {
                display: none;
            }

        </style>
        <?php
    }

    if(isset($_POST['getOTP'])) {
        
        if (!$_POST['email']) {
            
            $errorMessage .= "Your Email Id is required.<br>";
            
        } else {
            
            $link = mysqli_connect("shareddb-q.hosting.stackcp.net", "_users-3131375a2a", "asdf7536951tyuiop1596357", "_users-3131375a2a");
            
            if (mysqli_connect_error()) {
                
                die("There is error in connection to database.");
            
            } else {
                
                $_SESSION['email'] = strtolower($_POST['email']);
                $query = "SELECT `id` FROM `user_info` WHERE `email` = '".$_SESSION['email']."'";
                 if(mysqli_num_rows(mysqli_query($link, $query)) > 0) {
                     
                     $errorMessage = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Ohh!</strong> This email already exists.</p><p>Try  <a href="login.php" class="badge badge-warning">Login</a></p></div>';
                     
                 } else {
                        $_SESSION['randOTP'] = rand(100000, 999999);
                        
                        $message = "Your OTP : ".$_SESSION['randOTP'];
                     
                        mail($_POST['email'], "OTP for Signing you Up at Slam.book", $message );
                     ?>
                        <style>
                            #otpForm {
                                display: none;
                            }
                            #signUpForm {
                                display: block;
                            }

                        </style>
                     <?php
                 }
                
            }
            
        }
        
    }

    if (array_key_exists("signUp", $_POST)) {
        
        
        if (!$_POST['fname']) {
            $errorMessage .= "Your First Name is Required.<br>";
        }
        if (!$_POST['lname']) {
            $errorMessage .= "Your Last Name is Required.<br>";
        }
        if (!$_POST['pword']) {
            $errorMessage .= "Password field is required.<br>";
        }
        if ($_POST['pword'] != $_POST['rePword']) {
            $errorMessage .= "Password mis-match.<br>";
        }
        
        if ($errorMessage != "") {
    
            $errorMessage = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>There is error(s) in your form:</strong></p>'.$errorMessage.'</div>';
        
        } else {
            
            $link = mysqli_connect("shareddb-q.hosting.stackcp.net", "_users-3131375a2a", "asdf7536951tyuiop1596357", "_users-3131375a2a");
            
            if (mysqli_connect_error()) {
                
                die("There is error in connection to database.");
            
            } else {
                $fname = strtoupper($_POST['fname']);
                $lname = strtoupper($_POST['lname']);
                $password = $_POST['pword'];
                
                if ($_POST['otpVal'] != $_SESSION['randOTP']) {
                    
                    $errorMessage = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Opps!</strong> Your OTP doesn\'t match.</p><p>Try again fast.</p></div>';
                    
                } else {
                    
                    $query = "INSERT INTO `user_info` (`fname`, `lname`, `email`, `password`) VALUES ('".mysqli_real_escape_string($link, $fname)."', '".mysqli_real_escape_string($link, $lname)."', '".mysqli_real_escape_string($link, $email)."', '".mysqli_real_escape_string($link, $password)."')";
                    
                    unset($_SESSION['email']);
                    $email = " ";
                    unset($_SESSION['randOTP']);
                    $randOTP = " ";
                    
                    if (!mysqli_query($link, $query)) {
                        $errorMessage = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Ohh!</strong> Couldn\'t Signup.</p><p>Try again later.</p></div>';
                    } else {
                        
                        
                        $query = "UPDATE `user_info` SET password = '".password_hash($_POST['pword'], PASSWORD_DEFAULT)."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
                        
                        mysqli_query($link, $query);
                        
                        $successMessage = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Yup!</strong> Signed up successfully.</p><p>Try  <a href="login.php" class="badge badge-success">Login</a></p></div>';
                        
                    }
                }
            }
        }
    }
    
?>


<!doctype html>
<html lang="en">
  <head>
    <?php include("pages/btwHeadTitle.php");?>
    <title>Slam Book - Signup</title>
      
    <style>

        .page-holder {
            min-height: 100vh;
        }

        .bg-cover {
            background-size: cover !important;
            background-image: url("images/slam-book-bg.jpg");
        }
        
        .center {
            text-align: center;
        }
        
        #form-container {
            margin: 10px auto;
            background: rgba(255, 255, 255, 0.4);
            width: 500px;
            padding: 30px 10px;
            border-radius: 10px;
            
        }
        
        .form-heading {
            margin-bottom: 50px;
        }
        
        @media (max-width: 576px) { 
        
            #form-container {
                width: 100%;
                margin: 0px;
            }
        
        }
  

    </style>
  </head>
  <body class="page-holder bg-cover">

<!--navbar-->
      
      <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark rounded-bottom border-bottom border-success">
          <a class="navbar-brand" href="#"><img src="images/slam-book-logo.png" height="30" alt="LOGO"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item">
                    <a type="button" class="nav-link" tabindex="-1" aria-disabled="true" data-toggle="popover" title="Feature Disabled" data-content="This feature is disabled by the Founder.Coming Soon..." data-placement="bottom">Create</a>
                </li>
              
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
              
            </ul>
            <form class="form-inline my-2 my-lg-0" action="login.php">
                
                
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Login</button>
            </form>
          </div>
        </nav>
      
      
<!--jumbotron-->

        <div class="jumbotron jumbotron-fluid bg-transparent center">
          <div class="container">
            <h1 class="display-4">Sign Up NOW!</h1>
            <p class="lead">Written things on paper do get spoil, so let's store them on cloud.</p>
            <hr class="my-4">
              
          </div>
        </div>
        
  
<!--container-->
      
        <div class="container">
            
            <div id="form-container" class="shadow-lg p-3 mb-5 container">
                <div id="errorBox"><? echo $errorMessage.$successMessage; ?></div>
                
                <form method="post" id="otpForm" class="needs-validation" novalidate>
                
                    <h2 class="center display-4 form-heading">Sign Up Form</h2>
                    
                    <fieldset class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Your Email ID" required>
                        <small class="form-text text-muted">
                             We don't share your email with anyone. 
                          </small>
                    </fieldset>
                    
                    <button class="btn btn-warning my-2 my-sm-0" type="submit" name="getOTP" id="getOTP">Get OTP</button>
                
                </form>
                
                <form method="post" id="signUpForm" class="needs-validation" novalidate>
                
                    <h2 class="center display-4 form-heading">Sign Up Form</h2>
                    
                    <fieldset class="form-group">
                        <input class="form-control" type="tel" pattern="[0-9]{6}" name="otpVal" id="otpVal" placeholder="OTP" required>
                    </fieldset>
                    
                    <fieldset class="form-group">
                        <input class="form-control" type="text" name="fname" id="fname" placeholder="Your First Name" required>
                    </fieldset>
                    
                    <fieldset class="form-group">
                        <input class="form-control" type="text" name="lname" id="lname" placeholder="Your Last Name" required>
                    </fieldset>

                    <fieldset class="form-group">
                        <input class="form-control" type="password" name="pword" id="pword" placeholder="Password" required>
                        <small class="form-text text-muted">
                             Relax! Your password gets encrypted as soon as you Signup. 
                          </small>
                    </fieldset>
                    
                    <fieldset class="form-group">
                        <input class="form-control" type="password" name="rePword" id="rePword" placeholder="Re-Enter Password" required>
                    </fieldset>
                    
                    
                    <button class="btn btn-warning my-2 my-sm-0" type="submit" name="signUp" id="signUpButton">Signup</button>
                
                </form>
                
            </div>
            
        </div>
<!--footer-->
<?php include("pages/footer.php");?>
     
     
     
      
<?php include("pages/bodyScript.php");?>
     
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
</script>

     
   
  </body>
</html>
