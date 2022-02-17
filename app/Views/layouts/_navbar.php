<?php $session = \Config\Services::session(); ?>

<nav>
    <div>
        <ul class="lang">
            <li><a href="<?= route_to('posts', "fr") ?>"><img src="/blog-ui/assets/img/lang/fr.png" alt="fr"></a></li>
            <li><a href="<?= route_to('posts', "es") ?>"><img src="/blog-ui/assets/img/lang/esp.png" alt="esp"></a></li>
            <li><a href="<?= route_to('posts', "ja") ?>"><img src="/blog-ui/assets/img/lang/jap.png" alt="jap"></a></li>
            <li><a href="<?= route_to('posts', "de") ?>"><img src="/blog-ui/assets/img/lang/de.png" alt="de"></a></li>
            <li><a href="<?= route_to('posts', "en") ?>"><img src="/blog-ui/assets/img/lang/en.png" alt="en"></a></li>
        </ul>
    </div>

    <div style="display:flex; align-items:center">
        <a href="<?= route_to('add_post') ?>" class="btn btn-secondary" style="margin-right: 55px;">Ajouter un article</a>

        <?php if ($session->get('loggedIn') !== NULL) : ?>

            <a href="<?= route_to('profile') ?>" style="margin-right: 15px;">
                <span class="small-avatar"><?= substr($session->get('username'), 0, 1); ?></span>
            </a>
            <a href="<?= route_to('logout') ?>">Se Déconnecter</a>
        <?php else : ?>

            <a href="<?= route_to('login') ?>" class="btn btn-primary" style="margin-right: 15px;">Se Connecter</a>

            <a href="<?= route_to('register') ?>" class="btn btn-dark">S'inscrire</a>

        <?php endif; ?>
    </div>

</nav>