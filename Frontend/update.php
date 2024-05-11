<!-- <!DOCTYPE html>
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
                require_once '../Backend/User/update.php';
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id; ?>"
                method="POST">
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

</html> -->