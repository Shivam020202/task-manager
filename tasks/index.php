<?php
require '../config.php';
if (isset($_SESSION['user'])) {
    $stmt = $pdo->prepare("
        SELECT tasks.*, 
        users_assigned.name as assigned_to_name,
        users_creator.name as assigned_by_name 
        FROM tasks
        LEFT JOIN users AS users_assigned ON tasks.assigned_to = users_assigned.id
        LEFT JOIN users AS users_creator ON tasks.assigned_by = users_creator.id
    ");
    $stmt->execute();
    $tasks = $stmt->fetchAll();
}

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

<style>
    /* Tasks Section */
    .tasks-section {
        padding: 20px 0;
    }

    .task-board {
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .task-header {
        padding: 20px;
        background: var(--light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .add-task-btn {
        padding: 10px 20px;
        background: #15599e;
        color: white;
        border-radius: 20px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .add-task-btn:hover {
        background: #0d3d6f;
    }

    .task-table {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    th {
        background: white;
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .edit-btn,
    .delete-btn {
        padding: 5px 15px;
        border-radius: 15px;
        text-decoration: none;
        color: white;
    }

    .edit-btn {
        background: gray;
    }

    .delete-btn {
        background: red;
    }

    /* Login Prompt */
    .login-prompt {
        text-align: center;
        padding: 50px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .auth-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 30px;
    }

    .login-btn,
    .register-btn {
        padding: 12px 30px;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: transform 0.3s;
    }

    .login-btn {
        background: #15599e;
        color: white;
    }

    .register-btn {
        border: 2px solid #15599e;
        color: white;
    }

    .login-btn:hover,
    .register-btn:hover {
        transform: translateY(-3px);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-content h1 {
            font-size: 2.5rem;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .task-header {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>

<!-- Tasks Section -->
<!-- Dynamic code starts -->
<div class="tasks-section">
    <div class="container">
        <h2 class="mb-4">Task Management</h2>
        <?php if (isset($_SESSION['user'])): ?>
            <div class="task-board">
                <div class="task-header">
                    <h3>Your Tasks</h3>
                    <a href="tasks/create.php?id=<?= $task['id'] ?>" class="add-task-btn">Add New Task</a>
                </div>

                <div class="task-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Task Name</th>
                                <th>Description</th>
                                <th>Assigned To</th>
                                <th>Assigned By</th>
                                <th>Created At</th>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                    <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task): ?>
                                <tr>
                                    <td><?= htmlspecialchars($task['task_name']) ?></td>
                                    <td><?= htmlspecialchars($task['description']) ?></td>
                                    <td><?= htmlspecialchars($task['assigned_to_name']) ?></td>
                                    <td><?= htmlspecialchars($task['assigned_by_name']) ?></td>
                                    <td><?= date('M d, Y h:i A', strtotime($task['created_at'])) ?></td>
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                        <td class="action-buttons">
                                            <a href="tasks/update.php?id=<?= $task['id'] ?>" class="edit-btn">Edit</a>
                                            <a href="tasks/delete.php?id=<?= $task['id'] ?>" class="delete-btn"
                                                onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="login-prompt">
                <h3>Access Task Management</h3>
                <p>Please log in or register to manage your tasks</p>
                <div class="auth-buttons">
                    <a href="auth/login.php" class="login-btn">Login</a>
                    <a href="auth/register.php" class="register-btn">Register</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<!-- Dynamic code ends -->
<?php include '../includes/footer.php'; ?>