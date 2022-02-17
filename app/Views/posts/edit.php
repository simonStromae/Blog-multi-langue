<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="blog-container">
    <form action="<?= route_to('update_post', $post->id) ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="_method" value="PUT" />

        <div class="form-group">
            <h3>Modification Article</h3>
            <small style="font-weight:300">Renseigner les champs ci-dessous pour enregistrer un article</small>
        </div>

        <div class="errors">
            <?= service('validation')->listErrors() ?>
        </div>

        <div class="form-group">
            <label for="titre">Titre </label>
            <input type="text" name="titre" id="titre" class="form-control" value="<?= $post->title ?>" placeholder="Saisissez le titre de l'article">
        </div>
        <div class="form-group">
            <label for="lang">Langue </label>
            <select name="langue" id="lang" class="form-control">
                <option value="">Sélectionnez une langue...</option>
                <?php foreach ($langs as $key => $lang) : ?>
                    <option <?= ($key == $post->lang) ? 'selected' : '' ?> value="<?= $key ?>"><?= $lang ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="contenu">Contenu</label>
            <textarea name="contenu" id="contenu" cols="30" rows="10" class="form-control"><?= $post->text ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-dark" style="width: 100%;">Modifier</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>