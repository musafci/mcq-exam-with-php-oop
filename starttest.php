<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
?>
<?php
$question = $exm->getQuestion();
$total = $exm->getTotalQuestion();
?>


<style>
    .starttest{width:550px;border: 1px solid #000;padding: 10px;text-align: center;margin: 0px auto;}
</style>
<div class="main">
    <h1>Welcome to Online Exam</h1>
    <div class="starttest">
        <h2>Test Your Knowledge</h2>
        <p>
            This is Multiple Choice Question System............!
        </p>
        <p>
            <strong>Number of Question:</strong> <?php echo $total; ?>
        </p>
        <p>
            <strong>Question Type:</strong> MCQ
        </p>
        <a href="test.php?q=<?php echo $question['quesNo']; ?>">Start Test</a>
    </div>

</div>
<?php include 'inc/footer.php'; ?>