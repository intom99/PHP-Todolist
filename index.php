<?php
$err = "";
//db connection
$db = mysqli_connect('localhost', 'root', '', 'todolist');

if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    if (empty($task)) {
        $err = "You must fill in the task!";
    } else {
        mysqli_query($db, "INSERT INTO tasks(task) VALUES ('$task')");
        header('location: index.php');
    }
}
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE id = $id");
    header('location: index.php');
}

$tasks = mysqli_query($db, "SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Todo list</title>
</head>

<body>
    <div class="main">
        <div class="heading">
            <h2>
                Todo list with PHP and MySQL
            </h2>
        </div>

        <div class="content">
            <div class="content-input">
                <form action="index.php" method="POST">
                    <?php if (isset($err)) { ?>
                        <p><?php echo $err ?></p>
                    <?php } ?>
                    <textarea name="task" id="" cols="30" rows="5"></textarea>
                    <button class="btn" name="submit" type="submit">Add Task</button>
                </form>
            </div>

            <div class="content-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Task</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1;
                        while ($row = mysqli_fetch_array($tasks)) { ?>

                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td class="task"><?php echo $row['task']; ?></td>
                                <td class="delete">
                                    <a href="index.php?del_task=<?php echo $row['id'] ?>">x</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>

</html>