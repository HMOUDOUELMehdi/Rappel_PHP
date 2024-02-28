<?php 
session_start();

include_once "connect.php";

$registerSuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $dbo = new Database();

    if (!empty($name) && !empty($email) && !empty($password)) {

        $cmd = "INSERT INTO users
            (name, email, password)
        VALUES
            (:name, :email, :password)";

        $statement = $dbo->connect->prepare($cmd);

        try {
            $statement->execute([
                ":name" => $name,
                ":email" => $email,
                ":password" => $password,
            ]);

            $registerSuccess = "register Success";
        } catch (Exception $t) {
            $registerSuccess = "Registration failed. Please try again.";
        }      
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="bootstrap.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Register</h2>
                        <?php if ($registerSuccess): ?>
                            <div class="alert alert-primary"><?php echo $registerSuccess; ?></div>
                        <?php endif; ?>
                        <form  method="post" >
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                                <label >Email address:</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>

                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <a href="login.php">login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>