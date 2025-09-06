<?php
session_start();
include("../config/db.php");

$signupMsg = "";
$signinMsg = "";

// ========================
// SIGN UP
// ========================
if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone    = !empty($_POST['phone']) ? trim($_POST['phone']) : '';
    $address  = !empty($_POST['address']) ? trim($_POST['address']) : '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $signupMsg = "❌ Invalid email format!";
    } else {
        // Check if email or username already exists
        $checkStmt = $con->prepare("SELECT id FROM customers WHERE name=? OR email=? LIMIT 1");
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            $signupMsg = "❌ Username or Email already exists!";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $con->prepare("INSERT INTO customers (name, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $username, $email, $passwordHash, $phone, $address);

            if ($stmt->execute()) {
                $signupMsg = "✅ Registration successful! Please login.";
            } else {
                $signupMsg = "❌ Insert error: " . $stmt->error;
            }
            $stmt->close();
        }
        $checkStmt->close();
    }
}

// ========================
// SIGN IN
// ========================
if (isset($_POST['signin'])) {
    $username = trim($_POST['username']); // can be name or email
    $password = trim($_POST['password']);

    $stmt = $con->prepare("SELECT * FROM customers WHERE name=? OR email=? LIMIT 1");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            // Set session
            $_SESSION['user_id']   = $row['id'];
            $_SESSION['username']  = $row['name'];
            $_SESSION['email']     = $row['email'];

            header("Location: dashboard.php");
            exit;
        } else {
            $signinMsg = "❌ Invalid password!";
        }
    } else {
        $signinMsg = "❌ No user found!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../assets/css/login.css" />
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">

        <!-- Sign In -->
        <form method="POST" action="login.php" class="sign-in-form">
          <h2 class="title">Sign in</h2>
          <?php if (!empty($signinMsg)) echo "<p style='color:red;'>" . htmlspecialchars($signinMsg) . "</p>"; ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username or Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required />
          </div>
          <input type="submit" name="signin" value="Login" class="btn solid" />
        </form>

        <!-- Sign Up -->
        <form method="POST" action="login.php" class="sign-up-form">
          <h2 class="title">Sign up</h2>
          <?php if (!empty($signupMsg)) echo "<p style='color:green;'>" . htmlspecialchars($signupMsg) . "</p>"; ?>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required />
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required />
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required />
          </div>
          <div class="input-field">
            <i class="fas fa-phone"></i>
            <input type="text" name="phone" placeholder="Phone (Optional)" />
          </div>
          <div class="input-field">
            <i class="fas fa-home"></i>
            <input type="text" name="address" placeholder="Address (Optional)" />
          </div>
          <input type="submit" name="signup" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>Local Farmers Market E-commerce Platform: Connect with local farmers</p>
          <button class="btn transparent" id="sign-up-btn">Sign up</button>
        </div>
        <img src="../assets/images/logo.png" class="image" alt="logo" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>Already a member? Please login to access your dashboard</p>
          <button class="btn transparent" id="sign-in-btn">Sign in</button>
        </div>
        <img src="../assets/images/logo.png" class="image" alt="logo" />
      </div>
    </div>
  </div>

  <script src="../assets/js/login.js"></script>
</body>

</html>
