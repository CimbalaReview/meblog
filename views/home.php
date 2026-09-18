<?php
ob_start();
?>
    <h1>Добро пожаловать в MyBlog</h1>

<?php if (Auth::check()): ?>
    <p>Вы вошли как <strong><?= htmlspecialchars(Auth::user()['username']) ?></strong>.</p>
    <p>Скоро здесь появятся статьи.</p>
<?php else: ?>
    <p>Чтобы писать статьи и комментарии, пожалуйста, <a href="/register">зарегистрируйтесь</a> или <a href="/login">войдите</a>.</p>
<?php endif; ?>
<?php
$content = ob_get_clean();
$title = 'Главная';
require __DIR__ .'/layout.php';