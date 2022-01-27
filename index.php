<?php
    
    session_start();
    $button = ""; $userButton = ""; $firstName = ""; $senderList = ""; $receiverList = ""; $errorNote = ""; $successNote = "";


    //gen
    $senderId = ""; $senderName = ""; $receiverId = ""; $receiverName = "";
    //s0
    $msn = ""; $fcm = ""; $hsh = ""; $cma = ""; $eid = ""; $bday = ""; $zs = "";
    //s1
    $sin = ""; $actor = ""; $actress = ""; $pol = ""; $outf = ""; $teacher = ""; $movie = ""; $pstm = ""; $song = ""; $iper = "";
    //s2
    $pet = ""; $ton = ""; $toff = ""; $li = ""; $crush = ""; $dreamdate = ""; $mil = ""; $surf = "";
    //s3
    $owd = ""; $talent = ""; $best = "";


    //gen
    $senderId = $_SESSION['senderId']; $senderName = $_SESSION['senderName']; $receiverId = $_SESSION['receiverId']; $receiverName = $_SESSION['receiverName'];
    //s0
    $msn = $_SESSION['msn']; $fcm = $_SESSION['fcm']; $hsh = $_SESSION['hsh']; $cma = $_SESSION['cma']; $eid = $_SESSION['eid']; $bday = $_SESSION['bday']; $zs = $_SESSION['zs'];
    //s1
    $sin = $_SESSION['sin']; $actor = $_SESSION['actor']; $actress = $_SESSION['actress']; $pol = $_SESSION['pol']; $outf = $_SESSION['outf']; $teacher = $_SESSION['teacher']; $movie = $_SESSION['movie']; $pstm = $_SESSION['pstm']; $song = $_SESSION['song']; $iper = $_SESSION['iper'];
    //s2
    $pet = $_SESSION['pet']; $ton = $_SESSION['ton']; $toff = $_SESSION['toff']; $li = $_SESSION['li']; $crush = $_SESSION['crush']; $dreamdate = $_SESSION['dreamdate']; $mil = $_SESSION['mil']; $surf = $_SESSION['surf'];
    //s3
    $owd = $_SESSION['owd']; $talent = $_SESSION['talent']; $best = $_SESSION['best'];

    
    if (array_key_exists("id", $_COOKIE)) {
        
        $_SESSION['id'] = $_COOKIE['id'];
        
    }

    if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        //GREENZONE
        
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
        
        $link = mysqli_connect("shareddb-q.hosting.stackcp.net", "_users-3131375a2a", "asdf7536951tyuiop1596357", "_users-3131375a2a");
        
        if(mysqli_connect_error()) {
            
            die ("database connection error.");
            
        } else {
            
            ?>
            <style type="text/css">
                    #gen{
                    display:block;
                    }
                    #s0{
                    display:none;
                    }
                    #s1{
                    display:none;
                    }
                    #s2{
                    display:none;
                    }
                    #s3{
                    display:none;
                    }
                    #s4{
                    display:none;
                    }
            </style>
            <?php
            
        
            $query = "SELECT `id`, `fname`, `lname` FROM `user_info` WHERE id = '".$_SESSION['id']."' ";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_array($result);
            
            //$firstName = ""; $senderName = ""; $receiverName = ""; $senderList = ""; $receiverList = "";


                if(isset($row)) {
                    $firstName = $row['fname'];
                    $_SESSION['senderName'] = $row['fname'].' '.$row['lname'];
                    
                    $senderList = '<option value='.$row['id'].'>'.$row['fname'].' '.$row['lname'].'</option>';
                    
                    $query = "SELECT `id`, `fname`, `lname` FROM `user_info`";
                    $result = mysqli_query($link, $query);
                    
                    while($row = mysqli_fetch_array($result)) {
                        if($row['id'] != $_SESSION['id']) {
                            
                            $receiverList .= '<option value='.$row['id'].'>'.$row['fname'].' '.$row['lname'].'</option>';
                            
                        }
                    }

                } else {
                    //echo "data-retrieving error." ;
                    $errorNote = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Opps!</strong> There is error in connection.</p></div>';
                }
            
            if(isset($_POST['gen'])) {
                
                $_SESSION['senderId'] = $_POST['senderInput'];
                $_SESSION['receiverId'] = $_POST['receiverInput'];
                
                $query = "SELECT `fname`, `lname` FROM `user_info` WHERE id = '".$_SESSION['receiverId']."'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_array($result);
                
                $_SESSION['receiverName'] = $row['fname'].' '.$row['lname'];
                
                $query = "SELECT `pgno` FROM `dairy_content` WHERE `sender_id` = '".$_SESSION['senderId']."' AND `receiver_id` = '".$_SESSION['receiverId']."'";
                $result = mysqli_query($link, $query);
                
                if(mysqli_num_rows($result) > 0) {
                    //echo "You have already sent slambook page to him/her. ";
                    
                    $errorNote = '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Hey!</strong> You have already sent a slambook page to him/her.</p></div>';
                    
                } else {
                
                        ?>
                        <style type="text/css">
                            #gen{
                            display:none;
                            }
                            #s0{
                            display:block;
                            }
                            #s1{
                            display:none;
                            }
                            #s2{
                            display:none;
                            }
                            #s3{
                            display:none;
                            }
                            #s4{
                            display:none;
                            }
                        </style>
                        <?php
                        
                    } 
                    
                }
            
                if(isset($_POST['s0'])) {
                    
                    $_SESSION['msn'] = $_POST['msn'];
                    $_SESSION['fcm'] = $_POST['fcm'];
                    $_SESSION['hsh'] = $_POST['hsh'];
                    $_SESSION['cma'] = $_POST['cma'];
                    $_SESSION['eid'] = $_POST['eid'];
                    $_SESSION['bday'] = $_POST['bday'];
                    
                        switch($_POST['zs']) {
                            case 2: $_SESSION['zs'] = "Taurus";
                                    break;
                            case 3: $_SESSION['zs'] = "Gemini";
                                    break;
                            case 4: $_SESSION['zs'] = "Cancer";
                                    break;
                            case 5: $_SESSION['zs'] = "Leo";
                                    break;
                            case 6: $_SESSION['zs'] = "Virgo";
                                    break;
                            case 7: $_SESSION['zs'] = "Libra";
                                    break;
                            case 8: $_SESSION['zs'] = "Scorpio";
                                    break;
                            case 9: $_SESSION['zs'] = "Sagittarius";
                                    break;
                            case 10: $_SESSION['zs'] = "Capricorn";
                                    break;
                            case 11: $_SESSION['zs'] = "Aquarius";
                                    break;
                            case 12: $_SESSION['zs'] = "Pisces";
                                    break;
                            case 1: $_SESSION['zs'] = "Aries";
                                    break;
                        }
                    
                        ?>
                        <style type="text/css">
                            #gen{
                            display:none;
                            }
                            #s0{
                            display:none;
                            }
                            #s1{
                            display:block;
                            }
                            #s2{
                            display:none;
                            }
                            #s3{
                            display:none;
                            }
                            #s4{
                            display:none;
                            }
                        </style>
                        <?php
                    
                }
            
                if(isset($_POST['s1'])) {
                    
                    $_SESSION['sin'] = $_POST['sin'];
                    $_SESSION['actor'] = $_POST['actor'];
                    $_SESSION['actress'] = $_POST['actress'];
                    $_SESSION['pol'] = $_POST['pol'];
                    $_SESSION['outf'] = $_POST['outf'];
                    $_SESSION['teacher'] = $_POST['teacher'];
                    $_SESSION['movie'] = $_POST['movie'];
                    $_SESSION['pstm'] = $_POST['pstm'];
                    $_SESSION['song'] = $_POST['song'];
                    $_SESSION['iper'] = $_POST['iper'];
                    
                        ?>
                        <style type="text/css">
                            #gen{
                            display:none;
                            }
                            #s0{
                            display:none;
                            }
                            #s1{
                            display:none;
                            }
                            #s2{
                            display:block;
                            }
                            #s3{
                            display:none;
                            }
                            #s4{
                            display:none;
                            }
                        </style>
                        <?php
                    
                }
            
                if(isset($_POST['s2'])) {
                    
                    $_SESSION['pet'] = $_POST['pet'];
                    $_SESSION['ton'] = $_POST['ton'];
                    $_SESSION['toff'] = $_POST['toff'];
                    $_SESSION['li'] = $_POST['li'];
                    $_SESSION['dreamdate'] = $_POST['dreamdate'];
                    $_SESSION['mil'] = $_POST['mil'];
                    $_SESSION['surf'] = $_POST['surf'];
                    
                        switch($_POST['crush']) {
                            case 1: $_SESSION['crush'] = "YES";
                                    break;
                            case 2: $_SESSION['crush'] = "NO";
                                    break;
                        }
                    
                        ?>
                        <style type="text/css">
                            #gen{
                            display:none;
                            }
                            #s0{
                            display:none;
                            }
                            #s1{
                            display:none;
                            }
                            #s2{
                            display:none;
                            }
                            #s3{
                            display:block;
                            }
                            #s4{
                            display:none;
                            }
                        </style>
                        <?php
                    
                }
            
                if(isset($_POST['s3'])) {
                    
                    $owd = $_SESSION['owd'] = $_POST['owd'];
                    $talent = $_SESSION['talent'] = $_POST['talent'];
                    $best = $_SESSION['best'] = $_POST['best'];
                    
                        ?>
                        <style type="text/css">
                            #gen{
                            display:none;
                            }
                            #s0{
                            display:none;
                            }
                            #s1{
                            display:none;
                            }
                            #s2{
                            display:none;
                            }
                            #s3{
                            display:none;
                            }
                            #s4{
                            display:block;
                            }
                        </style>
                        <?php
                    
                }
            
                if(isset($_POST['s4'])) {
                    
                    $query = "INSERT INTO `dairy_content`(
                                
                                `sender_id`,
                                `sender`,
                                `receiver_id`,
                                `receiver`,
                                `msn`,
                                `fcm`,
                                `hsh`,
                                `cma`,
                                `eid`,
                                `bday`,
                                `zs`,
                                `sin`,
                                `actor`,
                                `actress`,
                                `pol`,
                                `outf`,
                                `teacher`,
                                `movie`,
                                `pstm`,
                                `song`,
                                `iper`,
                                `pet`,
                                `ton`,
                                `toff`,
                                `li`,
                                `crush`,
                                `dreamdate`,
                                `mil`,
                                `surf`,
                                `owd`,
                                `talent`,
                                `best`                         
                            ) VALUES (
                            
                                '".$senderId."',
                                '".$senderName."',
                                '".$receiverId."',
                                '".$receiverName."',
                                '".$msn."',
                                '".$fcm."',
                                '".$hsh."',
                                '".$cma."',
                                '".$eid."',
                                '".$bday."',
                                '".$zs."',
                                '".$sin."',
                                '".$actor."',
                                '".$actress."',
                                '".$pol."',
                                '".$outf."',
                                '".$teacher."',
                                '".$movie."',
                                '".$pstm."',
                                '".$song."',
                                '".$iper."',
                                '".$pet."',
                                '".$ton."',
                                '".$toff."',
                                '".$li."',
                                '".$crush."',
                                '".$dreamdate."',
                                '".$mil."',
                                '".$surf."',
                                '".$owd."',
                                '".$talent."',
                                '".$best."'
                            
                            )";
                    mysqli_query($link, $query);
                    
                    //gen
                    $senderId = ""; unset($_SESSION['senderId']); $senderName = ""; unset($_SESSION['senderName']); $receiverId = ""; unset($_SESSION['receiverId']); $receiverName = ""; unset($_SESSION['receiverName']);
                    //s0
                    $msn = ""; unset($_SESSION['msn']); $fcm = ""; unset($_SESSION['fcm']); $hsh = ""; unset($_SESSION['hsh']); $cma = ""; unset($_SESSION['cma']); $eid = ""; unset($_SESSION['eid']); $bday = ""; unset($_SESSION['bday']); $zs = ""; unset($_SESSION['zs']);
                    //s1
                    $sin = ""; unset($_SESSION['sin']); $actor = ""; unset($_SESSION['actor']); $actress = ""; unset($_SESSION['actress']); $pol = ""; unset($_SESSION['pol']); $outf = ""; unset($_SESSION['outf']); $teacher = ""; unset($_SESSION['teacher']); $movie = ""; unset($_SESSION['movie']); $pstm = ""; unset($_SESSION['pstm']); $song = ""; unset($_SESSION['song']); $iper = ""; unset($_SESSION['iper']);
                    //s2
                    $pet = ""; unset($_SESSION['pet']); $ton = ""; unset($_SESSION['ton']); $toff = ""; unset($_SESSION['toff']); $li = ""; unset($_SESSION['li']); $crush = ""; unset($_SESSION['crush']); $dreamdate = ""; unset($_SESSION['dreamdate']); $mil = ""; unset($_SESSION['mil']); $surf = ""; unset($_SESSION['surf']);
                    //s3
                    $owd = ""; unset($_SESSION['owd']); $talent = ""; unset($_SESSION['talent']); $best = ""; unset($_SESSION['best']);
                    
                    
                    $successNote = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button><p><strong>Hurrah!</strong> Page sent successfully.</p>Do you want to know who made this Product ? <a href="about.php" class="badge badge-success">Founder</a></p></div>';    
                    
                }
            
                
            }   
            
            
        
        
        
        
    } else {
        //REDZONE
        header("Location: login.php");
    }
    
