<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/inc/header.php');
?>
<?php
if (isset($_GET['dis'])) {
    $disid = (int) $_GET['dis'];
    $disUser = $usr->disableUser($disid);
}
?>

<?php
if (isset($_GET['ena'])) {
    $enaid = (int) $_GET['ena'];
    $enaUser = $usr->enableUser($enaid);
}
?>

<?php
if (isset($_GET['del'])) {
    $delid = (int) $_GET['del'];
    $delUser = $usr->deleteUser($delid);
}
?>

<div class="main">
    <h1>All user</h1>
    <div class="manageuser">
        <?php
        if (isset($disUser)) {
            echo $disUser;
            unset($disUser);
        }

        if (isset($enaUser)) {
            echo $enaUser;
            unset($enaUser);
        }


        if (isset($delUser)) {
            echo $delUser;
            unset($delUser);
        }
        ?>
        <table class="tblone">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            $userdata = $usr->getAllUser();
            $i = 0;
            if ($userdata) {
                foreach ($userdata as $value) {
                    $i++;
                    ?>
                    <tr>
                        <td>
                            <?php
                            if ($value['status'] == '1') {
                                echo "<span class='error'>" . $i . "</span>";
                            } else {
                                echo $i;
                            }
                            ?>
                        </td>
                        <td><?php echo $value['name']; ?></td>
                        <td><?php echo $value['username']; ?></td>
                        <td><?php echo $value['email']; ?></td>
                        <td>
                            <?php
                            if ($value['status'] == '0') {
                                ?>
                                <a onclick="return confirm('Are you sure to Disable')" href="?dis=<?php echo $value['userId']; ?>">Disable</a>
                            <?php } else {
                                ?>
                                <a onclick="return confirm('Are you sure to Enable')" href="?ena=<?php echo $value['userId']; ?>">Enable</a>
                            <?php } ?>
                            || <a onclick="return confirm('Are you sure to Remove')" href="?del=<?php echo $value['userId']; ?>">Remove</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>




</div>
<?php include 'inc/footer.php'; ?>