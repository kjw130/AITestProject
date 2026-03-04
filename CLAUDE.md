# Project Instructions

## Stack
- PHP 8.x (no frameworks)
- SQLite (via PDO)
- Vanilla JavaScript (ES6+)
- No npm, no build tools

## Folder Structure
/public      → index.php, assets (js, css)
/src         → PHP classes and logic
/db          → SQLite database file + schema
/tests       → test files

## Code Rules
- Smallest change possible
- Don't touch unrelated files
- Run tests after every change
- Explain what changed and why
- Stop and ask before large refactors
- No over-engineering

## Agent Memory
- Product goal: [FILL IN — what this app does]
- Target user: [FILL IN — who uses it]
- MVP definition: [FILL IN — simplest working version]
- Non-goals: [FILL IN — what to exclude]

## Testing
- Run `php tests/run.php` after each change
- All core flows must pass before marking done