<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WAIPP</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script type="text/javascript" src="events.js"></script>
    <style type="text/css">
        #logout {
            color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;
        }
    </style>
</head>
<body>
    
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">WAIPP</a> 
            </div>
            <div id="logout"><a href="login.html" class="btn btn-danger square-btn-adjust">Logout</a></div>
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				    <li class="text-center">
                        <img src="pictures/WP_Logo_V1.svg" class="user-image img-responsive"/>
					</li>
                    <li><a href="index.php"><i class="fa fa-dashboard fa-3x"></i>Dashboard</a></li>  	
                    <li><a class="active-menu" href="index.php?seite=events"><i class="fa fa-table fa-3x"></i>Events</a></li>
				    <li><a href="index.php?seite=profil" href="profil.html"><i class="fa fa-user fa-3x"></i>Mein Profil</a></li>
                    
                </ul>
            </div>
        </nav>
        
        <div id="page-wrapper">
            <div id="page-inner">
                <?php
                    require('includes/adodb/adodb.inc.php'); //integrates the adodb.inc.php file to the webpage
                    $DB = NewADOConnection('mysql'); 
                    $DB->Connect('localhost','root','','usrdb_flhmnoco5'); 	

                    $ID = $_GET['id'];
                    $events = $DB->Execute("SELECT * FROM events where pk_event_id=$ID");
                    $bestellungen = $DB->Execute("SELECT * FROM orders where fk_event_id=$ID");
                
                    $exp="";
                
                    if(isset($_POST['exp']))
                        $exp = $_POST['exp'];

                    if($exp=='edit') {
                        echo '<div class="alert alert-success" role="alert"><center>Sie haben Ihre Daten eroflgreich geändert!</center></div>';
                    }
                    
                    foreach ($bestellungen as $bestellung) {
                        echo '<div class="row">
                                    <div class="col-md-12">
                                        <p>Test</p>
                                    </div>
                              </div>';
                    }
                ?>       
            </div>
        </div>
    </div>
    
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
   
</body>
</html>