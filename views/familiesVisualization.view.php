<?php ob_start(); ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Famille</th>
      <th scope="col">Description</th>
      <th scope="col" colspan="2">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($families as $family) : ?>
        <tr>
            <td><?= $family['famille_id'] ?></td>
            <td><?= $family['famille_libelle'] ?></td>
            <td><?= $family['famille_description'] ?></td>
            <td><button class="btn btn-warning">Modifier</button></td>
            <td>
              <form method="post" action="<?= URL ?>back/families/validationDelete"
              onSubmit="return confirm('Voulez vous vraiment supprimer ?');">
                <input type="hidden" name="famille_id" value="<?= $family['famille_id']?>" />
                <button class="btn btn-danger" type="submit">Supprimer</button>
              </form>
            </td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
$content = ob_get_clean();
$titre = "Les familles";
require "views/commons/template.php";