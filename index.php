<?php
$db = new PDO('sqlite:db/database.sqlite');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$db->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT
    )
");

$db->exec("INSERT INTO users (name) VALUES ('Test User')");

$result = $db->query("SELECT * FROM users");

foreach ($result as $row) {
    echo $row['name'] . "<br>";
}
?>