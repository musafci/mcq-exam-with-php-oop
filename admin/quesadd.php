<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/inc/header.php');
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addQue = $exm->addQuestions($_POST);
}


//Get Total Questions
$total = $exm->getTotalQuestion();
$next = $total + 1;
?>

<style>
    .adminpanel{border: 1px  solid #DDD;padding: 10px;}
</style>
<div class="main">
    <h1>Question Add</h1>
    <div class="adminpanel">
        <?php
        if (isset($addQue)) {
            echo $addQue;
            unset($addQue);
        }
        ?>
        <form action="" method="post">
            <table>
                <tr>
                    <td>Question No</td>
                    <td>:</td>
                    <td><input type="number" value="<?php
                        if (isset($next)) {
                            echo $next;
                        }
                        ?>" name="quesNo"></td>
                </tr>

                <tr>
                    <td>Question</td>
                    <td>:</td>
                    <td><input type="text" name="ques" placeholder="Enter question...." required=""></td>
                </tr>

                <tr>
                    <td>Choice One</td>
                    <td>:</td>
                    <td><input type="text" name="ans1" placeholder="Enter Choice One...." required=""></td>
                </tr>

                <tr>
                    <td>Choice Two</td>
                    <td>:</td>
                    <td><input type="text" name="ans2" placeholder="Enter Choice Two...." required=""></td>
                </tr>

                <tr>
                    <td>Choice Three</td>
                    <td>:</td>
                    <td><input type="text" name="ans3" placeholder="Enter Choice Three...." required=""></td>
                </tr>

                <tr>
                    <td>Choice Four</td>
                    <td>:</td>
                    <td><input type="text" name="ans4" placeholder="Enter Choice Four...." required=""></td>
                </tr>

                <tr>
                    <td>Correct No</td>
                    <td>:</td>
                    <td><input type="number" name="rightAns" required=""></td>
                </tr>

                <tr>
                    <td colspan="3" align="center">
                        <input type="submit" value="Add A Question">
                    </td>
                </tr>

            </table>
        </form>
    </div>



</div>
<?php
