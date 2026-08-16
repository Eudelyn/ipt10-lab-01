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
$answers = $_POST['answers'] ?? [];

$correct_answers = get_answers();

$score = compute_score($answers);

$total_questions = count($correct_answers);

$hero_class = $score > 2
    ? 'is-success'
    : 'is-danger';

$formatted_birthdate = '';

if (!empty($birthdate)) {

    $birthdate_object = DateTime::createFromFormat(
        'Y-m-d',
        $birthdate
    );

    if ($birthdate_object !== false) {

        $formatted_birthdate =
            $birthdate_object->format('F d, Y');

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Quiz Results</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

    <?php if ($score === $total_questions): ?>

        <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>

    <?php endif; ?>

</head>

<body>

<section class="hero <?php echo $hero_class; ?>">

    <div class="hero-body">

        <div class="container">

            <p class="title">
                Your Score: <?php echo $score; ?>/<?php echo $total_questions; ?>
            </p>

            <p class="subtitle">
                This is the IPT10 PHP Quiz Web Application Laboratory Activity.
            </p>

        </div>

    </div>

</section>

<section class="section">

    <div class="container">

        <div class="box">

            <h2 class="title is-4">
                Examinee Information
            </h2>

            <div class="table-container">

                <table class="table is-bordered is-hoverable is-fullwidth">

                    <thead>

                        <tr>
                            <th>Input Field</th>
                            <th>Value</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>
                            <td>Complete Name</td>

                            <td>
                                <?php echo htmlspecialchars($complete_name); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Email</td>

                            <td>
                                <?php echo htmlspecialchars($email); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Birthdate</td>

                            <td>
                                <?php echo htmlspecialchars($formatted_birthdate); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>Contact Number</td>

                            <td>
                                <?php echo htmlspecialchars($contact_number); ?>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <div class="box">

            <h2 class="title is-4">
                Question Review
            </h2>

            <div class="table-container">

                <table class="table is-bordered is-striped is-hoverable is-fullwidth">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Question</th>
                            <th>Correct Answer</th>
                            <th>Your Answer</th>
                            <th>Result</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($correct_answers as $index => $correct_key): ?>

                            <?php

                            $user_key = $answers[$index] ?? 'No Answer';

                            $question = retrieve_questions()['questions'][$index];

                            $correct_value = '';

                            foreach ($question['options'] as $option) {

                                if ($option['key'] === $correct_key) {
                                    $correct_value = $option['value'];
                                    break;
                                }

                            }

                            $user_value = 'No Answer';

                            foreach ($question['options'] as $option) {

                                if ($option['key'] === $user_key) {
                                    $user_value = $option['value'];
                                    break;
                                }

                            }

                            $is_correct =
                                $user_key === $correct_key;

                            ?>

                            <tr>

                                <td>
                                    <?php echo $index + 1; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($question['question']); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($correct_value); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($user_value); ?>
                                </td>

                                <td>

                                    <?php if ($is_correct): ?>

                                        <span class="tag is-success">
                                            Correct
                                        </span>

                                    <?php else: ?>

                                        <span class="tag is-danger">
                                            Incorrect
                                        </span>

                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

<?php if ($score === $total_questions): ?>

    <canvas
        id="confetti-canvas"
        style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 9999;
        "
    ></canvas>

    <script>

        const confettiSettings = {
            target: 'confetti-canvas'
        };

        const confetti =
            new ConfettiGenerator(confettiSettings);

        confetti.render();

    </script>

<?php endif; ?>

</body>
</html>