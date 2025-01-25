<nav class="navbar navbar-expand-lg navbar-dark  glass-navbar">
    <div class="container-fluid">
        <!-- Stylish Logo -->
        <a class="navbar-brand logo-text" href="index.php">
            <i class="bi bi-mortarboard-fill me-2"></i>
            Learn Academy
        </a>

        <!-- Navigation Items -->
        <div class="navbar-nav flex-row gap-lg-4 gap-2">
            <?php if (isset($_SESSION['user'])): ?>
                <!-- User Badge -->
                <div class="d-flex align-items-center me-3">
                    <span class="user-greeting">
                        <i class="bi bi-person-circle me-2"></i>
                        <?= sanitize($_SESSION['user']['name']) ?>
                    </span>
                </div>

                <!-- Navigation Links -->
                <div class="d-flex gap-lg-3 gap-2">
                    <a class="nav-link hover-underline" href="tasks">
                        <i class="bi bi-list-task me-1"></i>
                        Tasks
                    </a>
                    <a class="nav-link hover-underline" href="auth/logout.php">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        Logout
                    </a>
                </div>
            <?php else: ?>
                <!-- Auth Links -->
                <a class="nav-link auth-link" href="../auth/login.php">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    Login
                </a>
                <a class="nav-link auth-link" href="../auth/register.php">
                    <i class="bi bi-person-plus me-1"></i>
                    Register
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<style>
    .glass-navbar {
        background: linear-gradient(135deg, rgba(20, 30, 48, 0.95) 0%, rgba(36, 59, 85, 0.95) 100%);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .logo-text {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.5rem;
        background: linear-gradient(45deg, #00b4d8, #90e0ef);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        letter-spacing: -0.5px;
        transition: all 0.3s ease;
    }

    .logo-text:hover {
        transform: scale(1.02);
        text-shadow: 0 0 15px rgba(144, 224, 239, 0.3);
    }

    .nav-link {
        color: rgba(255, 255, 255, 0.9) !important;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .hover-underline::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: #90e0ef;
        transition: width 0.3s ease;
    }

    .hover-underline:hover::after {
        width: 100%;
    }

    .user-greeting {
        color: rgba(255, 255, 255, 0.9);
        background: rgba(255, 255, 255, 0.1);
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .auth-link {
        padding: 0.5rem 1.2rem !important;
        border-radius: 50px;
        transition: all 0.3s ease !important;
    }

    .auth-link:hover {
        background: rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }

    .navbar-nav {
        align-items: center;
    }

    .bi-mortarboard-fill {
        font-size: 1.8rem;
        background: linear-gradient(45deg, #00b4d8, #90e0ef);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>