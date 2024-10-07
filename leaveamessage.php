<?php
// leaveamessage.php

require 'constituents/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $subject = $conn->real_escape_string($_POST['subject']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO messages (first_name, last_name, email, subject, message) VALUES ('$first_name', '$last_name', '$email', '$subject', '$message')";

    if ($conn->query($sql) === TRUE) {
        $success_message = "Message submitted successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'constituents/favicon.php'; ?>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/resstyle.css">
    <title>Leave a message</title>
</head>

<body>
    <div class="container">

        <!-- navbar starts  -->
        <?php include 'constituents/navbar.php' ?>
        <!-- navbar ends  -->

        <!-- send sms starts  -->
        <div class="sms-container">
            <div class="sms">
                <div class="sms-title">
                    <h1>Leave a message</h1>
                </div>
                <div class="show-alert" style="color: green; margin-bottom: 13px; font-weight: 400;">
                    <?php if (!empty($success_message)) : ?>
                        <div class="alert success"><?php echo $success_message; ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error_message)) : ?>
                        <div class="alert error"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                </div>
                <div class="sms-form">
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="sms-form-name">
                            <input type="text" name="first_name" placeholder="First name" required>
                            <input type="text" name="last_name" placeholder="Second name" required>
                        </div>
                        <div class="sms-form-mids">
                            <input type="email" name="email" placeholder="Email" required>
                            <input type="text" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="sms-form-sms">
                            <textarea name="message" id="" placeholder="Your message" required></textarea>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- send sms ends -->

        <!-- copyright starts -->
        <?php include 'constituents/copyright.php'; ?>
        <!-- copyright starts -->
    </div>
</body>

</html>