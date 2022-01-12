<div class="mb-4">
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Compétence</label>
            <input type="text" class="form-control" name="skill">
        </div>

        <button class="btn btn-primary" type="submit" name="submit">
            Valider
        </button>
    </form>
</div>

<ul>
    <?php foreach($skills as $item): ?>
        <li><?=$item["label"]?></li>
    <?php endforeach; ?>
</ul>

<!--
<ul>
    <?php foreach($skillsObj as $item): ?>
        <li><?=$item->label?></li>
    <?php endforeach; ?>
</ul>
-->
