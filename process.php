<?php
require_once 'Task.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['create'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        $task = new Task();
        if ($task->create($title, $description, $status)) {
            header(header: 'Location: index.php?message=Task+created+successfully');
            exit();
        } else {
           header("Location: index.php?error=Failed+to+create+task");
        }
    } if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        $task = new Task();
        if ($task->update($id, $title, $description, $status)) {
            header(header: 'Location: index.php?message=Task+created+successfully');
            exit();
        } else {
           header("Location: index.php?error=Failed+to+update+task");
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $task = new Task();
    if ($task->delete($id)) {
        header(header: 'Location: index.php?message=Task+deleted+successfully');
        exit();
    } else {
       header("Location: index.php?error=Failed+to+delete+task");
    }
}