?>


<!doctype html>
<html lang="en">
  <head>
    <? include("pages/btwHeadTitle.php");?>
    <title>Slam Book</title>
      
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
        .pg-container {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }     
        
        
        @media (max-width: 576px) { 
        
        
        
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
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item">
                    <a type="button" class="nav-link" tabindex="-1" aria-disabled="true" data-toggle="popover" title="Feature Disabled" data-content="This feature is disabled by the Founder.Coming Soon..." data-placement="bottom">Create</a>
                </li>
                
                <?php echo $userButton;?>
              
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
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
            <h1 class="display-4"><div><?php echo "Hi ".$firstName." !"; ?></div></h1>
            <p class="lead">Now you're able to use Slambook and don't forget to leave a feedback in About Us section.</p>
            <hr class="my-4">  
          </div>
        </div>
        
  
<!--container-->
      
        <div class="container pg-container shadow-lg p-3 mb-5">
        
                <div id="slamErrorBox"><?php echo $errorNote.$successNote;?></div>
                
<!--gen-->
                <div id="gen">
                    <h1 class="display-5">SELECTION</h1>
                    <p class="text-muted font-italic"><strong>NOTE: </strong></p>
                    <ul class="text-muted">
                        <li>If you don't find Name of that Person in Receiver List whom you want to send Slambook page, then tell him/her to sign up.</li>
                        <li>If you find somthing is missing/needs to change/add more fields/some error occured or any type of problem or feedback then let me know in Contact Us! section under About Us tab.</li>
                    </ul>
                    <form method="post" id="senderReceiver" class="needs-validation" novalidate>
                        <fieldset class="form-group">
                        
                          <label for="senderInput">Sender</label>
                          <select id="senderInput" name="senderInput" class="form-control" required>
                            <div><?php echo $senderList;?></div>
                          </select>
                          
                        </fieldset>
                        
                        <fieldset class="form-group">
                          <label for="receiverInput">Receiver</label>
                          <select id="receiverInput" name="receiverInput" class="form-control" required>
                            <div>
                                <option selected disabled value="">Choose Receiver ...</option>
                                <?php echo $receiverList;?>
                            </div>
                          </select>
                          <div class="invalid-feedback">Select Receiver</div>
                          <div class="valid-feedback">Looks Good!</div>
                        </fieldset>
                        
                        <button class="btn btn-secondary my-2 my-sm-0" type="submit" name="gen">Next</button>
                      
                    </form>
                    
                </div>
                
<!--s0-->
                <div id="s0">
                    <h1 class="display-5">GENERAL</h1>
                    <form class="needs-validation" method="post" novalidate>
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="msn">My Sweet Name</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Sweet Name of person who is sending."></i>
                          <input type="text" class="form-control" id="msn" name="msn" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="fcm">Friends call me</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="What you friends call you."></i>
                          <input type="text" class="form-control" id="fcm" name="fcm" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="hsh">Home Sweet Home</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Where your Sweet Home situated, not full address."></i>
                          <input type="text" class="form-control" id="hsh" name="hsh" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="cma">Call me at</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Your mobile number, if you want to give this receiver."></i>
                          <input type="tel" pattern="[0-9]{10}" class="form-control" id="cma" name="cma">
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="eid">Email ID</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Your Email ID, if you want to give this receiver."></i>
                          <input type="email" class="form-control" id="eid" name="eid">
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="bday">Birth Date</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="When is your birthday."></i>
                          <input type="date" class="form-control" id="bday" name="bday" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="zs">Zodiac Sign</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="What is your Zodiac Sign, if you want to give this receiver."></i>
                          <select class="custom-select" id="zs" name="zs">
                            <option selected disabled value="">Choose...</option>
                            <option value="1">Aries</option>
                            <option value="2">Taurus</option>
                            <option value="3">Gemini</option>
                            <option value="4">Cancer</option>
                            <option value="5">Leo</option>
                            <option value="6">Virgo</option>
                            <option value="7">Libra</option>
                            <option value="8">Scorpio</option>
                            <option value="9">Sagittarius</option>
                            <option value="10">Capricorn</option>
                            <option value="11">Aquarius</option>
                            <option value="12">Pisces</option>
                            
                          </select>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      
                      
                      <button class="btn btn-secondary" type="submit" name="s0">Next</button>
                    </form>
                
                    
                </div>
                
                
<!--s1-->
                <div id="s1">
                    <h1 class="display-5">FAVOURITES</h1>
                    <form class="needs-validation" method="post" novalidate>
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="sin">Singer(s)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Who's your favourite Singer. It can be more than one and Male or Female."></i>
                          <input type="text" class="form-control" id="sin" name="sin" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="actor">Actor(s)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Who's your favourite Actor. It can be more than one."></i>
                          <input type="text" class="form-control" id="actor" name="actor" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="actress">Actress(es)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Who's your favourite Actress. It can be more than one."></i>
                          <input type="text" class="form-control" id="actress" name="actress" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="pol">Politician(s)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Who's your favourite Politician. It can be more than one."></i>
                          <input type="text" class="form-control" id="pol" name="pol" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="outf">Outfit(s)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Which dress you prefer more to wear. It can be more than one."></i>
                          <input type="text" class="form-control" id="outf" name="outf" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="teacher">Teacher(s)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Who's your favourite Teacher. It can be more than one and Male or Female."></i>
                          <input type="text" class="form-control" id="teacher" name="teacher" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="movie">Movie(s)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Which is your favourite Movie. It can be more than one."></i>
                          <input type="text" class="form-control" id="movie" name="movie" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="pstm">Passtime</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="What do you do when you have free time."></i>
                          <input type="text" class="form-control" id="pstm" name="pstm" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="song">Song(s)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Which song your favourite song. It can be more than one."></i>
                          <input type="text" class="form-control" id="song" name="song" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="iper">Ideal Person(s)</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Who's your Ideal Person. It can be more than one."></i>
                          <input type="text" class="form-control" id="iper" name="iper" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      
                      
                      
                      
                      <button class="btn btn-secondary" type="submit" name="s1">Next</button>
                    </form>
                    
                </div>
                
                
<!--s2-->  
                <div id="s2">
                   <h1 class="display-5">MY CHOICE...WHY?</h1>
                    <form class="needs-validation" method="post" novalidate>
                    
                    <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="pet">I would love to have pet</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Which animal do you prefer to have."></i>
                          <input type="text" class="form-control" id="pet" name="pet" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="ton">Thing which turn me 'ON'</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Which things make you Energetic."></i>
                          <input type="text" class="form-control" id="ton" name="ton" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="toff">Thing which turn me 'OFF'</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Which things make you dull."></i>
                          <input type="text" class="form-control" id="toff" name="toff" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="li">Love is ____?</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Your thoughts about Love. Ex- waste of time, should do in limit, etc."></i>
                          <input type="text" class="form-control" id="li" name="li" required>
                          <small class="form-text text-muted">
                             Your thoughts about Love. Ex- waste of time, should do in limit, dangerous drug, etc. 
                          </small>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                      </div>
                      
                      <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="crush">Any Crush</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Do you have any crush YES/NO, will not ask name of your Crush."></i>
                          <select class="custom-select" id="crush" name="crush" required>
                            <option selected disabled value="">YES/NO</option>
                            <option value="1">YES</option>
                            <option value="2">NO</option>
                            
                          </select>
                          <small class="form-text text-muted">
                            Either YES/NO, not asking name of your Crush. 
                          </small>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="dreamdate">My dream Date would be with</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Person whom you wish to Date."></i>
                          <input type="text" class="form-control" id="dreamdate" name="dreamdate">
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="mil">Mission in Life</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Your aim in life."></i>
                          <input type="text" class="form-control" id="mil" name="mil" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                    </div>
                    
                    <div class="form-row">
                       
                        <div class="col-md-6 mb-3">
                          <label for="surf">Site/App I love to surf</label>
                          <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                            data-content="Site/App which you like to surf. Ex- Instagram, Google, Flipkart, etc."></i>
                          <input type="text" class="form-control" id="surf" name="surf" required>
                          <div class="valid-feedback">
                            Looks good!
                          </div>
                        </div>
                        
                    </div>
                    
                    
                        <button class="btn btn-secondary" type="submit" name="s2">Next</button>
                    </form>
                    
                </div>
                
                 
<!--s3--> 
                <div id="s3">
                    <h1 class="display-5">MY OPINION ABOUT YOU</h1>
                    <form class="needs-validation" method="post" novalidate>
                    
                        <div class="form-row">
                       
                            <div class="col-md-6 mb-3">
                              <label for="owd">One word that describes you</label>
                              <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                                data-content="One word that describes him/her."></i>
                              <input type="text" class="form-control" id="owd" name="owd" required>
                              <div class="valid-feedback">
                                Looks good!
                              </div>
                            </div>

                        </div>
                        
                        <div class="form-row">
                       
                            <div class="col-md-6 mb-3">
                              <label for="talent">Talent that I observe in you</label>
                              <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                                data-content="Talent that you noticed in him/her."></i>
                              <input type="text" class="form-control" id="talent" name="talent" required>
                              <div class="valid-feedback">
                                Looks good!
                              </div>
                            </div>

                        </div>
                        
                        <div class="form-row">
                       
                            <div class="col-md-6 mb-3">
                              <label for="best">The best thing I like about you</label>
                              <i class="fas fa-info-circle" data-container="body" data-toggle="popover" data-placement="bottom" 
                                data-content="The best thing that you like about him/her."></i>
                              <input type="text" class="form-control" id="best" name="best" required>
                              <div class="valid-feedback">
                                Looks good!
                              </div>
                            </div>

                        </div>
                    
                    
                    
                        <button class="btn btn-secondary" type="submit" name="s3">Next</button>
                    </form>
                    
                </div>
                
                
<!--s4-->  
                <div id="s4">
                    
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">From: <?php echo $senderName;?></th>
                          <th scope="col">To: <?php echo $receiverName;?></th>
                        </tr>
                      </thead>
                      <tbody>
                       
                        <tr class="table-warning">
                          <th scope="row" colspan="2">GENERAL</th>
                        </tr>
                        <tr>
                          <th scope="row">My sweet Name</th>
                          <td><?php echo $msn;?></td>
                        </tr>
                        <tr>
                          <th scope="row">Friends call me</th>
                          <td><?php echo $fcm;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Home sweet Home</th>
                            <td><?php echo $hsh;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Call me at</th>
                            <td><?php echo $cma;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Email ID</th>
                            <td><?php echo $eid;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Birthday</th>
                            <td><?php echo $bday;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Zodiac sign</th>
                            <td><?php echo $zs;?></td>
                        </tr>
                        
                        <tr class="table-warning">
                            <th scope="row" colspan="2">FAVOURITES</th>
                        </tr>
                        <tr>
                            <th scope="row">Singer(s)</th>
                            <td><?php echo $sin;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Actor(s)</th>
                            <td><?php echo $actor;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Actress(s)</th>
                            <td><?php echo $actress;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Politician(s)</th>
                            <td><?php echo $pol;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Outfit(s)</th>
                            <td><?php echo $outf;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Teacher(s)</th>
                            <td><?php echo $teacher;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Movie(s)</th>
                            <td><?php echo $movie;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Passtime</th>
                            <td><?php echo $pstm;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Song(s)</th>
                            <td><?php echo $song;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Ideal Person(s)</th>
                            <td><?php echo $iper;?></td>
                        </tr>
                        
                        <tr class="table-warning">
                            <th scope="row" colspan="2">MY CHOICE...WHY?</th>
                        </tr>
                        <tr>
                            <th scope="row">I would love to have pet</th>
                            <td><?php echo $pet;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Things which turn me 'ON'</th>
                            <td><?php echo $ton;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Things which turn me 'OFF'</th>
                            <td><?php echo $toff;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Love is ____?</th>
                            <td><?php echo $li;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Any Crush</th>
                            <td><?php echo $crush;?></td>
                        </tr>
                        <tr>
                            <th scope="row">My dream Date would be with</th>
                            <td><?php echo $dreamdate;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Mission in life</th>
                            <td><?php echo $mil;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Site/App I love to surf</th>
                            <td><?php echo $surf;?></td>
                        </tr>
                        
                        <tr class="table-warning">
                            <th scope="row" colspan="2">MY OPINION ABOUT YOU</th>
                        </tr>
                        <tr>
                            <th scope="row">One word that describes you</th>
                            <td><?php echo $owd;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Talent that I observed in you</th>
                            <td><?php echo $talent;?></td>
                        </tr>
                        <tr>
                            <th scope="row">The best thing I like about you</th>
                            <td><?php echo $best;?></td>
                        </tr>
                         
                      </tbody>
                    </table>
                    
                    <form method="post">
                        <button class="btn btn-secondary" type="submit" name="s4">Submit</button>
                    </form>
                    
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
