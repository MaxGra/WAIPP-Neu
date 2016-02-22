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
                            echo "Test";
                            print_r($result);
                            echo $result;
                            //$COUNT_NUMBER = mysql_fetch_array($result); 
                            //echo "<br>1.Count=" .$COUNT_NUMBER[0]; 
                            
                    ?>
        
        <div class="col-md-3 col-sm-6 col-xs-6">
            <div class="panel panel-back noti-box">
                <span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-calendar"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text">Meine Events</p>
                    <p class="text-muted">
                        TestTest
                    </p>
                </div>
            </div>
        </div>
        
    </div>
        
</div>