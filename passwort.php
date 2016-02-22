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
            margin-left: 1060px;
            margin-top: 15px;
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
            <form name="frm_logoutform" action="index.php" method="post">
      		    <input class="btn btn-danger square-btn-adjust" id="logout" name="logout" type="submit" value="Logout" />
      		</form>
            
        </nav>
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				    <li class="text-center">
                        <img src="pictures/WP_Logo_V1.svg" class="user-image img-responsive"/>
					</li>
                    <li><a href="index.php"><i class="fa fa-dashboard fa-3x"></i>Dashboard</a></li>  	
                    <li><a href="index.php?seite=events"><i class="fa fa-table fa-3x"></i>Meine Events</a></li>
                    <li><a href="neuesevent.php"><i class="fa fa-edit fa-3x"></i>Neues Event</a></li>
				    <li><a class="active-menu" href="index.php?seite=profil"><i class="fa fa-user fa-3x"></i>Mein Profil</a></li>		
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Passwort ändern</h2>
                    </div>
                </div>
                 
            <hr />
                
            <?php

                require('includes/adodb/adodb.inc.php'); 
                $DB = NewADOConnection('mysql'); 
                $DB->Connect('localhost','root','','usrdb_flhmnoco5');
                
                $ID = $_GET['id'];
                $data = $DB->Execute("SELECT * FROM users where pk_user_id=$ID");

                $exp='';

                if(isset($_POST['exp']))
                    $exp = $_POST['exp'];

                if($exp=='update') {
                    foreach ($data as $profiledata) {
                        $passwort_alt = $profiledata['password'];
                    }
                    $passwort_alt_eingabe = $_POST['inp_passwort_alt'];
                    $passwort_neu_eingabe = $_POST['inp_passwort_neu'];
                    $passwort_neu_eingabe_wiederholen = $_POST['inp_passwort_neu_wiederholen'];
                    
                    if ($passwort_alt_eingabe == $passwort_alt && $passwort_neu_eingabe == $passwort_neu_eingabe_wiederholen) {
                        $updatePasswort = $DB->Execute("UPDATE users set password = '$passwort_neu_eingabe_wiederholen' WHERE  pk_user_id=$ID");
                        echo '<div class="alert alert-success" role="alert"><center>Sie haben Ihr Passwort erfolgreich geändert!</center></div>';
                    } elseif ($passwort_alt_eingabe == $passwort_alt) {
                        echo '<div class="alert alert-danger" role="alert"><center>Ihr aktuelles Passwort ist nicht korrekt!</center></div>';
                    } elseif ($passwort_neu_eingabe != $passwort_neu_eingabe_wiederholen){
                        echo '<div class="alert alert-danger" role="alert"><center>Bitte überprüfen Sie die Eingabe Ihres neuen Passworts!</center></div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert"><center>Bitte überprüfen Sie Ihre Eingaben!</center></div>';
                    }
                   
                }

            ?>
                
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" method="post">
                                        <p>Altes Passwort:</p>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="password" class="form-control" name="inp_passwort_alt" id="inp_passwort_alt_id_id" />
                                        </div>

                                        <p>Neues Passwort</p>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="password" class="form-control" name="inp_passwort_neu" id="inp_passwort_neu_id" />
                                        </div>

                                        <p>Neues Passwort wiederholen</p>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="password" class="form-control" name="inp_passwort_neu_wiederholen" id="inp_passwort_neu_wiederholen_id" />
                                        </div>

                                        <input type="hidden" name="exp" value="update" />
                                        <input type="submit"class="form-control btn-success" name="inp_aendern" id="inp_aendern_id" value="Paswort ändern" />
                                    </form>      
                                </div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>
        </div>
    </div>
</div>
    
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.metisMenu.js"></script>
<script src="assets/js/custom.js"></script>
   
</body>
</html>