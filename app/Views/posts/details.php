<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<div class="blog-container">
    <div class="blog-box-details">
        <div class="blog-img">
            <img src="assets/img/img_h_1.jpg" alt="">
        </div>

        <div class="blog-text">
            <span><?= $post->updated_at ?></span>
            <span class="blog-title-details"><?= $post->title ?></span>
            <p>
                <?= $post->text ?>
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>