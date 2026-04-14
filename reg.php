<?php
session_start();
include 'conn.php';

    $upi        = $_POST['UPI'];
    $assessment = $_POST['Assesment'];
    $firstName  = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $surname    = $_POST['surname'];
    $birthNo    = $_POST['birthNo'];
    $dob        = $_POST['DOB'];
    $grade      = $_POST['Grade'];

    $sql = "INSERT INTO Student (UPI, Assesment, firstName, middleName, surname, birthNo, DOB, Grade)
            VALUES ('$upi','$assessment','$firstName','$middleName','$surname','$birthNo','$dob','$grade')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['firstName'] = $firstName;
        echo"
        <script>
        alert('Learner Registeres successfully');
        window.location.href='teacherpanel.php';
        </script>";
        exit();
    } else {
        echo "Error inserting student: " . mysqli_error($conn);
    }

?>
