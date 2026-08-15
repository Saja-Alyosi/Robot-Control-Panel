<?php

header('Content-Type: application/json; charset=utf-8');

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$text = isset($_POST['text']) ? trim($_POST['text']) : '';

if ($text === '') {
    echo json_encode([
        'status' => 'error',
        'message' => 'The text is empty'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$stmt = $conn->prepare(
    "INSERT INTO voice_commands (text_output) VALUES (?)"
);

$stmt->bind_param("s", $text);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Text saved successfully',
        'text' => $text
    ], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to save text to database'
    ], JSON_UNESCAPED_UNICODE);
}

$stmt->close();
$conn->close();

?>