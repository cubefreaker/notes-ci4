<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <?= $this->renderSection('content') ?>

    <script>
    <?php if (session('success')) : ?>
        alert('<?= session('success') ?>');
    <?php endif ?>

    <?php if (session('error')) : ?>
        alert('<?= session('error') ?>');
    <?php endif ?>

    <?php if (session('errors')) : ?>
        <?php if (is_array(session('errors'))): ?>
            <?php foreach (session('errors') as $error): ?>
                alert('<?= $error ?>');
                <?php break; ?>
            <?php endforeach ?>
        <?php else : ?>
            alert('<?= session('errors') ?>');
        <?php endif ?>
    <?php endif ?>
    </script>
</body>
</html>