<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
$userid = Session::get('userid');
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updateuser = $usr->updateUserData($userid, $_POST);
}
?>
<style>
    .profile{border: 1px solid #DDD;padding: 10px; width: 550px;margin: 0px auto;}
</style>
<div class="main">
    <h1>Online Exam System - User Profile</h1>

    <div class="profile">
        <?php
        if (isset($updateuser)) {
            echo $updateuser;
            unset($updateuser);
        }
        ?>
        <form action="" method="post">
            <?php
            $getdata = $usr->getUserData($userid);
            if ($getdata) {
                $data = $getdata->fetch_assoc();
                ?>
                <table class="tbl">    
                    <tr>
                        <td>Name</td>
                        <td><input name="name" value="<?php echo $data['name']; ?>" type="text"></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td><input name="username" value="<?php echo $data['username']; ?>" type="text"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input name="email" value="<?php echo $data['email']; ?>" type="text"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Update">
                        </td>
                    </tr>
                </table>
            <?php } ?>
        </form>
    </div>
</div>
<?php include 'inc/footer.php'; ?>