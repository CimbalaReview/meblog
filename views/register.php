<?php
$errors = [];
$old = ['username' => '', 'email' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $errors = Auth::register($username, $email, $password);

    if (!$errors) {
        header('Location: /');
        exit;
    }

    $old = ['username' => $username, 'email' => $email];
}

ob_start();
?>
    <h1>Регистрация</h1>

<?php foreach ($errors as $e): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($e) ?></div>
<?php endforeach; ?>

    <form method="post" class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Имя пользователя</label>
            <input type="text" name="username" class="form-control"
                   value="<?= htmlspecialchars($old['username']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   value="<?= htmlspecialchars($old['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Зарегистрироваться</button>
    </form>
<?php
$content = ob_get_clean();
$title = 'Регистрация';
require __DIR__ .'/layout.php';