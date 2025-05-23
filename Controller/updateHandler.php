<?php

//retrieve the user's data from the database
$userEmail = $_SESSION['user_email'];

$selectUser = mysqli_query($conn, "SELECT * FROM users WHERE email = '$userEmail'") or die('Query failed');
$row = mysqli_fetch_assoc($selectUser);

if (isset($_POST['updatebtn'])) {

    //retrieve the data for upadating the user's profile
    $updatefullName = $_POST['updatefullName'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    // Check if the current password matches the one stored in the database
    $storedPassword = $row['password'];
    if (password_verify($currentPassword, $storedPassword)) {

        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE `users` SET `fullName` = '$updatefullName', `password` = '$hashedNewPassword' WHERE `users`.`email` = '$userEmail';"; //update the new password
        $result = mysqli_query($conn, $sql);

        if ($result) {
            redirect('../View/profile.php');
        } else {
            redirect('../View/login.php?code=3');
        }
    } else {
        // Current password is incorrect, show the error message
        $message[] = 'Passwords Not Matching!';
    }
}
 // password error notification 

 if(isset($message)){
    foreach($message as $message){
        echo '
        <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
    }
?>