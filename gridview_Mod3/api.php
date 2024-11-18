<?php

header("Content-Type: application/json");

try {
    $host = 'localhost';
    $db = 'gridView';
    $user = 'postgres';
    $pass = '1!';

    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sort_column = $_GET['sort_column'] ?? 'id';
    $sort_order = $_GET['sort_order'] ?? 'asc';
    $limit = $_GET['limit'] ?? 10;
    $page = $_GET['page'] ?? 1;

    $offset = ($page - 1) * $limit;

    $sql = "SELECT * FROM seeds ORDER BY $sort_column $sort_order LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        echo json_encode(["error" => "Query execution failed", "details" => $stmt->errorInfo()]);
        exit;
    }

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data);

} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
    exit;
}
?>