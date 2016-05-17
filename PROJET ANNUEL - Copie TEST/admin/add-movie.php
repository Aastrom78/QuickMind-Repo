<?php 
    require "../init.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="main-actor" content="">

    <title>Ajouter des vidéos</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/grayscale.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/ajout.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">  
    
<?php 
    require "navigationadmin.php";
    
    $error = FALSE;
    $msg_error = ""; 
    $list_of_subcategories = [
        "Action", 
        "Animation", 
        "Aventure", 
        "Comédie", 
        "Espionnage", 
        "Fantastique", 
        "Horreur", 
        "Humour", 
        "Policier", 
        "Romantique", 
        "Science-fiction", 
        "Thriller", 
        "Western"
    ];

    if(
        isset($_POST["subcategory"]) &&
        isset($_FILES["movie_file"]) &&
        isset($_POST["movie_title"]) &&
        isset($_POST["movie_director"]) &&
        isset($_POST["movie_year"]) &&
        isset($_POST["movie_main-actor"])
        ){  
            
            // Nom du fichier uploadé
            $name_file = $_FILES['movie_file']['name'];
            
            // Nom temporaire du fichier uploadé
            $tmp_file = $_FILES['movie_file']['tmp_name'];
            
            // Dossier de destination
            $folder = '../movie/movies/'.$name_file;
            
            // Retourne l'erreur correspondante à l'upload. Si $error_file == UPLOAD_ERR_OK, il n'y a pas d'erreur
            $error_file = $_FILES['movie_file']['error'];
            
            // Attributs
            $attributes = array("category", "subcategory", "director", "year", "main-actor");
            
            // Extensions supportées
            $extensions = array('.mp4', '.avi', '.wmv');
            
            // Extension du fichier uploadé
            $extension = strrchr($_FILES['movie_file']['name'], '.');
            
            // Taille maximale du fichier uploadé
            $max_file_size = 100000000;
            
            // Taille du fichier uploadé
            $file_size = filesize($_FILES['movie_file']['tmp_name']); 
                   
            $_POST["movie_title"] = trim($_POST["movie_title"]);
            $_POST["movie_director"] = trim($_POST["movie_director"]);
            $_POST["movie_year"] = trim($_POST["movie_year"]);
            $_POST["movie_main-actor"] = trim($_POST["movie_main-actor"]);
            
            if(empty($_POST["subcategory"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez sélectionner une sous-catégorie.";
            }else if(!array_key_exists($_POST["subcategory"], $list_of_subcategories)){
                $error = TRUE;
                $msg_error .= "<br>La sous-catégorie du média n'est pas valide."; 
            }
            
            if(empty($_POST["movie_title"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez renseigner un titre.";
            }else if(strlen($_POST["movie_title"]) < 6){
                $error = TRUE;
                $msg_error .= "<br>Le titre de la vidéo doit contenir au moins 6 caractères."; 
            }
            
            if(empty($_POST["movie_director"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez renseigner le réalisateur.";
            }else if(strlen($_POST["movie_director"]) < 4){
                $error = TRUE;
                $msg_error .= "<br>Le réalisateur de la vidéo doit contenir au moins 4 caractères."; 
            }
            
            if(empty($_POST["movie_year"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez renseigner une année.";
            }else if(strlen($_POST["movie_year"]) != 4 || $_POST["movie_year"] < 1200 || $_POST["movie_year"] > 2016){
                $error = TRUE;
                $msg_error .= "<br>L'année renseignée pour cette vidéo est incorrecte."; 
            }
            
            if(empty($_POST["movie_main-actor"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez renseigner un acteur.";
            }else if(strlen($_POST["movie_main-actor"]) < 6){
                $error = TRUE;
                $msg_error .= "<br>L'acteur de la vidéo doit contenir au moins 6 caractères."; 
            }
            
            if(mediaExist($_POST["movie_title"])){
                $error = TRUE;
                $msg_error .= "<br>Le média existe déjà dans QuickMind.";
            }
            
            // Le fichier doit être de type movie
            if(!in_array($extension, $extensions)){
                $error = TRUE;
                $msg_error .= "<br>Le format du fichier est incompatible.<br>Extensions compatibles : '.mp4', '.avi', '.wmv'";
            }
            
            if($file_size > $max_file_size){
                $error = TRUE;
                $msg_error .= "<br>Ce fichier fait plus de 100 Mo."; 
            }
            
            if(!$error){
                
                /* S'il n'y a pas d'erreur, insérer le fichier 
                    dans www/QuickMind/img/movies */
                
                if($error_file == UPLOAD_ERR_OK){    
                    move_uploaded_file($tmp_file, $folder);
                }else{
                    $error = TRUE;
                    $msg_error .= "Echec de l'upload. Veuillez réessayer.";
                }
                
                /* On se connecte à la BDD, et on renseigne les informations relatives
                    au média uploadé. 
                    
                    Il nous faudra au total 5 requêtes : 
                            - une pour la table "medias" (title, name_category)
                            - et quatre pour la table "tags" (*/
                
                $db = connectDb();
                
                // On insère la sous-catégorie de la vidéo dans 'tags'
                $tags_first_query = $db->prepare("INSERT INTO tags (name, attribute) VALUES (:name, :attribute)");
                $tags_first_query->execute([
                    "name"=>$_POST['subcategory'],
                    "attribute"=>$attributes[1]
                ]); 
                
                // On insère le lieu de la vidéo dans 'tags'
                $tags_second_query = $db->prepare("INSERT INTO tags (name, attribute) VALUES (:name, :attribute)");
                $tags_second_query->execute([
                    "name"=>$_POST['movie_director'],
                    "attribute"=>$attributes[2]
                ]); 
                
                // On insère l'année de la vidéo dans 'tags'
                $tags_third_query = $db->prepare("INSERT INTO tags (name, attribute) VALUES (:name, :attribute)");
                $tags_third_query->execute([
                    "name"=>$_POST['movie_year'],
                    "attribute"=>$attributes[3]
                ]);
                
                // On insère l'auteur de la vidéo dans 'tags'
                $tags_fourth_query = $db->prepare("INSERT INTO tags (name, attribute) VALUES (:name, :attribute)");
                $tags_fourth_query->execute([
                    "name"=>$_POST['movie_main-actor'],
                    "attribute"=>$attributes[4]
                ]);
                
                // On insère le titre et la catégorie correspondante dans 'medias' 
                $query = $db->prepare("INSERT INTO medias (title, name_category) VALUES (:title, :name_category)");
                $query->execute([
                    "title"=>$_POST['movie_title'],
                    "name_category"=>$attributes[0]
                ]);
                
                // Redirection vers upsuccess.php
                header("Location: upsuccess.php");  
                
            }   

        }
        
?>

    <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <p class="intro-text">Ajouter des vidéos</p>
                        <p>Cette interface permet d'ajouter du contenu multimédia de type Vidéo.</p>
                        <p>Cliquez sur le bouton pour accéder au <br>formulaire d'ajout de contenu.</p>
                        <br>
                        <br>
                        <br>
                        <br>
                        <?php
                        if($error){
                            echo "Echec de l'upload !"?><br><br><?php echo "Erreur(s) lors de la saisie du formulaire."?><br><?php echo "Veuillez en prendre connaissance ci-dessous !";
                            echo "<br>";
                            echo "<br>";
                            echo "<br>";
                            echo "<br>";
                            ?>
                            <a href="#add-movie-form" class="btn btn-circle page-scroll">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                            <?php
                        }else{
                            ?>
                            <a href="#add-movie-section" class="btn btn-circle page-scroll">
                            <i class="fa fa-angle-double-down animated"></i>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <section id="add-movie-section">
        <section id="add-movie" class="content-section text-center">
                            <p class="intro-text">Complétez le formulaire d'ajout de contenu de type Vidéo.<br>Vous devez renseigner l'ensemble des champs.</p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <form name="add-movie-form" id="add-movie-form"  enctype="multipart/form-data" method="POST">
                                            <?php
                                            if($error){
                                                echo $msg_error;
                                                echo "<br>";
                                                echo "<br>";
                                                echo "<br>";
                                            }
                                            ?>
                                            Cliquez ici pour importer un fichier vidéo depuis votre ordinateur.<br><br><br>
                                            <input type="hidden" name="max_file_size" value="1000000">
                                            <center><input type="file" id="movie_file" name="movie_file" value="<?php echo (isset( $_FILES["movie_file"] ))? $_FILES["movie_file"]:"";?>"></center><br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            Le formulaire ci-dessous permet de renseigner les informations relatives au fichier vidéo uploadé.<br><br><br>
                                            <select name="subcategory">
			                                <?php 
				                                foreach ($list_of_subcategories as $key => $value) {
                                                    echo "<option ".(( isset($_POST["subcategory"])  &&  $_POST["subcategory"] == $key)? "selected='selected'":'')." value='".$key."'>".$value."</option>";
				                                }
			                                ?>
		                                    </select>
                                            <input type="text" name="movie_title" placeholder="Titre de la vidéo" value="<?php echo (isset( $_POST["movie_title"] ))? $_POST["movie_title"]:"";?>">
                                            <input type="text" name="movie_director" placeholder="Réalisateur de la vidéo" value="<?php echo (isset( $_POST["movie_director"] ))? $_POST["movie_director"]:"";?>">
                                            <br>
                                            <br>
                                            <input type="text" name="movie_year" placeholder="Année de la vidéo" value="<?php echo (isset( $_POST["movie_year"] ))? $_POST["movie_year"]:"";?>">
                                            <input type="text" name="movie_main-actor" placeholder="Acteur de la vidéo" value="<?php echo (isset( $_POST["movie_main-actor"] ))? $_POST["movie_main-actor"]:"";?>"><br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <input type="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>                    
            </section>
    </section>
    




<?php 
    require "footeradmin.php";
