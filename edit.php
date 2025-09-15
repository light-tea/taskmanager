<?php
// edit.php
require_once 'Task.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$taskObj = new Task();
$task = $taskObj->readOne($_GET['id']);

if (!$task) {
    header("Location: index.php?error=Task+not+found");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 500px; }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Edit Task</h2>
    
    <div class="form-container">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
            
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pending" <?php echo $task['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="completed" <?php echo $task['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
            </select>
            
            <button type="submit" name="update">Update Task</button>
            <a href="index.php">Cancel</a>
        </form>
    </div>
</body>
</html>