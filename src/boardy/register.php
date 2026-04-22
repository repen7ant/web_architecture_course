<?php
require_once 'partials/head.php';

require_once 'db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        $error = 'Пожалуйста, заполните все поля.';
    } elseif (mb_strlen($password) < 6) {
        $error = 'Пароль должен быть не менее 6 символов.';
    } else {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $error = 'Пользователь с таким email уже зарегистрирован.';
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $pdo->prepare(
                'INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)'
            );
            $stmt->execute([$name, $email, $password_hash]);
            $new_user_id = $pdo->lastInsertId();

            $_SESSION['user_id']   = $new_user_id;
            $_SESSION['user_name'] = $name;

            header('Location: /messages.php');
            exit;
        }
    }
}

$page_title = 'Регистрация';
?>
    <?php require 'partials/nav.php'; ?>

    <main class="auth-container">
        <div class="auth-card">
            <h2 class="auth-title">Регистрация</h2>

            <?php if ($error): ?>
                <div style="color: #c34043; background: rgba(195, 64, 67, 0.1); padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/register.php" method="POST">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" required placeholder="Введите имя"
                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Введите почту"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">

                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required placeholder="Введите пароль">

                <button type="submit" class="btn-full">Зарегистрироваться</button>
            </form>

            <div class="auth-footer">
                Уже есть аккаунт? <a href="/login.php">Войти</a>
            </div>
        </div>
    </main>

<?php require 'partials/foot.php'; ?>
