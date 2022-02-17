<?= $this->extend('layouts/master-auth') ?>

<?= $this->section('content') ?>

<?php $validation =  \Config\Services::validation(); ?>

<div class="sign-container">
    <div class="blog-heading">
        <span>Blog App</span>
        <h3>Se Connecter</h3>
    </div>

    <?php if (session()->getFlashdata('message') !== NULL) : ?>
        <p class="alert-<?= session()->getFlashdata('messageType'); ?>">
            <?= session()->getFlashdata('message'); ?>
        </p>
    <?php endif; ?>

    <form action="<?= route_to('login_user') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control">

            <?php if ($validation->getError('email')) : ?>
                <p class="invalid-feedback">
                    <?= $validation->getError('email') ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="pwd">Mot de passe</label>
            <input type="password" name="password" id="pwd" class="form-control">

            <?php if ($validation->getError('password')) : ?>
                <p class="invalid-feedback">
                    <?= $validation->getError('password') ?>
                </p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-dark" style="width: 100%;">Se Connecter</button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>