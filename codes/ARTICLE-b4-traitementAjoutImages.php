<?php
session_start();
$titre = $_SESSION['titre'];
$id = $_SESSION['idArticle'];
if(is_numeric($id)){
  mkdir("../images/".$titre."/");
  $repertoireImages = "../images/".$titre."/";

  for($i=0;$i<sizeof($_FILES["images"]);$i++){
    if(!empty($_FILES["images"]["name"][$i])){
      $nouvelleImage = $repertoireImages.basename($_FILES["images"]["name"][$i]);
      $typeImage = strtolower(pathinfo($nouvelleImage,PATHINFO_EXTENSION));
      if (file_exists($nouvelleImage)) {
        echo $nouvelleImage." : ce nom de fichier est déjà pris, veuillez le renommer.<br>";
      }
      // pour vérifier le type du fichier uploadé : 
      if($typeImage != "jpg" && $typeImage != "png" && $typeImage != "jpeg"
      && $typeImage != "gif" ) {
        echo "Désolé seuls les JPG, JPEG, PNG & GIF sont autorisées.<br>";
        $uploadOk = 0;
      }
      if(move_uploaded_file($_FILES["images"]["tmp_name"][$i], $nouvelleImage)) {
        echo "";
      } else {
        echo $nouvelleImage.", désolé cette image n'a pas été uploadée.<br>";
      }
    }   
  }
  header('Location: ../index.php?action=lireArticle&idArticle='.$id);
} else{
  echo "mauvais endroit";
}

?>

