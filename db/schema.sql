-- Schema — runs on every startup (safe due to IF NOT EXISTS)
-- Add your tables here.

CREATE TABLE IF NOT EXISTS users (
    id         INTEGER PRIMARY KEY AUTOINCREMENT,
    name       TEXT    NOT NULL,
    created_at TEXT    DEFAULT (datetime('now'))
);
