<?php
require 'config.php';
include 'includes/header.php';
include 'includes/navigation.php';

// Fetch tasks based on user role
$tasks = [];
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['role'] === 'admin') {
        $tasks = $pdo->query("
            SELECT tasks.*, 
                   u.name as assigned_to_name, 
                   u2.name as assigned_by_name 
            FROM tasks 
            JOIN users u ON tasks.assigned_to = u.id
            JOIN users u2 ON tasks.assigned_by = u2.id
        ")->fetchAll();
    } else {
        $stmt = $pdo->prepare("
            SELECT tasks.*, 
                   u.name as assigned_to_name, 
                   u2.name as assigned_by_name 
            FROM tasks 
            JOIN users u ON tasks.assigned_to = u.id
            JOIN users u2 ON tasks.assigned_by = u2.id
            WHERE assigned_to = ?
        ");
        $stmt->execute([$_SESSION['user']['id']]);
        $tasks = $stmt->fetchAll();
    }
}
?>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Task Board</h2>
            <?php if(isset($_SESSION['user'])): ?>
                <a href="tasks/create.php" class="btn btn-primary">Create New Task</a>
            <?php endif; ?>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Assigned To</th>
                        <th>Assigned By</th>
                        <th>Created At</th>
                        <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                            <th>Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tasks as $task): ?>
                        <tr>
                            <td><?= sanitize($task['task_name']) ?></td>
                            <td><?= sanitize($task['description']) ?></td>
                            <td><?= sanitize($task['assigned_to_name']) ?></td>
                            <td><?= sanitize($task['assigned_by_name']) ?></td>
                            <td><?= date('M d, Y h:i A', strtotime($task['created_at'])) ?></td>
                            <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                <td>
                                    <a href="tasks/update.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="tasks/delete.php?id=<?= $task['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>