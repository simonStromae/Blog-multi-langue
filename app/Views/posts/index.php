<?= $this->extend('layouts/master') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('message') !== NULL) : ?>
    <p class="alert-<?= session()->getFlashdata('messageType'); ?>">
        <?= session()->getFlashdata('message'); ?>
    </p>
<?php endif; ?>

<div class="blog-container">
    <?php foreach ($posts as $key => $post) : ?>
        <div class="blog-box">
            <div class="blog-img">
                <img src="/blog-ui/assets/img/img_h_<?= $key + 1 ?>.jpg" alt="">
            </div>

            <div class="blog-text">
                <span><?= $post->updated_at ?></span>
                <a href="<?= route_to('details_post', $post->id, $lang) ?>" class="blog-title"><?= $post->title ?></a>
                <p>
                    <?= $post->text ?>
                </p>

                <div style="display: flex; align-items:center; justify-content: space-between">
                    <a href="<?= route_to('details_post', $post->id, $lang) ?>"><?= $more ?></a>

                    <form action="<?= route_to('delete_post', $post->id) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE" />

                        <a class="btn-circle-warning" href="<?= route_to('edit_post', $post->id) ?>"><i class="fa fa-edit"></i></a>
                        <button style="background-color: transparent; border:none; cursor:pointer" type="submit" class="btn-circle-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>