<?php
require_once 'partials/head.php';

require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Пожалуйста, заполните все поля.';
    } else {
        $stmt = $pdo->prepare('SELECT id, name, password_hash FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            header('Location: /messages.php');
            exit;
        } else {
            $error = 'Неверный email или пароль.';
        }
    }
}

$page_title = 'Вход';
?>
    <?php require 'partials/nav.php'; ?>

    <main class="auth-container">
        <div class="auth-card">
            <h2 class="auth-title">Вход</h2>

            <?php if ($error): ?>
                <div style="color: #c34043; background: rgba(195, 64, 67, 0.1); padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/login.php" method="POST">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Введите почту"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required placeholder="Введите пароль">

                <button type="submit" class="btn-full">Войти</button>
            </form>

            <div class="auth-footer">
                Нет аккаунта? <a href="/register.php">Регистрация</a>
            </div>
        </div>
    </main>

<?php require 'partials/foot.php'; ?>
