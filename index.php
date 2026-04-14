<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Portal</title>
</head>
<body>

<?php
include 'conn.php';
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['AssesmentNumber'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `Student` WHERE Assesment=? AND password=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];

        if ($row['role'] === 'user') {
            header("Location: StudentDashboard.php");
            exit;
        } elseif ($row['role'] === 'admin') {
            header("Location: teacherpanel.php");
            exit;
        } elseif ($row['role'] === 'superadmin') {
            header("Location: Hoi.php");
            exit;
        }
    } else {
        $error = "Invalid credentials. Enter valid details.";
    }
}
?>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=DM+Sans:wght@400;500&display=swap');

  *, *::before, *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'DM Sans', sans-serif;
  }

  .portal-wrapper {
    min-height: 100vh;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #0a2342 0%, #0f3460 50%, #16213e 100%);
  }

  /* ── Decorative background ── */
  .bg-decor {
    position: absolute;
    inset: 0;
    pointer-events: none;
  }

  .dots-pattern {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.07) 1px, transparent 1px);
    background-size: 28px 28px;
  }

  .bg-circle {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.06);
  }

  .bg-circle-1 { width: 440px; height: 440px; top: -120px; right: -100px; }
  .bg-circle-2 { width: 280px; height: 280px; bottom: -80px; left: -80px; }
  .bg-circle-3 { width: 150px; height: 150px; bottom: 100px; right: 60px; }

  /* ── Card ── */
  .form-card {
    background: #fff;
    border-radius: 20px;
    padding: 2.5rem 2.2rem 2rem;
    width: 100%;
    max-width: 400px;
    position: relative;
    box-shadow: 0 24px 64px rgba(0,0,0,0.4);
  }

  .form-card::before {
    content: '';
    position: absolute;
    top: 0; left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 3px;
    background: linear-gradient(90deg, #1a3a6b, #3d8ef0);
    border-radius: 0 0 4px 4px;
  }

  /* ── Brand header ── */
  .brand-header {
    text-align: center;
    margin-bottom: 1.8rem;
  }

  .logo-ring {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0f3460, #1a5cad);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    box-shadow: 0 6px 20px rgba(15,52,96,0.35);
  }

  .logo-ring img.log-img2 {
    width: 44px; height: 44px;
    object-fit: cover;
    border-radius: 50%;
  }

  .portal-title {
    font-family: 'Playfair Display', Georgia, serif;
    font-size: 1.35rem;
    font-weight: 600;
    color: #0a2342;
    margin-bottom: 4px;
    letter-spacing: 0.01em;
  }

  .portal-subtitle {
    font-size: 12px;
    color: #6b7a8d;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }

  /* ── Divider ── */
  .divider {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 1.5rem;
  }

  .divider-line { flex: 1; height: 0.5px; background: #dde3ec; }

  .divider-text {
    font-size: 11px;
    color: #a0aab7;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  /* ── Form fields ── */
  .field-group { margin-bottom: 1rem; }

  .login2 label {
    display: block;
    font-size: 12px;
    font-weight: 500;
    color: #3a4a5c;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 6px;
  }

  .field-wrap { position: relative; }

  .field-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 16px; height: 16px;
    opacity: 0.4;
    pointer-events: none;
  }

  .login2 input[type="text"],
  .login2 input[type="password"] {
    width: 100%;
    padding: 10px 12px 10px 38px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    color: #1a2b3c;
    background: #f4f7fb;
    border: 1px solid #d8e2ef;
    border-radius: 9px;
    outline: none;
    transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
  }

  .login2 input::placeholder { color: #a8b6c6; font-size: 13px; }

  .login2 input:focus {
    background: #fff;
    border-color: #3d8ef0;
    box-shadow: 0 0 0 3px rgba(61,142,240,0.12);
  }

  /* ── Button ── */
  .login-btn {
    width: 100%;
    margin-top: 1.4rem;
    padding: 11px;
    font-family: 'DM Sans', sans-serif;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #fff;
    background: linear-gradient(135deg, #0f3460 0%, #1a5cad 100%);
    border: none;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 0 6px 18px rgba(15,52,96,0.28);
    transition: transform 0.15s, box-shadow 0.15s;
  }

  .login-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 24px rgba(15,52,96,0.36);
  }

  .login-btn:active { transform: scale(0.98); }

  /* ── Error ── */
  .error-msg {
    margin-top: 10px;
    padding: 8px 12px;
    border-radius: 8px;
    background: #fff0f0;
    border-left: 3px solid #e24b4a;
    font-size: 13px;
    color: #c0392b;
  }

  /* ── Footer ── */
  .portal-footer {
    margin-top: 1.6rem;
    text-align: center;
    font-size: 11px;
    color: #9eaab8;
    border-top: 0.5px solid #e8edf3;
    padding-top: 1rem;
    line-height: 1.6;
  }
</style>

<div class="portal-wrapper">

  <div class="bg-decor">
    <div class="dots-pattern"></div>
    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>
    <div class="bg-circle bg-circle-3"></div>
  </div>

  <div class="form-card">

    <div class="brand-header">
      <div class="logo-ring">
        <img src="images/graduation.jpeg" class="log-img2" alt="School Logo">
      </div>
      <p class="portal-title">School Portal</p>
      <p class="portal-subtitle">Student Access</p>
    </div>

    <div class="divider">
      <div class="divider-line"></div>
      <span class="divider-text">Sign In</span>
      <div class="divider-line"></div>
    </div>

    <form action="" method="post" class="login2">

      <div class="field-group">
        <label for="assessment">Assessment Number</label>
        <div class="field-wrap">
          <svg class="field-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="1.5" y="2.5" width="13" height="11" rx="2" stroke="#1a2b3c" stroke-width="1.3"/>
            <path d="M5 7h6M5 10h4" stroke="#1a2b3c" stroke-width="1.3" stroke-linecap="round"/>
          </svg>
          <input type="text" id="assessment" name="AssesmentNumber" placeholder="Enter your assessment number" required>
        </div>
      </div>

      <div class="field-group">
        <label for="password">Password</label>
        <div class="field-wrap">
          <svg class="field-icon" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="3" y="7" width="10" height="8" rx="1.5" stroke="#1a2b3c" stroke-width="1.3"/>
            <path d="M5.5 7V5a2.5 2.5 0 0 1 5 0v2" stroke="#1a2b3c" stroke-width="1.3" stroke-linecap="round"/>
            <circle cx="8" cy="11" r="1" fill="#1a2b3c"/>
          </svg>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
      </div>

      <button type="submit" class="login-btn">Access Portal</button>

      <?php if (!empty($error)) echo "<p class='error-msg'>$error</p>"; ?>

    </form>

    <footer class="portal-footer">
      &copy; <?php echo date("Y"); ?> mwendwamutinda24@gmail.com. All rights reserved.
    </footer>

  </div>
</div>

</body>
</html>