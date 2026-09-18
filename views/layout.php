<?php
/** @var string $title */
/** @var string $content */

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title) ?> — MyBlog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="/">MyBlog</a>
        <div class="ms-auto">
            <?php if (Auth::check()): ?>
                <span class="text-light me-2"><?= htmlspecialchars(Auth::user()['username']) ?></span>
                <a href="/logout" class="btn btn-outline-light btn-sm">Выйти</a>
            <?php else: ?>
                <a href="/login" class="btn btn-outline-light btn-sm">Вход</a>
                <a href="/register" class="btn btn-light btn-sm">Регистрация</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <?= $content ?>
</div>
</body>
</html>