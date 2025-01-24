<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Task Manager</a>
        <div class="navbar-nav">
            <?php if(isset($_SESSION['user'])): ?>
                <span class="navbar-text me-3">Welcome, <?= sanitize($_SESSION['user']['name']) ?></span>
                <a class="nav-link" href="auth/logout.php">Logout</a>
            <?php else: ?>
               <a class="nav-link" href="../auth/login.php">Login</a>
<a class="nav-link" href="../auth/register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>