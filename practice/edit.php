<?php
require('config/config.php');
require('config/db.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getquery = "SELECT * FROM tasks WHERE id= ?";
    $getstmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($getstmt, $getquery)) {
        echo 'Error: ' . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($getstmt, 'i', $id);
        if (mysqli_stmt_execute($getstmt)) {
            mysqli_stmt_bind_result($getstmt, $id, $taskName, $taskDescription, $taskDate, $taskStatus);
            mysqli_stmt_fetch($getstmt);
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Error: ' . mysqli_error($conn) . '
            </div>';
        }
        mysqli_stmt_close($getstmt);
    }
    // mysqli_close($conn);
} else {
    echo '<div class="alert alert-danger" role="alert">
            Error: no task ID specified
            </div>';
}


//check if submitted
if (isset($_POST['submit'])) {
    //get value sent over
    //get form data

    $id = $_POST['id'];
    $taskName = $_POST['task_name'];
    $taskDescription = $_POST['task_description'];
    $taskDate = $_POST['task_due_date'];
    $taskStatus = $_POST['task_status'];

    //update query
    $updatequery = "UPDATE tasks SET task_name = ?, task_description = ?, task_due_date = ?, task_status = ? WHERE id = ?";

    $updatestmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($updatestmt, $updatequery)) {
        echo 'Error: ' . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($updatestmt, 'ssssi', $taskName, $taskDescription, $taskDate, $taskStatus, $id);
        if (mysqli_stmt_execute($updatestmt)) {
            echo '<div class="alert alert-success" role="alert">Task updated successfully!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Error: ' . mysqli_error($conn) . '
            </div>';
        }
        mysqli_stmt_close($updatestmt);
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
                            <h2 class="card-title">Edit Task</h2>
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
                                <input name="task_name" type="text" class="form-control" id="taskName" required value="<?php echo $taskName ?>">
                            </div>
                            <div class="form-group">
                                <label for="taskDescription">Task Description</label>
                                <textarea name="task_description" id="taskDescription" cols="30" rows="10" class="form-control" required><?php echo $taskDescription ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="taskDate">Task Due Date</label>
                                <input type="date" name="task_due_date" id="taskDate" class="form-control" required value="<?php echo $taskDate ?>">
                            </div>
                            <div class="form-group">
                                <label for="taskStatus">Task Status</label>
                                <select class="form-control" name="task_status" id="taskStatus" required>
                                    <option value="complete" <?php if ($taskStatus == 'complete') echo 'selected' ?>>Complete</option>
                                    <option value="incomplete" <?php if ($taskStatus == 'incomplete') echo 'selected' ?>>Incomplete</option>
                                    <option value="in_progress" <?php if ($taskStatus == 'in_progress') echo 'selected' ?>>In Progress</option>
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <!-- wala space lng -->

                        </div>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <button type="submit" value="Submit" name="submit" class="btn btn-info ">Save</button>

                    </form>
                </div>
            </div>

        </div>
    </main>

    <script src="../practice/assets/dist/js/bootstrap.bundle.min.js"></script><!-- js ng bootstrap optional lng to-->
</body>

</html>