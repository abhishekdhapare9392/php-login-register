<?php 
session_start();

    include('./header.php');
?>

<section class="section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="display-4">Welcome to our website</h1>
                <?php
                    if(isset($_SESSION['username'])){
                        echo '<p class="lead">You are logged in as '.$_SESSION['username'].'</p>';
                    }
                ?>
            </div>
        </div>
    </div>
</section>

<?php 
    include('./footer.php');
?>