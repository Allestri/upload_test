<!DOCTYPE html>
<html>

<head>
	<title>PHP Uploads</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Test envoyer un fichier</a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="file.php">Envoie fichier</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form method="post" action="file.php" enctype="multipart/form-data">
                
                	<div class="form-group">
                        <label for="titre">Titre du fichier (max. 50 caractères) :</label><br />
                        <input type="text" name="titre" placeholder="Titre du fichier" id="titre" required /><br />
                    </div>
                    <div class="form-group">
                        <label for="myfile">Fichier (tous formats | max. 10 Mo) :</label><br />
                        <input type="hidden" name="MAX_FILE_SIZE" value="10048576" />
                        <input type="file" name="myfile" id="myfile" /><br />
                    </div>

                    <input type="submit" name="submit" value="Envoyer" />
            	</form> 
			</div>
        </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                	<?php
                	
                        if(isset($_FILES['myfile'])){
                            
                            //pre_r($_FILES);
                            
                            
                            
                            $phpFileUploadErrors = array(
                            0 => 'There is no error, the file uploaded with success',
                            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                            3 => 'The uploaded file was only partially uploaded',
                            4 => 'No file was uploaded',
                            6 => 'Missing a temporary folder',
                            7 => 'Failed to write file to disk.',
                            8 => 'A PHP extension stopped the file upload.',
                            );
                            
                            
                            // Contrôle une liste extension valides.
                            $ext_error = false;
                            $extensions = array('jpg', 'JPG', 'jpeg', 'gif', 'png');
                            $file_ext = explode('.', $_FILES['myfile']['name']);
                            $file_ext = end($file_ext);
                            //pre_r($file_ext);
                            if(!in_array($file_ext, $extensions)){
                                $ext_error = true;
                            }
                            // Si l'erreur n'est pas egale à 0
                            if($_FILES['myfile']['error']){
                                echo $phpFileUploadErrors[$_FILES['myfile']['error']];
                            } elseif ($ext_error){
                                echo "Type de fichier invalide !";
                            } else { 
                                ?>
                                <div class="alert alert-success"><?php
                                $tmp_name = $_FILES['myfile']['tmp_name'];
                                $dir_folder = $_SERVER['DOCUMENT_ROOT'];
                                

                                
                                // Unique file ID
                                $fid = date('d');
                            
                            
                            function insertDatas(){
                                $bdd = new PDO('mysql:host=localhost;dbname=upload_photos;charset=utf8','root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                //var_dump($bdd);
                                $sql = "INSERT INTO photos (name, exif, upload_date) VALUES(?, 4, NOW())";
                                $sql = $bdd->prepare($sql);
                                $sql->execute(array($_POST['titre']));
                            }
                               
                            // Rename the file
                            function renameFile($file_ext) {
                                $name = "{$_POST['titre']}.{$file_ext}";
                            }
                                
                                // Check if a file already exists
                                if(file_exists('images/'. $name)){
                                    echo "Le fichier existe</br>";
                                    renameFile($fid);
                                    $name = "{$_POST['titre']}_{$fid}.{$file_ext}";
                                    move_uploaded_file($tmp_name, 'images/'. $name);
                                   
                                    $exif = exif_read_data('images/' . $name);
                                    //var_dump($exif);
                                    insertDatas();
                                } else {
                                    echo "Le fichier n'existe pas</br>";
                                    //var_dump($dir_folder);
                                    move_uploaded_file($tmp_name, 'images/'. $name);
                                    insertDatas();
                                    echo "Fichier uploadé avec succès !";
                                }                           
                                
                                ?>
                                </div>
                                <?php
                            }
                            
                            

                        }
                        function pre_r($array){
                            echo '<pre>';
                            print_r($array);
                            echo '</pre>';
                        }
                        // $maxsize = $_POST['MAX_FILE_SIZE'];
                        // $erreur = "";
                                
                        // if($_FILES['icone']['size'] > $maxsize) $erreur = "Erreur lors du transfert";
                        // var_dump($_FILES['myfile']);
                        // echo $erreur; 
                    ?>
            	</div>
            </div>
    </div>
</body>

</html>
