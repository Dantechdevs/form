<!DOCTYPE html>
<html>
<head>
    <title>Form Submission</title>
</head>
<body>
    <?php
    // Initialize error messages array
    $errors = array();

    // Function to validate input
    function validate_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Full Name validation
        if (empty($_POST["full_name"])) {
            $errors["full_name"] = "Full Name is required.";
        } else {
            $full_name = validate_input($_POST["full_name"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $full_name)) {
                $errors["full_name"] = "Only letters and spaces allowed.";
            }
        }

        // Email validation
        if (empty($_POST["email"])) {
            $errors["email"] = "Email Address is required.";
        } else {
            $email = validate_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "Invalid email format.";
            }
        }

        // Age validation
        if (empty($_POST["age"])) {
            $errors["age"] = "Age is required.";
        } else {
            $age = validate_input($_POST["age"]);
            if (!is_numeric($age) || $age < 1 || $age > 99) {
                $errors["age"] = "Age must be a positive integer between 1 and 99.";
            }
        }

        // Gender validation
        if (empty($_POST["gender"])) {
            $errors["gender"] = "Gender is required.";
        }

        // Favorite Programming Language validation
        if (empty($_POST["favorite_language"])) {
            $errors["favorite_language"] = "Favorite Programming Language is required.";
        }

        // Subscription message
        $subscription_message = isset($_POST["subscribe"]) ? "You have subscribed to our newsletter." : "";

        // Display errors or submitted data
        if (count($errors) > 0) {
            echo "Form submission contains errors:<br>";
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            // Add a "Back" link to return to the form
            echo '<a href="index.html">Back to Form</a>';
        } else {
            // Display submitted data
            echo "<h2>Submitted Data:</h2>";
            echo "<p><strong>Full Name:</strong> " . $full_name . "</p>";
            echo "<p><strong>Email Address:</strong> " . $email . "</p>";
            echo "<p><strong>Age:</strong> " . $age . "</p>";
            echo "<p><strong>Gender:</strong> " . $_POST["gender"] . "</p>";
            echo "<p><strong>Favorite Programming Language:</strong> " . $_POST["favorite_language"] . "</p>";
            echo "<p><strong>Subscription Status:</strong> " . $subscription_message . "</p>";
            // Add a "Back" link to return to the form
            echo '<a href="index.html">Back to Form</a>';
        }
    }
    ?>
</body>
</html>