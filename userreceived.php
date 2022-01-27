<?php

    session_start();
    
    $button = ""; $userButton = ""; $tableContent = ""; $printButton = ""; $tableSorry = "";

    if(array_key_exists("id", $_COOKIE)) {
        $_SESSION['id'] = $_COOKIE['id'];
    }

    if(array_key_exists("id", $_SESSION)) {
        //GREENZONE
        
        
        //login.php?logout=1
        $button = '<a class="btn btn-outline-info my-2 my-sm-0" href="login.php?logout=1" role="button">Logout</a>';
        $userButton = '<li class=" nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-user-circle"></i>  User
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                              <a class="dropdown-item" href="usersent.php">Sent</a>
                              <a class="dropdown-item" href="#">Received</a>
                              
                            </div>
                        </li>
                  ';
        $link = mysqli_connect("shareddb-q.hosting.stackcp.net", "_users-3131375a2a", "asdf7536951tyuiop1596357", "_users-3131375a2a");
        
        if(mysqli_connect_error()) {
            die("There is connection in database.");
        } else {
            
            $query = "SELECT `pgno` FROM `dairy_content` WHERE `receiver_id` = '".$_SESSION['id']."' LIMIT 1";
            $result = mysqli_query($link, $query);
            
            if(mysqli_num_rows($result) > 0) {
                
                $query = "SELECT * FROM `dairy_content` WHERE `receiver_id` = '".$_SESSION['id']."'";
                $result = mysqli_query($link, $query);
                
                while($row = mysqli_fetch_array($result)) {                   
                    
                    $tableContent .= '<br>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class="table-cap table-danger" scope="col">From: '.$row['sender'].'</th>
                          <th class="table-cap table-danger" scope="col">To: '.$row['receiver'].'</th>
                        </tr>
                      </thead>
                      <tbody>
                       
                        <tr class="table-warning center">
                          <th class="sec-head" scope="row" colspan="2">GENERAL</th>
                        </tr>
                        <tr>
                          <th scope="row">My sweet Name</th>
                          <td>'.$row['msn'].'</td>
                        </tr>
                        <tr>
                          <th scope="row">Friends call me</th>
                          <td>'.$row['fcm'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Home sweet Home</th>
                            <td>'.$row['hsh'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Call me at</th>
                            <td>'.$row['cma'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Email ID</th>
                            <td>'.$row['eid'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Birthday</th>
                            <td>'.$row['bday'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Zodiac sign</th>
                            <td>'.$row['zs'].'</td>
                        </tr>
                        
                        <tr class="table-warning center">
                            <th class="sec-head" scope="row" colspan="2">FAVOURITES</th>
                        </tr>
                        <tr>
                            <th scope="row">Singer(s)</th>
                            <td>'.$row['sin'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Actor(s)</th>
                            <td>'.$row['actor'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Actress(s)</th>
                            <td>'.$row['actress'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Politician(s)</th>
                            <td>'.$row['pol'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Outfit(s)</th>
                            <td>'.$row['outf'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Teacher(s)</th>
                            <td>'.$row['teacher'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Movie(s)</th>
                            <td>'.$row['movie'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Passtime</th>
                            <td>'.$row['pstm'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Song(s)</th>
                            <td>'.$row['song'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Ideal Person(s)</th>
                            <td>'.$row['iper'].'</td>
                        </tr>
                        
                        <tr class="table-warning center">
                            <th class="sec-head" scope="row" colspan="2">MY CHOICE...WHY?</th>
                        </tr>
                        <tr>
                            <th scope="row">I would love to have pet</th>
                            <td>'.$row['pet'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Things which turn me \'ON\'</th>
                            <td>'.$row['ton'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Things which turn me \'OFF\'</th>
                            <td>'.$row['toff'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Love is ____?</th>
                            <td>'.$row['li'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Any Crush</th>
                            <td>'.$row['crush'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">My dream Date would be with</th>
                            <td>'.$row['dreamdate'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Mission in life</th>
                            <td>'.$row['mil'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Site/App I love to surf</th>
                            <td>'.$row['surf'].'</td>
                        </tr>
                        
                        <tr class="table-warning center">
                            <th class="sec-head" scope="row" colspan="2">MY OPINION ABOUT YOU</th>
                        </tr>
                        <tr>
                            <th scope="row">One word that describes you</th>
                            <td>'.$row['owd'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">Talent that I observed in you</th>
                            <td>'.$row['talent'].'</td>
                        </tr>
                        <tr>
                            <th scope="row">The best thing I like about you</th>
                            <td>'.$row['best'].'</td>
                        </tr>
                         
                      </tbody>
                    </table> <br><hr class="bg-secondary rounded-lg" size="10px" color="#000000">';
                        
                }
                $printButton = '<input type="button" class="btn btn-secondary" value="Download" onclick="createPDF()">';
                
            } else {
                //tableSorry
                
                $tableSorry = '<div style="height: 500px;"><p class="lead">Sorry you haven\'t received any slambook page from any one.</p></div>';    
            }
            
            
        }
        
        
        
    } else {
        //REDZONE
        header("Location: login.php");
    }


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <? include("pages/btwHeadTitle.php");?>
    <title>Slambook - Received</title>
    
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
            border-radius: 10px;
                
        }
        .table-container {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            padding: 10px;
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
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
              
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <?php echo $button; ?> 
            </form>
            
          </div>
        </nav>
      
      
<!--jumbotron-->

    
        
  
<!--container-->
      
        <div class="container shadow-lg p-3 mb-5">
           
            <div class="table-container" id="sentTable">       
                <?php echo $tableContent.$printButton.$tableSorry;?>
            </div>
                       
        </div>
        
<!--footer-->
<?php include("pages/footer.php");?>
      
      
      
      
<!--scripts-->
<? include("pages/bodyScript.php");?>
   
    <script>
        function createPDF() {
            var sTable = document.getElementById('sentTable').innerHTML;

            var style = "<style>";
            style = style + "table {width: 100%;font: 17px Calibri;}";
            style = style + "table, th, td{border: solid 1px #DDD; border-collapse: collapse; padding: 2px 3px;}";
            style = style + "td {text-aligned: center;}";
            style = style + ".table-cap {background-color: #ffb0b0; font-weight: bold;}";
            style = style + ".sec-head {background-color: #ffe59e; font-weight: bold; text-aligned: center;}";
            style = style + "</style>";

            // CREATE A WINDOW OBJECT.
            var win = window.open('', '', 'height=700,width=900');

            win.document.write('<html><head>');
            win.document.write('<title>Profile</title>');   // <title> FOR PDF HEADER.
            win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
            win.document.write('</head>');
            win.document.write('<body>');
            win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
            win.document.write('</body></html>');

            win.document.close(); 	// CLOSE THE CURRENT WINDOW.

            win.print();    // PRINT THE CONTENTS.
        }
    </script>
    
    
    
</body>
</html>