<?php
require_once __DIR__ . '/../src/Database.php';

header('Content-Type: application/json');

$db     = Database::getInstance();
$method = $_SERVER['REQUEST_METHOD'];
$route  = $_GET['route'] ?? '';
$body   = json_decode(file_get_contents('php://input'), true) ?? [];

// --- Routes ---
// Add new routes following the same pattern below.

if ($method === 'GET' && $route === 'users') {
    $rows = $db->query("SELECT * FROM users ORDER BY id DESC")->fetchAll();
    echo json_encode($rows);
    exit;
}

if ($method === 'POST' && $route === 'users') {
    $name = trim($body['name'] ?? '');
    if ($name === '') {
        http_response_code(400);
        echo json_encode(['error' => 'name is required']);
        exit;
    }
    $stmt = $db->prepare("INSERT INTO users (name) VALUES (?)");
    $stmt->execute([$name]);
    echo json_encode(['id' => (int) $db->lastInsertId(), 'name' => $name]);
    exit;
}

// --- 404 ---
http_response_code(404);
echo json_encode(['error' => 'Route not found']);
