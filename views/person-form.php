<form method="post">
    <div class="mb-3">
        <label class="form-label">Prénom</label>
        <input type="text" class="form-control" name="person[first_name]">
    </div>
    <div class="mb-3">
        <label class="form-label">Nom</label>
        <input type="text" class="form-control" name="person[last_name]">
    </div>

    <fieldset>
        <legend>Adresse</legend>

        <div class="mb-3">
            <label class="form-label">Rue</label>
            <input type="text" class="form-control" name="address[street]">
        </div>
        <div class="mb-3">
            <label class="form-label">Code postal</label>
            <input type="text" class="form-control" name="address[zip_code]">
        </div>
        <div class="mb-3">
            <label class="form-label">Ville</label>
            <input type="text" class="form-control" name="address[city]">
        </div>
    </fieldset>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Valider</button>
    </div>
</form>