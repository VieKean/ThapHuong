<!-- save_wish.php -->
<?php
include "connect.php";

if (isset($_POST['btnThaphuong'])) {
    $wishText = $_POST['wish_text'];
    $imagePath = 'lan.png';

    $sql = "INSERT INTO wishes (wish_text, image_path) VALUES ('$wishText', '$imagePath')";
    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("Uớc nguyện của bạn đã được gửi đi!");</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
