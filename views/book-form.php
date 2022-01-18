<form method="post">
    <div class="mb-3">
        <label class="form-label">Titre</label>
        <input type="text" class="form-control" name="titre">
    </div>
    <div class="mb-3">
        <label class="form-label">prix</label>
        <input type="number" class="form-control" name="prix">
    </div>
    <div class="mb-3">
        <label class="form-label">Date de publication</label>
        <input type="date" class="form-control" name="date_publication">
    </div>
    <div class="mb-3">
        <label class="form-label">Auteur</label>
        <select class="form-select" name="id_auteur">
            <?= $authorOptions ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Editeur</label>
        <select class="form-select" name="id_editeur">
            <?= $publisherOptions ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Genre</label>
        <select class="form-select" name="id_genre">
            <?= $genreOptions ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Langue</label>
        <select class="form-select" name="id_langue">
            <?= $languageOptions ?>
        </select>
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
    
</form>