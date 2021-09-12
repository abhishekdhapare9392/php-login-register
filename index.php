<?php 
session_start();

    include('./header.php')
?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1>Register</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 m-auto text-center">
                <div class="card card-body shadow-lg rounded">
                    <?php
                    // var_dump($_SESSION);
                        if(isset($_SESSION['error'])){
                            echo '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
                            unset($_SESSION['error']);
                        }
                    ?>
                    <form action="login.php" method="POST">
                        <div class="form-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="confirm_password" class="form-control"
                                placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" class="btn btn-primary btn-block" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    include('./footer.php')
?>