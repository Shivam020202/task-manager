<?php
require '../config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $role = sanitize($_POST['role']);
    $job_role = sanitize($_POST['job_role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role, job_role) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $role, $job_role]);
        header("Location: ../index.php");
        exit();
    } catch (PDOException $e) {
        $error = "Email already exists!";
    }
}

include '../includes/header.php';
include '../includes/navigation.php';
?>

<div class="card mx-auto" style="max-width: 500px;">
    <div class="card-body">
        <h2 class="card-title mb-4">Register</h2>
        
        <?php if($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="admin">Admin</option>
                    <option value="team member">Team Member</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Job Role</label>
                <input type="text" name="job_role" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>