<?php
    
    session_start();

    $errorMessage = ""; $successMessage = "";

    if (isset($_GET['logout'])) {
        
        unset($_SESSION['id']);
        setcookie("id", "", time() - 60*60);
        $_COOKIE['id'] = "";
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: index.php");
        
    }

    if (array_key_exists("submit", $_POST)) {
        
        
        if (!$_POST['email']) {
            $errorMessage .= "Your Email Id is required.<br>";
        }
        if (!$_POST['pword']) {
            $errorMessage .= "Password field is required.<br>";
        }
        
        if ($errorMessage != "") {
            
            $errorMessage = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p><strong>There were error(s) in your form:</strong></p>'.$errorMessage.'</div>';
        
        } else {
            
            $link = mysqli_connect("shareddb-q.hosting.stackcp.net", "_users-3131375a2a", "asdf7536951tyuiop1596357", "_users-3131375a2a");
            
            if (mysqli_connect_error()) {
                
                die("There is error in connection to database.");
            
            } else {
                
                $email = strtolower($_POST['email']);
                $password = $_POST['pword'];
                
                
                $query = "SELECT * FROM `user_info` WHERE email = '".mysqli_real_escape_string($link, $email)."'";
                
                $result = mysqli_query($link, $query);
                
                $record = mysqli_fetch_array($result);
                
                if (strcasecmp($email, $record['email']) == 0) {
                    
                    if (password_verify($password, $record['password'])) {
                        
                        //$successMessage = "Logged In successfully...";
                        
                        $_SESSION['id'] = $record['id'];
                        
                        if ($_POST['stayLoggedIn'] == '1') {
                            
                            setcookie("id", $record['id'], time() + 60*60*1);
                        }
                        
                        header("Location: index.php");
                        
                    } else {
                        //echo "password me problem hai";
                        $errorMessage = "Your Email/Password combination is wrong";
                        $errorMessage = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p><strong>There were error(s) in your form:</strong></p>'.$errorMessage.'</div>';
                    }
                    
                } else {
                    //echo "email me problem hai";
                    $errorMessage = "Your Email/Password combination is wrong";
                    $errorMessage = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p><strong>There were error(s) in your form:</strong></p>'.$errorMessage.'</div>';
                    
                }
            }
    
        }
    }

                             
?>


<!doctype html>
<html lang="en">
  <head>
    <?php include("pages/btwHeadTitle.php");?>
    <title>Slam Book - Login</title>
      
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
            <form class="form-inline my-2 my-lg-0" action="signup.php">
                <!--
                <input class="form-control mr-sm-2" type="email" placeholder="Email ID">
                <input class="form-control mr-sm-2" type="password" placeholder="Password">
                -->
                <button class="btn btn-outline-warning my-2 my-sm-0" type="submit">Signup</button>
                <!--<button class="btn btn-outline-info my-2 my-sm-0" type="submit">LogIn</button>-->
            </form>
          </div>
        </nav>
      
      
<!--jumbotron-->

        <div class="jumbotron jumbotron-fluid bg-transparent center">
          <div class="container">
            <h1 class="display-4">Log In NOW!</h1>
            <p class="lead">Start filling slambook pages of your classmates, who knows when you gonna meet them.</p>
            <hr class="my-4">
            <!--<a class="btn btn-info btn-lg" href="#" role="button">SignUp</a>-->  
          </div>
        </div>
        
  
<!--container-->
      
        <div class="container">
            
            <div id="form-container" class="shadow-lg p-3 mb-5 container">
                <div id="errorBox"><?php echo $errorMessage.$successMessage; ?></div>
                
                <form method="post" id="logInForm" class="needs-validation" novalidate>
                
                    <h2 class="center display-4 form-heading">Log In Form</h2>
                    
                    <fieldset class="form-group">
                        <input class="form-control" type="email" name="email" id="email" placeholder="Your Email ID" required>
                    </fieldset>
                    
                    <fieldset class="form-group">
                        <input class="form-control" type="password" name="pword" id="pword" placeholder="Your Password" required>
                    </fieldset>
                    
                    <div class="custom-control custom-checkbox my-1 mr-sm-2">
                        <input type="checkbox" class="custom-control-input" id="stayLoggedIn" name="stayLoggedIn" value=1>
                        <label class="custom-control-label" for="stayLoggedIn">Stay Logged In</label>
                    </div>
                    
                    <button class="btn btn-info my-2 my-sm-0" type="submit" name="submit" id="loginButton">Login</button>
                
                </form>
                
            </div>
            
        </div>
        
<!--footer-->
<?php include("pages/footer.php")?>     
      
      
      

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
