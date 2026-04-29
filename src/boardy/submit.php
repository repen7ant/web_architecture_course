<?php
$page_title = 'Новый пост';
require_once 'partials/head.php';

if (empty($_SESSION['user_id'])) {
    header('Location: /login.php');
    exit;
}

require_once 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = trim($_POST['message'] ?? '');

    if (empty($message)) {
        $error = 'Сообщение не может быть пустым.';
    } else {
        $stmt = $pdo->prepare(
            'INSERT INTO posts (title, body, author_id) VALUES (?, ?, ?)'
        );
        $stmt->execute(['Сообщение', $message, $_SESSION['user_id']]);

        header('Location: /messages.php');
        exit;
    }
}
?>
    <?php require 'partials/nav.php'; ?>

    <main class="auth-container">
        <div class="auth-card" style="max-width: 600px;">
            <h2 class="auth-title">Новый пост</h2>

            <?php if ($error): ?>
                <div style="color: #c34043; background: rgba(195, 64, 67, 0.1); padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="/submit.php" method="POST">
                <label for="message">Текст</label>
                <textarea id="message" name="message" rows="6" required
                          placeholder="Напишите ваше объявление..."></textarea>

                <div style="display: flex; align-items: center; gap: 15px; margin-top: 20px;">
                    <button type="submit" style="margin-top: 0;">Опубликовать</button>
                    <a href="/messages.php" style="color: #174c6d; font-size: 14px;">Отмена</a>
                </div>
            </form>
        </div>
    </main>

<?php require 'partials/foot.php'; ?>
