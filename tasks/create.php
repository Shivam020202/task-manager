<?php
require '../config.php';

if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$users = [];
if ($_SESSION['user']['role'] === 'admin') {
    $users = $pdo->query("SELECT id, name FROM users")->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = sanitize($_POST['task_name']);
    $description = sanitize($_POST['description']);
    $assigned_to = ($_SESSION['user']['role'] === 'admin') ? $_POST['assigned_to'] : $_SESSION['user']['id'];

    $stmt = $pdo->prepare("INSERT INTO tasks (task_name, description, assigned_to, assigned_by) VALUES (?, ?, ?, ?)");
    $stmt->execute([$task_name, $description, $assigned_to, $_SESSION['user']['id']]);

    header("Location: ../index.php");
    exit();
}

include '../includes/header.php';
include '../includes/navigation.php';
?>

<div class="card mx-auto mt-5" style="max-width: 800px;">
    <div class="card-body">
        <h2 class="card-title mb-4">Create New Task</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Task Name</label>
                <input type="text" name="task_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <div class="mb-3">
                    <label class="form-label">Assign To</label>
                    <select name="assigned_to" class="form-select" required>
                        <?php foreach ($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= sanitize($user['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>