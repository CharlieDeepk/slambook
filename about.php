<?php

    session_start();
    $button = ""; $userButton = ""; $errorMessage = ""; $successMessage = "";
    
    if (array_key_exists("id", $_COOKIE)) {
        
        $_SESSION['id'] = $_COOKIE['id'];
        
    }

    if (array_key_exists("id", $_SESSION)) {
        //login.php?logout=1
        $button = '<a class="btn btn-outline-info my-2 my-sm-0" href="login.php?logout=1" role="button">Logout</a>';
        $userButton = '<li class=" nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-user-circle"></i>  User
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                              <a class="dropdown-item" href="usersent.php">Sent</a>
                              <a class="dropdown-item" href="userreceived.php">Received</a>
                            
                            </div>
                        </li>
                  ';
        
    } else {
        
        $button = '<a class="btn btn-outline-warning my-2 my-sm-0" href="signup.php" role="button">Signup</a>" "<a class="btn btn-outline-info my-2 my-sm-0" href="login.php" role="button">Login</a>';
    }

    if ($_POST) {
        
        if( !$_POST['email']) {
            $errorMessage .= "Email field was incomplete.<br>";
        }
        
        if ($_POST['email'] && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
            
            $error .= "The email address is invalid.<br>";
            
        }
        
        if ( !$_POST['sub']) {
            $errorMessage .= "Subject field was incomplete.<br>";
        }
        
        if(!$_POST['content']) {
            $errorMessage .="Content field was incomplete.";
        }
        
        
        
        if($errorMessage != "") {
            $errorMessage = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p><strong>There were error(s) in your form:</strong></p>'.$errorMessage.'</div>';
        } else {
            
            $emailTo = "fellow.hackers@gmail.com";
            
            $subject = $_POST['sub'];
            
            $content = $_POST['content'];
            
            //$headers = "From : ".$_POST['email'];
            
            
            if (mail($emailTo, $subject, $content)) {
                $successMessage = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Done!</strong> Your email sent successfully.</p></div>';
            } else {
                $errorMessage = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Aanhh!</strong> Something went wrong.</p></div>';
            }
                
        }
        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <? include("pages/btwHeadTitle.php");?>
    <title>Slambook - About Us</title>
    
<style type="text/css">

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
    
        .container {
            margin-top: 50px;
                
        }
        .accordion {
            border-radius: 20px;
        }
        .card {
            background: rgba(255, 255, 255, 0.8);
        }
        .col-md-4 {
            text-align: center;
        }
        #founder-photo {
            height: 200px;
            width: 200px;
            border-radius: 50%;
            border: 3px solid #484848;
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
                
                <?php echo $userButton;?>
              
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
              
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <?php echo $button; ?> 
            </form>
            
          </div>
        </nav>
      
      
<!--jumbotron-->

        <div class="jumbotron jumbotron-fluid bg-transparent center">
          <div class="container">
            <h1 class="display-4">About Us</h1>
            <p class="lead">You can use Slambook who requests you and don't forget to leave a feedback in Contact Us section.</p>
            <hr class="my-4">  
          </div>
        </div>    
        
  
<!--container-->
      
        <div class="container">

<!--accordion-->
            <div><?php echo $successMessage;?></div>       
           <div class="accordion shadow-lg p-3 mb-5" role="group" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn text-dark btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Product
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body mb-3">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <img src="images/slam-book-logo.png" class="card-img" alt="Product Logo">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Slambook</h5>
                            <p class="card-text">This product is meant for school memories(as its name says) which you have made during your school times. Classmates who whether was with you or not at your good or bad times, share your opinions, beliefs, feedback to one whom you want to send and remember in future.</p>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn text-dark btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" name="accordionButton">
                      Founder
                    </button>
                  </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body mb-3">
                      <div class="row no-gutters">
                        <div class="col-md-4">
                          <img id="founder-photo" src="images/founder-photo.jpg" class="card-img" alt="Founder's Photo">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <h5 class="card-title">Kumar Deepak</h5>
                            <p class="card-text">Hey there! I'm Deepak my friends call me Chalie.</p>
                            <p class="card-text">I got bored in this Lockdown period so, I created this Product for my classmates in order to collect memories spent with them as I haven't ended my school life properly unfortunately.</p>
                            <p class="card-text">Hope you like.</p>
                              <h1>
                                    <a class="btn btn-outline-dark" href="https://www.facebook.com/charliedeepk" target="_blank" role="button"><i class="fab fa-facebook-f"></i></a>
                                    
                                    <a class="btn btn-outline-dark" href="https://www.instagram.com/charliedeepk" target="_blank" role="button"><i class="fab fa-instagram"></i></a>
                                    
                                    <a class="btn btn-outline-dark" href="https://twitter.com/CharlieDeepk" target="_blank" role="button"><i class="fab fa-twitter"></i></a>
                              </h1>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn text-dark btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Contact Us!
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">   
                            <div id="errorBox"><? echo $errorMessage; ?></div>

                            <form method="post" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="email">Email ID</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Your E-mail Address" required>
                                </div>

                                <div class="form-group">
                                    <label for="sub">Subject</label>
                                    <input type="text" class="form-control" id="sub" name="sub" required>
                                </div>

                                <div class="form-group">
                                    <label for="content">Composes</label>
                                    <p class="text-muted font-italic"><strong>NOTE: </strong>Don't forget to mention your email at last in order to get reply.</p>
                                    <textarea class="form-control" id="content" name="content" rows="3" placeholder="Your beautiful message here!" required></textarea>
                                    
                                </div>

                                <button class="btn btn-secondary" id="submit">Send</button>
                            </form>
                  </div>
                </div>
              </div>
            </div>
            
            
            
        </div>
        
<!--footer-->
<?php include("pages/footer.php");?>
      
      
      
      

    <? include("pages/bodyScript.php");?>
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