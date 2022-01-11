<?php
    var_dump($_FILES);

    $hasUpload = isset($_FILES["upload"]);

    if($hasUpload){
        $upload = $_FILES["upload"];
        if($upload["error"] == 0){
            $path = getcwd(). "/images/";
            $ext = ".jpg";
            $fileName = uniqid("photo_");

            $target = $path.$fileName.$ext;

            $success = move_uploaded_file($upload["tmp_name"], $target);

            if(! $success){
                $error = "Impossible de télécharger le fichier";
            }
        } else {
            $error = "Le serveur a refusé le fichier";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="upload">
        <button type="submit" name="submit">Valider</button>
    </form>

    <?php if($hasUpload && ! empty($error)): ?>
        <p> <?= $error ?>
    <?php elseif($hasUpload): ?>
        <img src="/images/<?=$fileName.$ext?>">
    <?php endif; ?>
    
</body>
</html>