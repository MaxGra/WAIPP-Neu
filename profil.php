<div id="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>Mein  Profil</h2>   
            <h5>Benutzerdaten bearbeiten</h5>
        </div>
    </div>
                 
    <hr />
    
    <?php
    
        require('includes/adodb/adodb.inc.php'); 
        $DB = NewADOConnection('mysql'); 
        $DB->Connect('localhost','root','','usrdb_flhmnoco5');
    
        $exp='';
            
        if(isset($_POST['exp']))
            $exp = $_POST['exp'];

        if($exp=='edit') {
            $username = $_POST['inp_username'];
            $firstname = $_POST['inp_firstname'];
            $lastname = $_POST['inp_lastname'];
            $email = $_POST['inp_email'];
            $organization = $_POST['inp_organization'];
            $update = $DB->Execute("UPDATE users set username = '$username', firstname = '$firstname', lastname = '$lastname', email = '$email', organization = '$organization' WHERE  pk_user_id = '".$_SESSION['id']."'");
            echo '<div class="alert alert-success" role="alert"><center>Sie haben Ihre Daten eroflgreich geändert!</center></div>';
        }
    
        if($exp=='edit1') {
            $image_name = $_FILES['inp_upload']['name'];
            $image_type = $_FILES['inp_upload']['type'];
            $image_size = $_FILES['inp_upload']['size'];
            $image_tmp_name = $_FILES['inp_upload']['tmp_name'];
            
            if($image_name=='') {
                echo '<div class="alert alert-danger" role="alert"><center>Please select a picture!</center></div>';
            } else {
                move_uploaded_file($image_tmp_name, "uploads/$image_name");
                $updateProfilePicture = $DB->Execute("UPDATE users set profile_picture_path = 'uploads/$image_name', profile_picture_name = '$image_name' WHERE  pk_user_id = '".$_SESSION['id']."'");
                echo '<div class="alert alert-success" role="alert"><center>Sie haben Ihr Bild eroflgreich geändert!</center></div>';
            }
        }
        
        $data = $DB->Execute("SELECT * FROM users where pk_user_id = '".$_SESSION['id']."'");

        foreach ($data as $profiledata) {
            echo '<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form role="form" method="post">
                                            <p>Benutzername:</p>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="inp_username" id="inp_username_id"  value="'.$profiledata['username'].'"/>
                                            </div>

                                            <p>Vorname:</p>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="inp_firstname" id="inp_firstname_id"  value="'.$profiledata['firstname'].'" />
                                            </div>

                                            <p>Nachname:</p>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" class="form-control" name="inp_lastname" id="inp_lastname_id"  value="'.$profiledata['lastname'].'" />
                                            </div>

                                            <p>Email:</p>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope "  ></i></span>
                                                <input type="text" class="form-control" name="inp_email" id="inp_email _id"  value="'.$profiledata['email'].'" />
                                            </div>

                                            <p>Rolle:</p>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-male "  ></i></span>
                                                <input type="text" class="form-control" name="inp_role" hidden id="inp_role_id"  value="'.$profiledata['role'].'" />
                                            </div>
                                
                                            <p>Organisation:</p>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon"><i class="fa fa-university "  ></i></span>
                                                <input type="text" class="form-control" name="inp_organization" id="inp_organisation_id"  value="'.$profiledata['organization'].'" />
                                            </div>
                                            
                                            <input type="hidden" name="exp" value="edit" />
                                            <input type="submit"class="form-control btn-success" name="inp_aendern" id="inp_aendern_id" value="Ändern" /><br />
                                            <a href="passwort.php?id='.$profiledata['pk_user_id'].'">
                                                <input type="button" class="form-control btn-success" name="inp_aendern" id="inp_aendern_id" value="Passwort ändern" />
                                            </a>
                                            </form>
                                            
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <form role="form" method="post" enctype="multipart/form-data"><br><br>';
                                            if ($profiledata['profile_picture_path'] != '') {
                                                echo '<img src="'.$profiledata['profile_picture_path'].'" width="50%" height="50%" /><br />';
                                            }
                                            echo '<label class="control-label">Neuen Avatar auswählen</label>
                                            <input name="inp_upload" id="inp_upload_id" type="file" class="form-control btn-file">
                                            <input type="hidden" name="exp" value="edit1" />
                                            <input type="submit" class="form-control btn-success" name="inp_aendern_profile" id="inp_aendern_id_profile" value="Ändern" />
                                        </form>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>               
            </div>';
        }
    
?>
    
</div>