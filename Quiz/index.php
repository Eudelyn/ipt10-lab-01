<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>IPT10 Laboratory Activity #3A</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>

<body>

<section class="hero is-link">
    <div class="hero-body">
        <p class="title">PHP Quiz Web Application</p>
        <p class="subtitle">
            IPT10 Laboratory Activity #3A
        </p>
    </div>
</section>

<section class="section">

    <div class="container">

        <div class="columns is-centered">

            <div class="column is-half">

                <div class="box">

                    <h1 class="title">
                        User Registration
                    </h1>

                    <p class="mb-5">
                        Please enter your information before starting the quiz.
                    </p>

                    <form method="POST" action="instructions.php">

                        <!-- Complete Name -->
                        <div class="field">
                            <label class="label">
                                Complete Name
                            </label>

                            <div class="control">
                                <input
                                    id="complete_name"
                                    class="input"
                                    type="text"
                                    name="complete_name"
                                    placeholder="Enter your complete name"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="field">
                            <label class="label">
                                Email Address
                            </label>

                            <div class="control">
                                <input
                                    id="email"
                                    class="input"
                                    type="email"
                                    name="email"
                                    placeholder="example@email.com"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Birthdate -->
                        <div class="field">
                            <label class="label">
                                Birthdate
                            </label>

                            <div class="control">
                                <input
                                    class="input"
                                    type="date"
                                    name="birthdate"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Contact Number -->
                        <div class="field">
                            <label class="label">
                                Contact Number
                            </label>

                            <div class="control">
                                <input
                                    class="input"
                                    type="tel"
                                    name="contact_number"
                                    placeholder="09XXXXXXXXX"
                                    required
                                >
                            </div>
                        </div>

                        <div class="field mt-5">
                            <div class="control">

                                <button
                                    id="nextButton"
                                    type="submit"
                                    class="button is-link is-fullwidth"
                                    disabled
                                >
                                    Proceed to Instructions
                                </button>

                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

<script>

const completeName = document.getElementById("complete_name");
const email = document.getElementById("email");
const nextButton = document.getElementById("nextButton");

function validateForm() {

    const nameValid =
        completeName.value.trim() !== "";

    const emailValid =
        email.validity.valid &&
        email.value.trim() !== "";

    nextButton.disabled = !(nameValid && emailValid);
}

completeName.addEventListener("input", validateForm);
email.addEventListener("input", validateForm);

</script>

</body>
</html>