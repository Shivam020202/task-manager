<?php
require '../config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: ../index.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}

include '../includes/header.php';
include '../includes/navigation.php';
?>
<div class="min-vh-100 d-flex align-items-center justify-content-center">
<div class="card mx-auto auth-card " style="max-width: 500px; min-width: 350px; width: 100%;">
    <div class="card-body p-lg-5 p-4">
        <!-- Decorative Header Section -->
        <div class="text-center mb-5">
            <div class="icon-wrapper mb-4">
                <div class="auth-icon">
                    <i class="bi bi-person-circle"></i>
                </div>
            </div>
            <h2 class="card-title mb-3 auth-title">Account Login</h2>
            <p class="text-muted opacity-75">Secure access to your dashboard</p>
        </div>

        <?php if($error): ?>
            <div class="alert alert-custom alert-danger mb-4" role="alert">
                <i class="bi bi-shield-exclamation me-2"></i><?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="auth-form">
            <!-- Email Input -->
            <div class="mb-3 form-floating">
                <input type="email" name="email" 
                       class="form-control input-modern" 
                       id="emailInput" 
                       placeholder="name@example.com"
                       required>
                <label for="emailInput" class="form-label-float">Email address</label>
                <div class="input-decoration"></div>
            </div>

            <!-- Password Input -->
            <div class="mb-4 form-floating">
                <input type="password" name="password" 
                       class="form-control input-modern" 
                       id="passwordInput" 
                       placeholder="Password"
                       required>
                <label for="passwordInput" class="form-label-float">Password</label>
                <div class="input-decoration"></div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 login-btn">
                <span class="btn-text">Continue to Account</span>
                <i class="bi bi-chevron-right btn-icon"></i>
            </button>
        </form>

        <!-- Helper Links -->
        <div class="text-center mt-4">
            <a href="#forgot-password" class="link-helper">
                <i class="bi bi-key me-1"></i>Recover account access
            </a>
        </div>
    </div>
</div>
</div>
<?php include '../includes/footer.php'; ?>