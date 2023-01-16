<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];

    // Validate the form data
    if (empty($name) ||<empty($password) || empty($email) || empty($phone) || empty($dob) || empty($address)) {
        echo "All fields are required, please fill out the form completely.";
    } else {
        // Connect to the database
        $servername = "localhost";
        $username = "username";
        $password = "password";
        $dbname = "db";
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement
        $sql = "INSERT INTO important_details (name, email,password, phone, dob, address) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name,$password, $email, $phone, $dob, $address);

        // Execute the statement
        $stmt->execute();

        // Close the connection
        $stmt->close();
        $conn->close();

        // Redirect to a thank you page
        header("Location: /thank-you.php");
        exit;
    }
}
?>
