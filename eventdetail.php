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
                    <li><a class="active-menu" href="index.php?seite=events"><i class="fa fa-table fa-3x"></i>Meine Events</a></li>
                    <li><a href="index.php?seite=neuesevent"><i class="fa fa-edit fa-3x"></i>Neues Event</a></li>
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
                        $eventname = $_POST['inp_eventname'];
                        $eventbeschreibung = $_POST['inp_eventbeschreibung'];
                        $startdatum = $_POST['inp_startdatum'];
                        $enddatum = $_POST['inp_enddatum'];
                        $status = $_POST['inp_status'];
                        $update = $DB->Execute("UPDATE events set star_date = '$startdatum', end_date = '$enddatum', name = '$eventname', description = '$eventbeschreibung', status = '$status' WHERE  pk_event_id = $ID");
                        echo '<div class="alert alert-success" role="alert"><center>Sie haben Ihre Daten eroflgreich geändert!</center></div>';
                        header("Location:".$_SERVER['REQUEST_URI']);  
                    } elseif($exp=='edit1') {
                        $image_name = $_FILES['inp_upload']['name'];
                        $image_type = $_FILES['inp_upload']['type'];
                        $image_size = $_FILES['inp_upload']['size'];
                        $image_tmp_name = $_FILES['inp_upload']['tmp_name'];
            
                        if($image_name=='') {
                            echo '<div class="alert alert-danger" role="alert"><center>Please select a picture!</center></div>';
                        } else {
                            move_uploaded_file($image_tmp_name, "uploads/$image_name");
                            $updateProfilePicture = $DB->Execute("UPDATE events set event_picture_path = 'uploads/$image_name', event_picture_name = '$image_name' WHERE  pk_event_id = $ID");
                            echo '<div class="alert alert-success" role="alert"><center>Sie haben Ihr Bild eroflgreich geändert!</center></div>';
                            header("Location:".$_SERVER['REQUEST_URI']);  
                        }
                    } elseif($exp=='edit2') {
                        $image_name = $_FILES['inp_upload_2']['name'];
                        $image_type = $_FILES['inp_upload_2']['type'];
                        $image_size = $_FILES['inp_upload_2']['size'];
                        $image_tmp_name = $_FILES['inp_upload_2']['tmp_name'];
            
                        if($image_name=='') {
                            echo '<div class="alert alert-danger" role="alert"><center>Please select a picture!</center></div>';
                        } else {
                            move_uploaded_file($image_tmp_name, "uploads/$image_name");
                            $updatePlan = $DB->Execute("UPDATE events set plan_picture_path = 'uploads/$image_name', plan_picture_name = '$image_name' WHERE  pk_event_id = $ID");
                            echo '<div class="alert alert-success" role="alert"><center>Sie haben Ihr Bild eroflgreich geändert!</center></div>';
                            header("Location:".$_SERVER['REQUEST_URI']);  
                        }
                    }
    
                    foreach ($events as $eventDetail) {
                        echo '<div class="row">
                                    <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form role="form" method="post">
                                                        <p>Eventname:</p>
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" name="inp_eventname" id="inp_eventname_id"  value="'.$eventDetail['name'].'"/>
                                                        </div> 
                                                        
                                                        <p>Eventbeschreibung:</p>
                                                        <div class="form-group input-group">
                                                            <textarea class="form-control" name="inp_eventbeschreibung" id="inp_eventbeschreibung_id" rows="10" cols="75">'.$eventDetail['description'].'</textarea>
                                                        </div> 
                                                        
                                                        <p>Startdatum:</p>
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            <input type="date" class="form-control" name="inp_startdatum" id="inp_startdatum_id"  value="'.$eventDetail['star_date'].'"/>
                                                        </div>
                                                        
                                                        <p>Startdatum:</p>
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            <input type="date" class="form-control" name="inp_enddatum" id="inp_enddatum_id"  value="'.$eventDetail['star_date'].'"/>
                                                        </div>
                                                        
                                                        <p>Status:</p>
                                                        <div class="form-group input-group">
                                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                            <select class="form-control" name="inp_status" id="inp_status_id" value="'.$eventDetail['status'].'">
                                                                <option'; if ($eventDetail['status'] === 'planned') echo ' selected="selected"'; echo '>planned</option>
                                                                <option'; if ($eventDetail['status'] === 'running') echo ' selected="selected"'; echo '>running</option>
                                                                <option'; if ($eventDetail['status'] === 'done') echo ' selected="selected"'; echo'>done</option>
                                                            </select>
                                                        </div>
                                                        
                                                        <input type="hidden" name="exp" value="edit" />
                                            <input type="submit"class="form-control btn-success" name="inp_aendern" id="inp_aendern_id" value="Ändern" />
                                            
                                                    </form>
                                                    
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <form role="form" method="post" enctype="multipart/form-data"><br /><br />';
                                                        if ($eventDetail['event_picture_path'] != '') {
                                                            echo '<img class="image-responsive" src="'.$eventDetail['event_picture_path'].'" width="50%" height="50%" /><br />';
                                                        }
                                                        echo '<label class="control-label">Neues Eventfoto auswählen</label>
                                                        <input name="inp_upload" id="inp_upload_id" type="file" class="form-control btn-file">
                                                        <input type="hidden" name="exp" value="edit1" />
                                                        <input type="submit" class="form-control btn-success" name="inp_aendern_profile" id="inp_aendern_id_profile" value="Ändern" />
                                                    </form>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form role="form" method="post" enctype="multipart/form-data">
                                                        <p>Tischbelgungsplan:</p>';
                                                        if ($eventDetail['plan_picture_path'] != '') {
                                                            echo '<img class="image-responsive" src="'.$eventDetail['plan_picture_path'].'" width="75%" height="75%" /><br /><br />';
                                                        }
                                                        echo '<label class="control-label">Neuen Tischbelegungsplan auswählen</label>
                                                        <input name="inp_upload_2" id="inp_upload_id_2" type="file" class="form-control btn-file">
                                                        <input type="hidden" name="exp" value="edit2" />
                                                        <input type="submit" class="form-control btn-success" name="btn_hochladen" id="btn_hochladen" value="Ändern" /><br />
                                                    </form>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        </div>';
                                        
                                        foreach ($bestellungen as $bestellung) {
                                                if ($bestellung != '') {
                                                    echo '<table class="table table-striped table-bordered table-hover">
                                                            <a id="bestellklap" onclick="versteckt()">Bestellungen ausklappen</a>
                                                            <thead>
                                                                <tr class="bestelldrop" style="display:none;">
                                                                    <th>ID</th>
                                                                    <th>Name</th>
                                                                    <th>Datum</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="bestelldrop" style="display:none;">
                                                                <td>'.$bestellung['pk_order_id'].'</td>
                                                                <td><a href="orderdetail.php?id='.$bestellung['pk_order_id'].'">'.$bestellung['name'].'</a></td>
                                                                <td>'.$bestellung['created_time'].'</td>
                                                            </tr>';
                                                }
                                    }
                                        
                                    echo '</tbody></table></div></div></div>';
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