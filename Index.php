<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .form-container { margin-bottom: 20px; }
        .message { 
            padding: 10px; 
            margin-bottom: 15px; 
            border-radius: 4px; 
        }
        .success { 
            background-color: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb;
        }
        .error { 
            background-color: #f8d7da; 
            color: #721c24; 
            border: 1px solid #f5c6cb;
        }
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
    <h2>Task Manager</h2>

    <!-- Display messages -->
    <?php if (isset($_GET['message'])): ?>
        <div class="message success">
            <?php echo htmlspecialchars($_GET['message']); ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($_GET['error'])): ?>
        <div class="message error">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Create Task Form -->
    <div class="form-container">
        <h3>Add New Task</h3>
        <form action="process.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" placeholder="Task Title" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" placeholder="Task Description"></textarea>
            
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
            
            <button type="submit" name="create">Add Task</button>
        </form>
    </div>

    <!-- Display Tasks -->
    <h3>Task List</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php
        require_once 'Task.php';
        $task = new Task();
        $tasks = $task->readAll();
        
        if (count($tasks) > 0):
            foreach ($tasks as $t):
        ?>
            <tr>
                <td><?php echo $t['id']; ?></td>
                <td><?php echo htmlspecialchars($t['title']); ?></td>
                <td><?php echo htmlspecialchars($t['description']); ?></td>
                <td><?php echo ucfirst($t['status']); ?></td>
                <td>
                    <a href='edit.php?id=<?php echo $t['id']; ?>'>Edit</a> |
                    <a href='process.php?delete=<?php echo $t['id']; ?>' onclick='return confirm("Are you sure?")'>Delete</a>
                </td>
            </tr>
        <?php 
            endforeach;
        else:
        ?>
            <tr>
                <td colspan="5" style="text-align: center;">No tasks found. Add a new task!</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>