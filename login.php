<?php 
session_start();
$_SESSION['loginSuccess'] = '';

include_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $loginBtn = $_POST["login"];
    
    $dbo = new Database();

    if (isset($loginBtn)) {

    $cmd = "SELECT * FROM users WHERE email = :email AND password = :password ";
    
    $statement = $dbo->connect->prepare($cmd);
    $statement->execute([':email' => $email,':password'=>$password]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['loginSuccess'] = true;
        header("Location: acceuil.php");
        exit();
    }else{
        $_SESSION['loginSuccess'] = false;        
    }

}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="bootstrap.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login</h2>
                        <?php if($_SESSION['loginSuccess'] === false): ?>
                            <div class="alert alert-danger">Login failed. Please try again.</div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="form-group">
                                <label>Email address:</label>
                                <input type="email" class="form-control"  name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" class="form-control" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block" name="login" >Login</button>
                            <a href="register.php">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
