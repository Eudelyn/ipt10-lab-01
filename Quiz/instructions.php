<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';

$name_parts = preg_split('/\s+/', trim($complete_name));
$first_name = $name_parts[0] ?? '';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Quiz Instructions</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

</head>

<body>

<section class="hero is-info">

    <div class="hero-body">

        <div class="container">

            <p class="title">
                Quiz Instructions
            </p>

            <p class="subtitle">
                Please read the instructions before starting.
            </p>

        </div>

    </div>

</section>

<section class="section">

    <div class="container">

        <div class="box">

            <h1 class="title">
                Hello <?php echo htmlspecialchars($first_name); ?>,
                please read the instructions first.
            </h1>

            <div class="content">

                <p>
                    Welcome to the IPT10 PHP Quiz Web Application.
                </p>

                <ol>
                    <li>There are 5 questions in the quiz.</li>
                    <li>Select the best answer for every question.</li>
                    <li>All questions will be displayed on one page.</li>
                    <li>You have 60 seconds to complete the quiz.</li>
                    <li>The quiz will automatically submit when the timer ends.</li>
                    <li>Make sure you answer all questions before submitting.</li>
                </ol>

            </div>

            <hr>

            <div class="notification is-light">

                <strong>Terms and Conditions</strong>

                <p class="mt-2">
                    By starting this quiz, you agree to answer the questions
                    honestly and understand that your answers will be submitted
                    when the quiz is completed or when the timer expires.
                </p>

            </div>

            <form method="POST" action="quiz.php">

                <!-- Hidden registration fields -->

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

                <!-- Agreement -->

                <div class="field">

                    <label class="checkbox">

                        <input
                            type="checkbox"
                            id="agree"
                            name="agree"
                            value="yes"
                        >

                        I agree to the terms and conditions.

                    </label>

                </div>

                <div class="field mt-5">

                    <button
                        id="startQuiz"
                        type="submit"
                        class="button is-link"
                        disabled
                    >
                        Start Quiz
                    </button>

                </div>

            </form>

        </div>

    </div>

</section>

<script>

const agree = document.getElementById("agree");
const startQuiz = document.getElementById("startQuiz");

agree.addEventListener("change", function () {

    startQuiz.disabled = !agree.checked;

});

</script>

</body>
</html>