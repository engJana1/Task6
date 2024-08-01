<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "speech_to_text_db";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$text = isset($_POST['text']) ? $_POST['text'] : '';
if ($text) {
    
    $sql = "INSERT INTO speech_text (text) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $text);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Text saved successfully!']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Failed to save text']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'No text provided']);
}

$conn->close();
?>
