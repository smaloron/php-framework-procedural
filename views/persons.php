<h1>Liste des personnes </h1>
<table class="table">
    <thead>
        <tr>
            <td>Prénom</td>
            <td>Nom</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($personList as $person): ?>
            <tr>
                <td><?= $person->first_name ?></td>
                <td><?= $person->last_name ?></td>
                <td>
                    <a href="<?=getLinkToRoute("pdo_persons", ["id"=>       $person->id, "action"=>"delete"])?>
                    " class="btn btn-warning" 
                    onclick="return confirm('Voulez-vous supprimer cette personne ?')">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>