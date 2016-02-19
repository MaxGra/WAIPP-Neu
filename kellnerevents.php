<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>Meine Events</h2>   
            <h5>Übersicht meiner Events</h5>
        </div>
    </div>
                 
    <hr />
    
    <?php 
        require('includes/adodb/adodb.inc.php'); 
        $DB = NewADOConnection('mysql'); 
        $DB->Connect('localhost','root','','usrdb_flhmnoco5'); 	

        $userID = $_SESSION['id'];

        $events1 = $DB->Execute("SELECT * FROM users_events where pk_fk_user_id='$userID'");
        foreach ($events1 as $event1) {
            $eventID = $event1['pk_fk_event_id'];
            $events = $DB->Execute("SELECT * FROM events where pk_event_id='$eventID'");
            foreach ($events as $event) {
                echo '<div class="row">
                            <div class="col-xs-12 event_container">           
                                <div class="panel panel-back noti-box">
                                        <span class="icon-box bg-color-red set-icon">
                                            <i class="fa fa-bars"></i>
                                        </span>
                                        <div class="text-box" >
                                            <a href="kellnereventdetail.php?id='.$event['pk_event_id'].'">
                                                <p class="main-text">'.$event['name'].'</p>
                                            </a>
                                            <p class="text-muted">'.$event['description'].'</p>
                                            <p class="text-muted">'.$event['star_date'].' bis '.$event['end_date'].'</p>
                                        </div>
                                        <div class="event_status">
                                            Status: abgeschlossen
                                        </div>
                                    </div>
                            </div>
                        </div>';
            }
        }
    ?>
    
</div>