<?php
require('config/config.php');
require('config/db.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delquery = "DELETE FROM tasks WHERE id= ?";
    $delstmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($delstmt, $delquery)) {
        echo 'Error: ' . mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($delstmt, 'i', $id);
        if (mysqli_stmt_execute($delstmt)) {

            header("location: index.php");
        } else {
            echo '<div class="alert alert-danger" role="alert">
            Error: ' . mysqli_error($conn) . '
            </div>';
        }
        mysqli_stmt_close($delstmt);
    }
    mysqli_close($conn);
} else {
    echo '<div class="alert alert-danger" role="alert">
            Error: no task ID specified
            </div>';
}
