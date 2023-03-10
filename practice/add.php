<?php
require('config/config.php');
require('config/db.php');

//check if submitted
if (isset($_POST['submit'])) {

    //get form data

    $taskName = $_POST['task_name'];
    $taskDescription = $_POST['task_description'];
    $taskDate = $_POST['task_due_date'];
    $taskStatus = $_POST['task_status'];

    //create insert query
    $query = "INSERT INTO tasks(task_name, task_description, task_due_date, task_status) VALUES (?,?,?,?)";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo 'Error: ' . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 'ssss', $taskName, $taskDescription, $taskDate, $taskStatus);
        if (mysqli_stmt_execute($stmt)) {
            echo '<div class="alert alert-success" role="alert">New task added successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Error: ' . mysqli_error($conn) . '
            </div>';
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../practice/assets/dist/css/bootstrap.min.css"><!-- bootstrap if not working remove the .. -->
</head>

<body>
    <main>
        <div class="container"> <!-- wrapper -->
            <div class="card"> <!--card class -->

                <div class="card-header"> <!--header -->
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h2 class="card-title">Add new task</h2>
                            <p class="card-text">Subtitle</p>
                        </div>
                        <div class="col-auto">
                            <a class="text-end" href="index.php">
                                <button type="submit" class="btn btn-danger">Back</button>
                            </a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                        <div class="row">
                            <div class="form-group">
                                <label for="taskName">Task Name</label>
                                <input name="task_name" type="text" class="form-control" id="taskName" required>
                            </div>
                            <div class="form-group">
                                <label for="taskDescription">Task Description</label>
                                <textarea name="task_description" id="taskDescription" cols="30" rows="10" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="taskDate">Task Due Date</label>
                                <input type="date" name="task_due_date" id="taskDate" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="taskStatus">Task Status</label>
                                <select class="form-control" name="task_status" id="taskStatus" required>
                                    <option value="complete">Complete</option>
                                    <option value="incomplete">Incomplete</option>
                                    <option value="in_progress">In Progress</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <!-- wala space lng -->

                        </div>
                        <button type="submit" value="Submit" name="submit" class="btn btn-info ">Save</button>

                    </form>
                </div>
            </div>

        </div>
    </main>

    <script src="../practice/assets/dist/js/bootstrap.bundle.min.js"></script><!-- js ng bootstrap optional lng to-->
</body>

</html>