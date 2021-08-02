<?php
$db = mysqli_connect('localhost', 'root', '', 'todolist');

if (isset($_POST['submit'])) {
    $task = $_POST['task'];

    mysqli_query($db, "INSERT INTO tasks(task) VALUES ('$task')");
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
    <link rel="stylesheet" href="style.css">
    <title>Todo list</title>
</head>

<body>
    <div class="main">
        <div class="heading">
            <h2>
                Todo list with PHP and MySQL
            </h2>
        </div>

        <div class="content-input">
            <form action="index.php" method="POST">
                <input type="text" class="" name="task">
                <button class="btn" name="submit" type="submit">Add Task</button>
            </form>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = mysqli_fetch_array($tasks)) { ?>

                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td class="task"><?php echo $row['task']; ?></td>
                            <td class="delete">
                                <a href="#">x</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>



    </div>
</body>

</html>