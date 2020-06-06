<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/inc/header.php');
?>
<?php
if (isset($_GET['delQue'])) {
    $queid = $_GET['delQue'];
    $delQue = $exm->delQuestion($queid);
}
?>

<div class="main">
    <h1>Question List</h1>

    <div class="questionlist">
        <?php
        if (isset($delQue)) {
            echo $delQue;
            unset($delQue);
        }
        ?>
        <table class="tblone">
            <tr>
                <th width="5%">No.</th>
                <th width="80%">Questions</th>
                <th>Action</th>
            </tr>
            <?php
            $getData = $exm->getQueByOrder();
            $i = 0;
            if ($getData) {
                foreach ($getData as $value) {
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value['ques']; ?></td>
                        <td>
                            <a onclick="return confirm('Are you sure to Delete')" href="?delQue=<?php echo $value['quesNo']; ?>">Delete</a>
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