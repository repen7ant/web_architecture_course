<nav class="main-nav">
    <div class="nav-left">
        <a href="/" class="nav-brand">Boardy</a>
        <a href="/messages.php" class="nav-link">Все посты</a>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/submit.php" class="nav-link">Добавить пост</a>
        <?php endif; ?>
    </div>
    
    <div class="nav-right">
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="nav-text">Привет, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Пользователь') ?>!</span>
            <a href="/logout.php" class="nav-link">Выйти</a>
        <?php else: ?>
            <a href="/login.php" class="nav-link">Вход</a>
            <a href="/register.php" class="nav-link">Регистрация</a>
        <?php endif; ?>
    </div>
</nav>
