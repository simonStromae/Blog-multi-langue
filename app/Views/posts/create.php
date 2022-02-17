<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="blog-container">
    <form action="<?= route_to('save_post') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <h3>Nouvel Article</h3>
            <small style="font-weight:300">Renseigner les champs ci-dessous pour enregistrer un article</small>
        </div>

        <div class="errors">
            <?= service('validation')->listErrors() ?>
        </div>

        <div class="form-group">
            <label for="titre">Titre </label>
            <input type="text" name="titre" id="titre" class="form-control" placeholder="Saisissez le titre de l'article">
        </div>
        <div class="form-group">
            <label for="lang">Langue </label>
            <select name="langue" id="lang" class="form-control">
                <?php foreach ($langs as $key => $lang) : ?>
                    <option value="<?= $key ?>"><?= $lang ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" cols="30" rows="3" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-dark" style="width: 100%;">Enregistrer</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>