<?php
$page_title = 'Сообщения';
require_once 'partials/head.php';

require_once 'db.php';

$stmt = $pdo->query(
    'SELECT posts.body, users.name AS author_name, posts.created_at
     FROM posts
     JOIN users ON posts.author_id = users.id
     ORDER BY posts.created_at DESC'
);
$messages = $stmt->fetchAll();
?>
    <?php require 'partials/nav.php'; ?>

    <main class="container">
        <h2 class="page-title">Все посты</h2>

        <?php if (empty($messages)): ?>
            <p>Сообщений пока нет.</p>
        <?php else: ?>
            <div class="posts-list">
                <?php foreach ($messages as $msg): ?>
                    <div class="post-card">
                        <div class="post-header">
                            <span class="post-author"><?= htmlspecialchars($msg['author_name']) ?></span>
                            <span class="post-date"><?= htmlspecialchars($msg['created_at']) ?></span>
                        </div>
                        <div class="post-body">
                            <?= htmlspecialchars($msg['body']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

<?php require 'partials/foot.php'; ?>
