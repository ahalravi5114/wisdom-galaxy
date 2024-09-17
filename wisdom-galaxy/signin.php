<?php
// Connect to MySQL database
$conn = new mysqli("localhost", "root", "", "login");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $name = $_POST["name"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $pincode = $_POST["pincode"];
    $edu = $_POST["edu"];
    $institute = $_POST["institute"];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO users (username, name, dob, email, password, address, city, state, pincode, edu, institute) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssiss", $username, $name, $dob, $email, $password, $address, $city, $state, $pincode, $edu, $institute);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Signup successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>

<!-- HTML for signup form -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #add8e6; /* Light blue background */
    }
    .signup-container {
        background-color: #f5f5f5; /* Light grey background */
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }
    .signup-container h1 {
        margin-bottom: 20px;
        color: #007bff; /* Blue color */
    }
    .signup-container input[type="text"],
    .signup-container input[type="password"],
    .signup-container input[type="email"],
    .signup-container input[type="date"] {
        width: calc(100% - 20px);
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .signup-container input[type="submit"] {
        width: calc(100% - 20px);
        padding: 10px;
        background-color: #007bff; /* Blue color */
        color: #fff; /* White color */
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
<body>
    
    <div class="signup-container">
    <h1>Signup</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="date" name="dob" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="text" name="address" placeholder="Address" required><br>
        <input type="text" name="city" placeholder="City" required><br>
        <input type="text" name="state" placeholder="State" required><br>
        <input type="text" name="pincode" placeholder="Pincode" required><br>
        <input type="text" name="edu" placeholder="Education" required><br>
        <input type="text" name="institute" placeholder="Institute" required><br>
        <input type="submit" value="Signup">
    </form>
</div>
</body>
</html>