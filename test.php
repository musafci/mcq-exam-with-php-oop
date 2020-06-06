<?php include 'inc/header.php'; ?>

<?php
Session::checkSession();
if (isset($_GET['q'])) {
    $qnumber = (INT) $_GET['q'];
} else {
    header("Location:exam.php");
}
$total = $exm->getTotalQuestion();
$question = $exm->getQuesByNumber($qnumber);
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $process = $pro->processData($_POST);
}
?>
<div class="main">
    <h1>Question <?php echo $question['quesNo']; ?> of <?php echo $total; ?></h1>
    <div class="test">
        <form method="post" action="">
            <table> 
                <tr>
                    <td colspan="2">
                        <h3>Que <?php echo $question['quesNo']; ?>: <?php echo $question['ques']; ?></h3>
                    </td>
                </tr>
                <?php
                $answer = $exm->getAnswer($qnumber);
                if ($answer) {
                    foreach ($answer as $value) {
                        ?>
                        <tr>
                            <td>
                                <input value="<?php echo $value['id']; ?>" type="radio" name="ans"/><?php echo $value['ans']; ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>


                <tr>
                    <td>
                        <input type="submit" name="submit" value="Next Question"/>
                        <input type="hidden" name="number" value="<?php echo $qnumber; ?>"/>
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php include 'inc/footer.php'; ?>