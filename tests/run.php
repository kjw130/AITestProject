<?php
// Test runner — uses in-memory SQLite, never touches db/database.sqlite
define('DB_PATH', ':memory:');

require_once __DIR__ . '/../src/Database.php';

$passed = 0;
$failed = 0;

function pass(string $label): void {
    global $passed;
    echo "  [PASS] $label\n";
    $passed++;
}

function fail(string $label, string $reason = ''): void {
    global $failed;
    echo "  [FAIL] $label" . ($reason ? " — $reason" : '') . "\n";
    $failed++;
}

function assert_eq(string $label, mixed $actual, mixed $expected): void {
    $actual === $expected
        ? pass($label)
        : fail($label, 'expected ' . json_encode($expected) . ', got ' . json_encode($actual));
}

echo "\n=== Running Tests ===\n\n";

// --- Database connection ---
try {
    $db = Database::getInstance();
    pass('Database connects');
} catch (Throwable $e) {
    fail('Database connects', $e->getMessage());
    exit(1);
}

// --- Schema ---
$tables = $db->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'")
             ->fetchAll(PDO::FETCH_COLUMN);
assert_eq('users table exists', in_array('users', $tables), true);

// --- Insert ---
$db->exec("INSERT INTO users (name) VALUES ('Alice')");
$count = (int) $db->query("SELECT COUNT(*) FROM users")->fetchColumn();
assert_eq('insert user works', $count, 1);

// --- Query ---
$row = $db->query("SELECT name FROM users LIMIT 1")->fetch();
assert_eq('query returns correct name', $row['name'], 'Alice');

// Add more tests below following the same pattern.

echo "\n=== $passed passed, $failed failed ===\n\n";
exit($failed > 0 ? 1 : 0);
