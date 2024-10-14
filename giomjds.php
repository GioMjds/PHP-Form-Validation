<?php
    $nameError = $emailError = $mobileError = $websiteError = "";
    $name = $email = $mobileNumber = $website = "";
    $isValid = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name (only letters and spaces allowed)
    if (empty($_POST["name"]) || trim($_POST['name']) == "") {
        $nameError = "You didn't enter the Name.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $_POST["name"])) {
        $nameError = "Invalid name. Only letters and spaces are allowed.";
    } else {
        $name = $_POST["name"];
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailError = "You didn't enter your Email.";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $_POST["email"])) {
        $emailError = "Invalid email format.";
    } else {
        $email = $_POST["email"];
    }

    // Validate Mobile Number (only digits allowed, typically 10-15 digits)
    if (empty($_POST["mobile-number"])) {
        $mobileError = "You didn't enter your Mobile Number.";
    } elseif (!preg_match("/^[0-9]{11}$/", $_POST["mobile-number"])) {
        $mobileError = "Invalid mobile number. Only 11 digits are allowed.";
    } else {
        $mobileNumber = $_POST["mobile-number"];
    }

    // Validate Website (must be a valid URL)
    if (!empty($_POST["website"])) {
        $website = $_POST["website"];
        if (!preg_match("/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/", $website)) {
            $websiteError = "Invalid URL format.";
            $isValid = false;
        }
    }

    if ($isValid) {
        $userInfo = "<p>Name : $name</p><p>Email: $email</p><p>Mobile Number: $mobileNumber</p><p>Website: $website</p>";
    }
}
?>

<!-- Copyright: @giomjds | 2024  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration Form</title>
</head>

<body>
    <main>
        <form action="" method="post" class="registration-form">
            <h1>Registration Form</h1>
            <label>Name:</label>
            <input type="text" name="name" class="input-field" value="<?php echo htmlspecialchars($name); ?>">
            <div class='error'><?php echo $nameError; ?></div>

            <label>Email:</label>
            <input type="email" name="email" class="input-field" value="<?php echo htmlspecialchars($email); ?>">
            <div class='error'><?php echo $emailError; ?></div>

            <label>Mobile Number:</label>
            <input type="text" name="mobile-number" class="input-field"
                value="<?php echo htmlspecialchars($mobileNumber); ?>">
            <div class='error'><?php echo $mobileError; ?></div>

            <label>Website:</label>
            <input type="text" name="website" class="input-field" value="<?php echo htmlspecialchars($website); ?>">
            <div class='error'><?php echo $websiteError; ?></div>

            <input type="submit" name="submit" value="Submit" class="submit-button">
        </form>

        <?php if ($isValid && $_SERVER['REQUEST_METHOD'] == "POST"): ?>
        <div class="user-info show">
            <h2>User Information</h2>
            <?php echo $userInfo; ?>
        </div>
        <?php endif; ?>
    </main>
</body>

</html>