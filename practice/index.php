<?php
require('config/config.php');
require('config/db.php');
// Check if filter has been applied

$status = isset($_GET['status']) ? $_GET['status'] : 'all';

if ($status === 'all') {
    $query = "SELECT * FROM tasks"; //slc all from task


} else {
    $query = "SELECT * FROM tasks WHERE task_status = ?";
}
$stmt = mysqli_prepare($conn, $query);
if ($status !== 'all') {
    mysqli_stmt_bind_param($stmt, 's', $status);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt); //connection, query
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
                    <div class="row justify-content-between align-items-center mt-3">
                        <div class="col-auto">
                            <form>
                                <label for="filter">Filter by status:</label>
                                <select id="filter" name="status" onchange="this.form.submit()">
                                    <option value="all" <?php if ($status === 'all') echo 'selected'; ?>>All</option>
                                    <option value="complete" <?php if ($status === 'complete') echo 'selected'; ?>>Complete</option>
                                    <option value="incomplete" <?php if ($status === 'incomplete') echo 'selected'; ?>>Incomplete</option>
                                    <option value="in_progress" <?php if ($status === 'in_progress') echo 'selected'; ?>>In Progress</option>
                                </select>
                            </form>
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
    <script type="text/javascript">
        const tableRows = document.querySelectorAll('tbody tr');
        const filterDropdown = document.querySelector('#filter');

        // Add an event listener to the dropdown
        filterDropdown.addEventListener('change', filterTable);

        // Define the filter function
        function filterTable() {
            const selectedValue = filterDropdown.value;
            tableRows.forEach(row => {
                const status = row.querySelector('.status').textContent;
                if (selectedValue === 'all' || selectedValue === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>
