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
    <meta name="author" content="">

    <title>Ajouter des images</title>

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
        "Paysages" => "Paysages", 
        "Tableaux" => "Tableaux", 
        "People" => "People", 
        "Plats et restauration" => "Plats et restauration", 
        "Animaux" => "Animaux", 
        "Monuments et lieux celebres" => "Monuments et lieux celebres", 
        "Images historiques" => "Images historiques", 
        "Sports et divertissement" => "Sports et divertissement"
    ];

    if(
        isset($_POST["subcategory"]) &&
        isset($_FILES["image_file"]) &&
        isset($_POST["image_title"]) &&
        isset($_POST["image_place"]) &&
        isset($_POST["image_year"]) &&
        isset($_POST["image_author"])
        ){  
            
            // Nom du fichier uploadé
            $name_file = $_FILES['image_file']['name'];
            
            // Nom temporaire du fichier uploadé
            $tmp_file = $_FILES['image_file']['tmp_name'];
            
            // Dossier de destination
            $folder = '../img/images/'.$name_file;
            
            // Retourne l'erreur correspondante à l'upload. Si $error_file == UPLOAD_ERR_OK, il n'y a pas d'erreur
            $error_file = $_FILES['image_file']['error'];
            
            // Attributs
            $attributes = array("category", "subcategory", "place", "year", "author");
            
            // Extensions supportées
            $extensions = array('.jpg', '.JPG', '.jpeg', '.JPEG', '.png', '.PNG', '.gif', '.GIF');
            
            // Extension du fichier uploadé
            $extension = strrchr($_FILES['image_file']['name'], '.');
            
            // Taille maximale du fichier uploadé
            $max_file_size = 1000000;
            
            // Taille du fichier uploadé
            $file_size = filesize($_FILES['image_file']['tmp_name']); 
                   
            $_POST["image_title"] = trim($_POST["image_title"]);
            $_POST["image_place"] = trim($_POST["image_place"]);
            $_POST["image_year"] = trim($_POST["image_year"]);
            $_POST["image_author"] = trim($_POST["image_author"]);
            
            if(empty($_POST["subcategory"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez sélectionner une sous-catégorie.";
            }
            
            if(empty($_POST["image_title"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez renseigner un titre.";
            }
            
            if(empty($_POST["image_place"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez renseigner le lieu.";
            }
            
            if(empty($_POST["image_year"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez renseigner une année.";
            }
            
            if(empty($_POST["image_author"])){
                $error = TRUE;
                $msg_error .= "<br>Veuillez renseigner un auteur.";
            }
            
            if (!array_key_exists($_POST["subcategory"], $list_of_subcategories)){
                $error = TRUE;
                $msg_error .= "<br>La sous-catégorie du média n'est pas valide.";
            }
            // Le titre de l'image doit faire au moins 6 caractères
            if(strlen($_POST["image_title"]) < 6){
                $error = TRUE;
                $msg_error .= "<br>Le titre de l'image doit contenir au moins 6 caractères."; 
            }
            
            // Le lieu de l'image doit faire au moins 4 caractères
            if(strlen($_POST["image_place"]) < 4){
                $error = TRUE;
                $msg_error .= "<br>Le lieu de l'image doit contenir au moins 4 caractères."; 
            }
            
            // L'auteur de l'image doit faire au moins 6 caractères
            if(strlen($_POST["image_author"]) < 6){
                $error = TRUE;
                $msg_error .= "<br>L'auteur de l'image doit contenir au moins 6 caractères."; 
            }
            
            // L'année de l'image doit faire 4 caractères et doit être comprise entre 1900 et 2016 (et donc être un nombre)
            if(strlen($_POST["image_year"]) != 4 || $_POST["image_year"] < 1200 || $_POST["image_year"] > 2016){
                $error = TRUE;
                $msg_error .= "<br>L'année renseignée pour cette image est incorrecte."; 
            }
            
            if(mediaExist($_POST["image_title"])){
                $error = TRUE;
                $msg_error .= "<br>Le média existe déjà dans QuickMind.";
            }
            
            // Le fichier doit être de type image
            if(!in_array($extension, $extensions)){
                $error = TRUE;
                $msg_error .= "<br>Le format du fichier est incompatible.<br>Extensions compatibles : '.jpg', '.jpeg' '.png', '.gif'";
            }
            
            if($file_size > $max_file_size){
                $error = TRUE;
                $msg_error .= "<br>Ce fichier fait plus de 1 Mo."; 
            }
            
            if(!$error){
                
                /* S'il n'y a pas d'erreur, insérer le fichier 
                    dans www/QuickMind/img/images */
                
                if($error_file == UPLOAD_ERR_OK){    
                    move_uploaded_file($tmp_file, $folder);
                }else{
                    $error = TRUE;
                    $msg_error .= "Echec de l'upload. Veuillez réessayer.";
                }
                
                /* On se connecte à la BDD, et on renseigne les informations relatives
                    au média uploadé. 
                    
                    Il nous faudra au total 6 requêtes : 
                            - une pour la table "medias" (title, name_category)
                            - et quatre pour la table "tags" */
                
                $db = connectDb();
                
                // On insère la sous-catégorie de l'image dans 'tags'
                $tags_first_query = $db->prepare("INSERT INTO tags (name, attribute) VALUES (:name, :attribute)");
                $tags_first_query->execute([
                    "name"=>$_POST['subcategory'],
                    "attribute"=>$attributes[1]
                ]); 
                
                // On insère le lieu de l'image dans 'tags'
                $tags_second_query = $db->prepare("INSERT INTO tags (name, attribute) VALUES (:name, :attribute)");
                $tags_second_query->execute([
                    "name"=>$_POST['image_place'],
                    "attribute"=>$attributes[2]
                ]); 
                
                // On insère l'année de l'image dans 'tags'
                $tags_third_query = $db->prepare("INSERT INTO tags (name, attribute) VALUES (:name, :attribute)");
                $tags_third_query->execute([
                    "name"=>$_POST['image_year'],
                    "attribute"=>$attributes[3]
                ]);
                
                // On insère l'auteur de l'image dans 'tags'
                $tags_fourth_query = $db->prepare("INSERT INTO tags (name, attribute) VALUES (:name, :attribute)");
                $tags_fourth_query->execute([
                    "name"=>$_POST['image_author'],
                    "attribute"=>$attributes[4]
                ]);
                
                // On insère le titre et la catégorie correspondante dans 'medias' 
                $query = $db->prepare("INSERT INTO medias (title, name_category) VALUES (:title, :name_category)");
                $query->execute([
                    "title"=>$_POST['image_title'],
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
                        <p class="intro-text">Ajouter des images</p>
                        <p>Cette interface permet d'ajouter du contenu multimédia de type Image.</p>
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
                            <a href="#add-image-form" class="btn btn-circle page-scroll">
                                <i class="fa fa-angle-double-down animated"></i>
                            </a>
                            <?php
                        }else{
                            ?>
                            <a href="#add-image-section" class="btn btn-circle page-scroll">
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
    
    <section id="add-image-section">
        <section id="add-image" class="content-section text-center">
                            <p class="intro-text">Complétez le formulaire d'ajout de contenu de type Image.<br>Vous devez renseigner l'ensemble des champs.</p>
                            <br>
                            <br>
                            <br>
                            <br>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <form name="add-image-form" id="add-image-form"  enctype="multipart/form-data" method="POST">
                                            <?php
                                            if($error){
                                                echo $msg_error;
                                                echo "<br>";
                                                echo "<br>";
                                                echo "<br>";
                                            }
                                            ?>
                                            Cliquez ici pour importer un fichier image depuis votre ordinateur.<br><br><br>
                                            <input type="hidden" name="max_file_size" value="1000000">
                                            <center><input type="file" id="image_file" name="image_file" value="<?php echo (isset( $_POST["image_file"] ))? $_POST["image_file"]:"";?>"></center><br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            Le formulaire ci-dessous permet de renseigner les informations relatives au fichier image uploadé.<br><br><br>
                                            <select name="subcategory">
			                                <?php 
				                                foreach ($list_of_subcategories as $key => $value) {
                                                    echo "<option ".(( isset($_POST["subcategory"])  &&  $_POST["subcategory"] == $key)? "selected='selected'":'')." value='".$key."'>".$value."</option>";
				                                }
			                                ?>
		                                    </select>
                                            <input type="text" name="image_title" placeholder="Titre de l'image" value="<?php echo (isset( $_POST["image_title"] ))? $_POST["image_title"]:"";?>">
                                            <input type="text" name="image_place" placeholder="Lieu de l'image" value="<?php echo (isset( $_POST["image_place"] ))? $_POST["image_place"]:"";?>">
                                            <br>
                                            <br>
                                            <input type="text" name="image_year" placeholder="Année de l'image" value="<?php echo (isset( $_POST["image_year"] ))? $_POST["image_year"]:"";?>">
                                            <input type="text" name="image_author" placeholder="Auteur de l'image" value="<?php echo (isset( $_POST["image_author"] ))? $_POST["image_author"]:"";?>"><br>
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
