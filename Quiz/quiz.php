<?php

require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$agree = $_POST['agree'] ?? '';

if ($agree !== 'yes') {
    header('Location: index.php');
    exit;
}

$quiz_data = retrieve_questions();
$questions = $quiz_data['questions'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PHP Quiz</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

</head>

<body>

<section class="hero is-link">

    <div class="hero-body">

        <div class="container">

            <p class="title">
                PHP Quiz
            </p>

            <p class="subtitle">
                Answer all questions below.
            </p>

            <div class="notification is-warning">

                <strong>Time Remaining:</strong>

                <span id="timer">
                    60
                </span>

                seconds

            </div>

        </div>

    </div>

</section>

<section class="section">

    <div class="container">

        <form
            id="quizForm"
            method="POST"
            action="result.php"
        >

            <!-- Hidden registration information -->

            <input
                type="hidden"
                name="complete_name"
                value="<?php echo htmlspecialchars($complete_name); ?>"
            >

            <input
                type="hidden"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
            >

            <input
                type="hidden"
                name="birthdate"
                value="<?php echo htmlspecialchars($birthdate); ?>"
            >

            <input
                type="hidden"
                name="contact_number"
                value="<?php echo htmlspecialchars($contact_number); ?>"
            >

            <input
                type="hidden"
                name="agree"
                value="<?php echo htmlspecialchars($agree); ?>"
            >

            <?php foreach ($questions as $index => $question): ?>

                <div class="box">

                    <h2 class="title is-5">

                        Question <?php echo $index + 1; ?>

                    </h2>

                    <p class="subtitle is-6">

                        <?php echo htmlspecialchars($question['question']); ?>

                    </p>

                    <?php foreach ($question['options'] as $option): ?>

                        <div class="field">

                            <div class="control">

                                <label class="radio">

                                    <input
                                        type="radio"
                                        name="answers[<?php echo $index; ?>]"
                                        value="<?php echo htmlspecialchars($option['key']); ?>"
                                        required
                                    >

                                    <?php echo htmlspecialchars($option['value']); ?>

                                </label>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endforeach; ?>

            <button
                type="submit"
                class="button is-success is-large"
            >
                Submit Quiz
            </button>

        </form>

    </div>

</section>

<script>

let timeRemaining = 60;

const timer = document.getElementById("timer");
const quizForm = document.getElementById("quizForm");

const countdown = setInterval(function () {

    timeRemaining--;

    timer.textContent = timeRemaining;

    if (timeRemaining <= 0) {

        clearInterval(countdown);

        quizForm.submit();

    }

}, 1000);

</script>

</body>
</html>