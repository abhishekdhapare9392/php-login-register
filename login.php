<?php 
    session_start();
    include('./header.php');


    $servername = "localhost";
    $username = "abhishek";
    $password = "123456";
    $dbname = "login-sys";

    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['confirm_password'];
        $email = $_POST['email'];
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        // echo(password_verify($password, $pass_hash));
        // exit();

        if($password == $cpassword){
            if(!empty($username) && !empty($password) && !empty($email)){
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$pass_hash')";
                $stmt = $conn->prepare($sql);
                // var_dump($stmt->errorInfo());
                if($stmt->execute()){
                    header('Location: login.php');
                } else {
                    header('Location: index.php');
                }

            } else {
                $_SESSION['error'] = "All fields are required";
                header('Location: index.php');
                // exit();

            }
        } else{
            $_SESSION['error'] = "Password and Confirm Password do not match";
            header('Location: index.php');
            // exit();
        }
    }

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!empty($username) && !empty($password)){
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($password, $result['password'])){
                $_SESSION['username'] = $username;
                header('Location: welcome.php');
            } else {
                $_SESSION['error'] = "Invalid username or password";
                header('Location: login.php');
            }
        } else {
            $_SESSION['error'] = "All fields are required";
            header('Location: login.php');
        }
    }
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Login</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 m-auto text-center">
                <?php
                    if(isset($_SESSION['error'])){
                        echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                ?>
                <form action="login.php" method="POST">
                    <div class="form-group mb-3">
                        <input type="text" name="username" class="form-control" id="username"
                            placeholder="Enter username">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" class="btn btn-primary" name="login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
    include('./footer.php')
?>