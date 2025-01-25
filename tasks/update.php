<?php
require '../config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$task = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$task->execute([$_GET['id']]);
$task = $task->fetch();

$users = $pdo->query("SELECT id, name FROM users")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_name = sanitize($_POST['task_name']);
    $description = sanitize($_POST['description']);
    $assigned_to = sanitize($_POST['assigned_to']);

    $stmt = $pdo->prepare("UPDATE tasks SET task_name = ?, description = ?, assigned_to = ? WHERE id = ?");
    $stmt->execute([$task_name, $description, $assigned_to, $_GET['id']]);

    header("Location: ../index.php");
    exit();
}

include '../includes/header.php';
include '../includes/navigation.php';
?>

<div class="card mx-auto mt-5" style="max-width: 800px;">
    <div class="card-body">
        <h2 class="card-title mb-4">Update Task</h2>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Task Name</label>
                <input type="text" name="task_name" class="form-control" value="<?= sanitize($task['task_name']) ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"
                    rows="3"><?= sanitize($task['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Assign To</label>
                <select name="assigned_to" class="form-select" required>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user['id'] ?>" <?= $user['id'] == $task['assigned_to'] ? 'selected' : '' ?>>
                            <?= sanitize($user['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Task</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>