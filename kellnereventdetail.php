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
    
    <?php
	
	require('includes/adodb/adodb.inc.php'); //integrates the adodb.inc.php file to the webpage
    require('includes/helpers/menuhelper.inc.php');
    require('includes/helpers/loginhelper.inc.php');
    require('includes/helpers/dashboardhelper.inc.php');
    require('includes/helpers/profilehelper.inc.php');
    require('includes/helpers/registerhelper.inc.php');
	$DB = NewADOConnection('mysql'); //creates a new connection to the MySQL-database	
	$DB->Connect('localhost','root','','usrdb_flhmnoco5'); //connect with: server, user, password, database 	
		
?>
    
    <div id="wrapper">
         <?php
            echo menuHelper::outputKellnerHeader();
            echo menuHelper::outputKellnerMenu();
        ?>
        
        <div id="page-wrapper">
            <div id="page-inner">
                <?php
                    require('includes/adodb/adodb.inc.php'); //integrates the adodb.inc.php file to the webpage
                    $DB = NewADOConnection('mysql'); 
                    $DB->Connect('localhost','root','','usrdb_flhmnoco5'); 	

                    $ID = $_GET['id'];
                    $events = $DB->Execute("SELECT * FROM events where pk_event_id=$ID");
                    $bestellungen = $DB->Execute("SELECT * FROM orders");
    
                    foreach ($events as $eventDetail) {
                        echo '<div id="page-inner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2>'.$eventDetail['name'].'</h2>   
                                        <p>Beschreibung: '.$eventDetail['description'].'</p>
                                        <p>Startdatum: '.$eventDetail['star_date'].'</p>
                                        <p>Enddatum: '.$eventDetail['end_date'].'</p>
                                        <p>Status: abgeschlossen</p>
                                        <table class="table table-striped table-bordered table-hover">
                                        <a id="bestellklap" onclick="versteckt()">Bestellungen ausklappen</a>
                                            <thead>
                                                <tr class="bestelldrop" style="display:none;">
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Datum</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                            foreach ($bestellungen as $bestellung) {
                                                echo '<tr class="bestelldrop" style="display:none;">
                                                        <td>'.$bestellung['pk_order_id'].'</td>
                                                        <td><a href="orderdetail.php?id='.$bestellung['pk_order_id'].'">'.$bestellung['name'].'</a></td>
                                                        <td>'.$bestellung['created_time'].'</td>
                                                       </tr>';
                                                                        
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