    <h1><?=$title?></h1>

    <?php if($hasErrors): ?>
        <ul>
            <?php foreach($errors as $message): ?>
                <li><?= $message ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label class="form-label">Identifiant</label>
            <input type="text" name="login" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" name="pwd" class="form-control">
        </div>

        <button type="submit" name="submit" class="btn btn-primary mt-2">Valider</button>
    </form>
