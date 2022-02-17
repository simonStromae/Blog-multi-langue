<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Blog App</title>

    <link rel="stylesheet" href="/blog-ui/assets/css/main.css">
    <link rel="stylesheet" href="/blog-ui/assets/css/font-awesome.min.css">
</head>

<body>
    <?= $this->include('layouts/_navbar') ?>

    <section id="blog">
        <div class="blog-heading">
            <span>Blog App</span>
            <h3><?= $title_page ?></h3>
        </div>

        <?= $this->renderSection('content') ?>

    </section>

    <?= $this->include('layouts/_footer') ?>
</body>

</html>