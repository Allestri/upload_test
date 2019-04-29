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
                        <input type="text" name="titre" value="Titre du fichier" id="titre" /><br />
                    </div>
                    <div class="form-group">
                        <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br />
                        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                        <input type="file" name="myfile" id="myfile" /><br />
                    </div>

                    <input type="submit" name="submit" value="Envoyer" />
            	</form> 
			</div>
        </div>
            <div class="row">
                <div class="col-lg-12">
                	<?php 
                        if(isset($_FILES['myfile'])){
                            pre_r($_FILES);
                            $tmp_name = $_FILES['myfile']['tmp_name'];
                            $dir_folder = $_SERVER['DOCUMENT_ROOT'];
                            // var_dump($dir_folder);
                            move_uploaded_file($tmp_name, $dir_folder . 'DIR'.
                                $_FILES['myfile']['name']);
                        }
                        function pre_r($array){
                            echo '<pre>';
                            print_r($array);
                            echo '</pre>';
                        }
                        // $extensions_valides = array('jpg', 'jpeg', 'gif', 'png');
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
