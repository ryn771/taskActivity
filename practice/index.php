<?php
require('config/config.php');
require('config/db.php');

$query = "SELECT * FROM tasks"; //slc all from task
$result = mysqli_query($conn, $query); //connection, query
$tasks = mysqli_fetch_all($result, MYSQLI_ASSOC); //fetch 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../practice/assets/dist/css/bootstrap.min.css">
</head>

<body>
    <main>
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h2 class="card-title">Task</h2>
                            <p class="card-text">Subtitle</p>
                        </div>
                        <div class="col-auto">
                            <a class="text-end" href="add.php">
                                <button type="submit" class="btn btn-info btn-fill pull-right">Add New Task</button>
                            </a>
                        </div>
                    </div>

                </div>
                <div class="card-body table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($tasks as $task) : ?>
                                <tr>
                                    <td><?php echo $task['id']; ?></td>
                                    <td><?php echo $task['task_name']; ?></td>
                                    <td><?php echo $task['task_description']; ?></td>
                                    <td><?php echo $task['task_due_date']; ?></td>
                                    <td><?php echo $task['task_status']; ?></td>
                                    <td>
                                        <!-- edit btn and delete -->
                                        <a href="edit.php? id=<?php echo $task['id']; ?>">
                                            <button type="submit" class="btn btn-warning">Edit</button>

                                        </a>
                                        <a href="delete.php? id=<?php echo $task['id']; ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>

    <script src="../practice/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>