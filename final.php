<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
?>
<style>
    .starttest{width:550px;border: 1px solid #000;padding: 10px;text-align: center;margin: 0px auto;}
</style>
<div class="main">
    <h1>You are Done</h1>
    <div class="starttest">
        <h2>Congrats............!</h2>
        <p style="padding: 15px 0px;"><strong>Final Score:</strong>
            <?php
            if (isset($_SESSION['score'])) {
                echo $_SESSION['score'];
                unset($_SESSION['score']);
            }
            ?>
        </p>

        <a href="viewans.php">View Answer</a>
        <a href="starttest.php">Start Again</a>
    </div>


</div>
<?php include 'inc/footer.php'; ?>