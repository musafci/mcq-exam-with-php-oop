<?php include 'inc/header.php'; ?>

<?php
Session::checkSession();
$total = $exm->getTotalQuestion();
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $process = $pro->processData($_POST);
}
?>
<div class="main">
    <h1>All Answer & Question of <?php echo $total; ?></h1>
    <div class="test">
        <table>
            <?php
            $getQues = $exm->getQueByOrder();
            if ($getQues) {
                foreach ($getQues as $value) {
                    ?>
                    <tr>
                        <td colspan="2">
                            <h3>Que <?php echo $value['quesNo']; ?>: <?php echo $value['ques']; ?></h3>
                        </td>
                    </tr>
                    <?php
                    $qnumber = $value['quesNo'];
                    $answer = $exm->getAnswer($qnumber);
                    if ($answer) {
                        foreach ($answer as $value) {
                            ?>
                            <tr>
                                <td>
                                    <input type="radio"/>
                                    <?php
                                    if ($value['rightAns'] == '1') {
                                        echo "<span style='color:green'>" . $value['ans'] . "</span>";
                                    } else {
                                        echo $value['ans'];
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
            }
            ?>

        </table>
    </div>
</div>
<?php include 'inc/footer.php'; ?>