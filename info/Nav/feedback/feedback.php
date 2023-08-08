<?php
// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];

    // Validate form data (add your own validation rules)
    $errors = [];
    if (empty($name)) {
        $errors[] = 'Name is required';
    }

    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    if (empty($feedback)) {
        $errors[] = 'Feedback is required';
    }

    // If there are no validation errors, process the feedback
    if (empty($errors)) {
        // Save the feedback to a database or send an email, etc.
        // Replace this with your own code

        // Example: Save feedback to a database
        $servername = 'localhost';
        $username = 'your_username';
        $password = 'your_password';
        $dbname = 'your_database';

        // Create a database connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare('INSERT INTO feedback (name, email, feedback) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $name, $email, $feedback);
        $stmt->execute();

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();

        // Redirect to a thank you page
        header('Location: thank_you.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feedback Form</title>
</head>
<body>
    <h1>Feedback Form</h1>

    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo isset($name) ? $name : ''; ?>"><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>"><br>

        <label for="feedback">Feedback:</label>
        <textarea name="feedback" id="feedback"><?php echo isset($feedback) ? $feedback : ''; ?></textarea><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
