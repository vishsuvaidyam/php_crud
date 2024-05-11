<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="border mt-5 container">
        <div class="container-md">
            <?php
            require_once "../config.php";

            $DB = connect_to_database();

            // Check if the ID is provided in the URL
            $id = isset($_GET['id']) ? $_GET['id'] : null;

            if ($id !== null) {
                // Fetch user information based on the provided ID
                $query = "SELECT * FROM user WHERE id = ?";
                $stmt = $DB->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if the user exists
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $name = $row['name'];
                    $username = $row['username'];
                    $email = $row['email'];
                    $password = $row['password'];

                    // Check if form is submitted for deletion
                    if (isset($_POST["delete"])) {
                        // Prepare and execute the DELETE query
                        $sql_delete = "DELETE FROM user WHERE id = ?";
                        $stmt_delete = $DB->prepare($sql_delete);
                        $stmt_delete->bind_param("i", $id);
                        $success = $stmt_delete->execute();

                      // Check if the query was successful
                        if ($success) {
                            echo "<div class='alert alert-success' role='alert'>Record deleted successfully</div>";
                            header("Location:../../Frontend/table.php");
                            exit();
                        } else {
                            echo "<div class='alert alert-danger' role='alert'>Error deleting record: " . $DB->error . "</div>";
                        }

                        // Close the prepared statement
                        $stmt_delete->close();
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>User not found</div>";
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                echo "<div class='alert alert-danger' role='alert'>ID not provided</div>";
            }

            // Close the database connection
            $DB->close();
            ?>

            <!-- Display user information -->
            <h2>User Information</h2>
            <p>Name: <?php echo $name; ?></p>
            <p>Username: <?php echo $username; ?></p>
            <p>Email: <?php echo $email; ?></p>
            <p>Password: <?php echo $password; ?></p>

            <!-- Confirmation form for deletion -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
                <input type="submit" value="Delete" class="btn btn-danger" name="delete">
            </form>
        </div>
    </div>
</body>

</html>
