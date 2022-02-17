<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Blog App</title>

    <link rel="stylesheet" href="/blog-ui/assets/css/main.css">
</head>

<body style="background: linear-gradient(90deg, rgba(238,174,202,1) 0%, rgba(148,187,233,1) 100%);">
    
    <?= $this->include('layouts/_navbar') ?>

    <section id="sign">

        <?= $this->renderSection('content') ?>
    
    </section>

    <?= $this->include('layouts/_footer') ?>

</body>

</html>