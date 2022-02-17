<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<?php $session = \Config\Services::session(); ?>
<?php $validation =  \Config\Services::validation(); ?>

<?php if (session()->getFlashdata('message') !== NULL) : ?>
    <p class="alert-<?= session()->getFlashdata('messageType'); ?>">
        <?= session()->getFlashdata('message'); ?>
    </p>
<?php endif; ?>

<div class="blog-container">
    <form action="<?= route_to('update_profile_user') ?>" method="post">
        <?= csrf_field() ?>
        
        <input type="hidden" name="user_id" value="<?= $session->get('id') ?>" />

        <div class="form-group" style="display: flex; justify-content:center; margin:10px 0">
            <div class="avatar"><?= substr($session->get('username'), 0, 1); ?></div>
        </div>

        <div class="form-group">
            <label for="pseudo">Pseudo </label>
            <input type="text" name="pseudo" id="pseudo" disabled class="form-control" value="<?= $session->get('username'); ?>" placeholder="renseignez votre pseudo">
        </div>

        <div class="form-group">
            <label for="email">Email </label>
            <input type="email" name="email" id="email" value="<?= $session->get('email'); ?>" class="form-control" placeholder="Email">
            <?php if ($validation->getError('email')) : ?>
                <p class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="mdp">Nouveau Mot de passe </label>
            <input type="password" name="password" id="mdp" class="form-control" placeholder="Mot de passe">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-dark" style="width: 100%;">Sauvegarder</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>