<div class="p-5">
    <h1>Inscription</h1>

    <?php if(!empty($error)): ?>
        <div class="mt-3 mb-3 alert alert-danger p-3">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="post" >
        <div class="mb-3">
            <label class="form-label">Login</label>
            <input type="text" class="form-control" name="user_login">
        </div>
        <div class="mb-3">
            <label class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="user_password">
        </div>

        <button type="submit" class="btn btn-primary">
            Valider
        </button>
    </form>
</div>
