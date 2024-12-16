<?php
require_once('../db.php');
$response = [
    'success' => true,
    'data' => [],
    'error' => ''
];

$manga_id = intval($_POST['manga_id'] ?? 0); 

if ($manga_id <= 0) {
    $response['success'] = false;
    $response['error'] = 'Невалиден продукт';
} else {
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO favorite_mangas_users (user_id, manga_id) VALUES (:user_id, :manga_id)";
    $stmt = $pdo->prepare($query);
    $params = [
        ':user_id' => $user_id,
        ':manga_id' => $manga_id 
    ];

    if (!$stmt->execute($params)) {
        $response['success'] = false;
        $response['error'] = 'Възникна грешка при добавяне в любими';
    }
}

echo json_encode($response);
exit;
?>