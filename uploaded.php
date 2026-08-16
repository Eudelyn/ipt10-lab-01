<?php

$upload_directory = getcwd() . '/uploads/';
$relative_path = 'uploads/';

// Handle Text File
if (isset($_FILES['text_file']) && $_FILES['text_file']['error'] === UPLOAD_ERR_OK) {
    $uploaded_text_file = $upload_directory . basename($_FILES['text_file']['name']);
    $temporary_file = $_FILES['text_file']['tmp_name'];

    if (move_uploaded_file($temporary_file, $uploaded_text_file)) {
        $text_file_content = file_get_contents($uploaded_text_file, 'r');
        ?>
        <textarea cols="70" rows="30"><?php echo $text_file_content; ?></textarea>
        <?php
    } else {
        echo 'Failed to upload text file';
    }
}

// Handle PDF File
if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
    $safe_name = str_replace(' ', '_', basename($_FILES['pdf_file']['name']));
    $uploaded_pdf_file = $upload_directory . $safe_name;
    $temporary_pdf = $_FILES['pdf_file']['tmp_name'];

    if (move_uploaded_file($temporary_pdf, $uploaded_pdf_file)) {
        $pdf_relative_path = $relative_path . $safe_name;
        ?>
        <embed src="<?php echo $pdf_relative_path; ?>" type="application/pdf" width="600" height="500" />
        <?php
    } else {
        echo 'Failed to upload PDF file';
    }
}

// Handle Video File
if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] === UPLOAD_ERR_OK) {
    $safe_video_name = str_replace(' ', '_', basename($_FILES['video_file']['name']));
    $uploaded_video_file = $upload_directory . $safe_video_name;
    $temporary_video = $_FILES['video_file']['tmp_name'];

    if (move_uploaded_file($temporary_video, $uploaded_video_file)) {
        $video_relative_path = $relative_path . $safe_video_name;
        ?>
                <video width="500" controls>
                    <source src="<?php echo $video_relative_path; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <?php
    } else {
        echo 'Failed to upload video file';
    }
}

// Handle Audio File
if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] === UPLOAD_ERR_OK) {
    $safe_audio_name = str_replace(' ', '_', basename($_FILES['audio_file']['name']));
    $uploaded_audio_file = $upload_directory . $safe_audio_name;
    $temporary_audio = $_FILES['audio_file']['tmp_name'];

    if (move_uploaded_file($temporary_audio, $uploaded_audio_file)) {
        $audio_relative_path = $relative_path . $safe_audio_name;
        ?>
        <audio controls>
            <source src="<?php echo $audio_relative_path; ?>" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
        <?php
    } else {
        echo 'Failed to upload audio file';
    }
}

// Handle Image File
if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
    $safe_image_name = str_replace(' ', '_', basename($_FILES['image_file']['name']));
    $uploaded_image_file = $upload_directory . $safe_image_name;
    $temporary_image = $_FILES['image_file']['tmp_name'];

    if (move_uploaded_file($temporary_image, $uploaded_image_file)) {
        $image_relative_path = $relative_path . $safe_image_name;
        ?>
        <img src="<?php echo $image_relative_path; ?>" alt="Uploaded Image" width="400" />
        <?php
    } else {
        echo 'Failed to upload image file';
    }
}

echo '<pre>';
var_dump($_FILES);
exit;