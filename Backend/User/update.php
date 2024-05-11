<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="border mt-5 container">
        <div class="container-md">
            <?php
            require_once "../config.php";

            $DB = connect_to_database();

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
                } else {
                    echo "<div class='alert alert-danger' role='alert'>User not found</div>";
                  
                    exit(); // Exit the script if user not found
                }
            } else {
                echo "<div class='alert alert-danger' role='alert'>ID not provided</div>";
                exit(); // Exit the script if ID not provided
            }

            // Check if form is submitted
            if (isset($_POST["save"])) {
                // Retrieve updated values from the form
                $newName = $_POST['name'];
                $newUsername = $_POST['username'];
                $newEmail = $_POST['email'];
                $newPassword = $_POST['password'];

                // Prepare and execute the UPDATE query
                $sql_update = "UPDATE user SET name = ?, username = ?, email = ?, password = ? WHERE id = ?";
                $stmt = $DB->prepare($sql_update);
                $stmt->bind_param("ssssi", $newName, $newUsername, $newEmail, $newPassword, $id);
                $success = $stmt->execute();

                // Check if the query was successful
                if ($success) {
                    echo "<div class='alert alert-success' role='alert'>Record updated successfully</div>";
                    header("Location:../../Frontend/table.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Error updating record: " . $DB->error . "</div>";
                }
            }

            // Close the prepared statement
            $stmt->close();

            // Close the database connection
            $DB->close();
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>" method="POST">
                <div class="mb-3 mt-5">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" id="name" class="form-control" name="name" placeholder="Enter your name"
                        value="<?php echo $name; ?>">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" placeholder="Enter your username" name="username"
                        id="username" value="<?php echo $username; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Enter your email" id="email" name="email"
                        value="<?php echo $email; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password"
                        value="<?php echo $password; ?>">
                </div>
                <input type="submit" value="Update" class="btn btn-info mb-3 px-5" name="save">
            </form>
        </div>
    </div>
</body>

</html>
