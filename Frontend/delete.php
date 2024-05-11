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
                require_once '../Backend/User/delete.php';
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