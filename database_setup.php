<?php
try {
    $pdo = new PDO('sqlite:database.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE TABLE IF NOT EXISTS travel_diary (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title TEXT NOT NULL,
        description TEXT,
        date TEXT NOT NULL,
        notes TEXT,
        rating INTEGER
    )");

    echo "Database setup completed.";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}