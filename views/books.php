<h1>Liste des livres</h1>

<div class="mt-3 mb-3">
    <form method="get">
        <input type="search" name="search" class="form-control" placeholder="taper ici votre recherche" value="<?= $search ?>">
        <input type="hidden" name="page" value="books">
        <input type="hidden" name="currentPage" value="<?=$pagination["currentPage"]?>">
    </form>
</div>

<table class="table table-striped">
    <thead>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Editeur</th>
        <th>Genres</th>
    </thead>
    <tbody>
        <?php foreach ($bookList as $book): ?>
            <tr>
                <td><?= $book->titre ?></td>
                <td><?= $book->auteur ?></td>
                <td><?= $book->editeur ?></td>
                <td><?= $book->genre ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<nav>
    <ul class="pagination">
        <?php for ($i= 1; $i <= $pagination["numberOfPages"]; $i++): ?>
            <?php $activeClass = $pagination["currentPage"] == $i ? "active": ""; ?>
            <li class="page-item <?=$activeClass?>">
                <a href="<?= getLinkToRoute("books", ["currentPage" => $i, "search" => $search])?>"
                class="page-link">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor ?>
    </ul>
</nav>