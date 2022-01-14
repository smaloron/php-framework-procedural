<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? "Mon site" ?></title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>
<body class="container-fluid p-4">
    <nav>
         <?php if (isset($_SESSION['user'])): ?>
            <h3>Bonjour <?=$_SESSION['user']?></h3>
            <a href="<?=getLinkToRoute("logout")?>">déconnexion</a>
        <?php else: ?>
            <a href="<?=getLinkToRoute("login")?>">Connexion</a>
            <a href="<?=getLinkToRoute("register")?>">Inscription</a>
        <?php endif;?>
    </nav>
   
    <div class="row justify-content-center">
        <div class="col-md-8 p-2 bg-danger">

            <?php if(hasFlash()): ?>
                <div class="alert alert-warning p-2">
                    <?= getFlash() ?>
                </div>
            <?php endif;?>

            <?php echo $content ?>
        </div>
        
    </div>
    
</body>
</html>