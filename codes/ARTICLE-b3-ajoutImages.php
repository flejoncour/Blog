<?php
$id = $_SESSION['idArticle'];
$vue['contenu']='
<div>
<form action="codes/ARTICLE-b4-traitementAjoutImages.php" method="post" enctype="multipart/form-data">
  <h1>Ajout d\'images à l\'article</h1>
  <h2>Si vous ne voulez pas ajouter d\'images, cliquer sur suivant</h2>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <p><input type="file" name="images[]"></p>
  <br>
  <p><button type="submit">Charger</button></p>
  <br><br>
  <p><a href="index.php?action=lireArticle&idArticle='.$id.'">Suivant</a></p>
</form>
</div>
</body>
</html>';
?>