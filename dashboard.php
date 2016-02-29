<div id="page-inner">
    
    <div class="row">
        <div class="col-md-12">
            <h2>Dashboard</h2>   
            <h5>Willkommen <?php echo $_SESSION['username'];?>, schön dich wieder zu sehen.</h5>
        </div>
    </div>              
   
    <hr />
    
    <div class="row">
        
        <?php
                            require('includes/adodb/adodb.inc.php'); 
                            $DB = NewADOConnection('mysql'); 
                            $DB->Connect('localhost','root','','usrdb_flhmnoco5');
                        
                            $userID = $_SESSION['id'];
                            //$events_geplannt = $DB->Execute("SELECT COUNT(pk_event_id) FROM users_events where pk_fk_user_id='$userID' AND status='geplant'");
                            $result = $DB ->Execute("SELECT COUNT(pk_event_id) FROM users_events where pk_fk_user_id='$userID'");
                            $result2 = $DB ->Execute("SELECT COUNT(pk_event_id) FROM events where pk_fk_user_id='$userID'");
                            print_r($result);
                            echo $result;
        
                            // MACH SACHEN - FRICKH
                            
        
        
        
                            //$COUNT_NUMBER = mysql_fetch_array($result);
        
                            //echo "<br>1.Count=" .$COUNT_NUMBER[0]; 
                            
                            
                    ?>
        
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-calendar"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Laufende Events</p>
                    <p class="text-muted">
                        <?php
                            $running_events = $DB -> Execute("SELECT COUNT( pk_event_id ) AS nummer, status
FROM EVENTS INNER JOIN users_events ON events.pk_event_id = users_events.pk_fk_event_id
INNER JOIN users ON users.pk_user_id = users_events.pk_fk_user_id
WHERE pk_user_id =".$userID." AND events.status='running'");
                            echo "Sie haben derzeit ";
                            foreach ($running_events as $ev_count){
                                echo $ev_count['nummer'];
                            }
                            echo " laufende Events.";
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-calendar"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Geplante Events</p>
                    <p class="text-muted">
                        <?php
                            $running_events = $DB -> Execute("SELECT COUNT( pk_event_id ) AS nummer, status
FROM EVENTS INNER JOIN users_events ON events.pk_event_id = users_events.pk_fk_event_id
INNER JOIN users ON users.pk_user_id = users_events.pk_fk_user_id
WHERE pk_user_id =".$userID." AND events.status='planned'");
                            echo "Sie haben derzeit ";
                            foreach ($running_events as $ev_count){
                                echo $ev_count['nummer'];
                            }
                            echo " geplante Events.";
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-6">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-calendar-o"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Abgeschlossene Events</p>
                    <p class="text-muted">
                        <?php
                            $running_events = $DB -> Execute("SELECT COUNT( pk_event_id ) AS nummer, status
FROM EVENTS INNER JOIN users_events ON events.pk_event_id = users_events.pk_fk_event_id
INNER JOIN users ON users.pk_user_id = users_events.pk_fk_user_id
WHERE pk_user_id =".$userID." AND events.status='done'");
                            echo "Sie haben derzeit ";
                            foreach ($running_events as $ev_count){
                                echo $ev_count['nummer'];
                            }
                            echo " abgeschlossene Events.";
                        ?>
                    </p>
                </div>
            </div>
        </div>
        
    </div>
        
</div>