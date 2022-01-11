    <h1><?=$title?></h1>

    <?php if($hasErrors): ?>
        <ul>
            <?php foreach($errors as $message): ?>
                <li><?= $message ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post">
        <div>
            <label>Identifiant</label>
            <input type="text" name="login">
        </div>
        <div>
            <label>Mot de passe</label>
            <input type="password" name="pwd">
        </div>

        <button type="submit" name="submit">Valider</button>
    </form>
