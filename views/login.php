<?php
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $error = Auth::login($email, $password);

    if (!$error) {
        header('Location: /');
        exit;
    }
}

ob_start();
?>
    <h1>Вход</h1>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

    <form method="post" class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Войти</button>
    </form>
<?php
$content = ob_get_clean();
$title = 'Вход';
require __DIR__.'/layout.php';