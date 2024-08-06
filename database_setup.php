<?php
try {
    $pdo = new PDO('sqlite:travel-app.sqlite');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table trips
    $pdo->exec("CREATE TABLE IF NOT EXISTS trips (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        title VARCHAR(255) NOT NULL,
        place VARCHAR(255),
        description TEXT,
        start_date TEXT NOT NULL,
        end_date TEXT NOT NULL
    )");

    // Create table days
    $pdo->exec("CREATE TABLE IF NOT EXISTS days (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        trip_id INTEGER NOT NULL,
        title VARCHAR(255) NOT NULL,
        date TEXT NOT NULL,
        description TEXT,
        FOREIGN KEY(trip_id) REFERENCES trips(id)
    )");

    // Create table stages
    $pdo->exec("CREATE TABLE IF NOT EXISTS stages (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        day_id INTEGER NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        start_time TEXT,
        end_time TEXT,
        rating INTEGER,
        note TEXT,
        image_url VARCHAR(255),
        latitude REAL, /* FLOAT not supported by SQLite, use REAL instead */
        longitude REAL,
        FOREIGN KEY(day_id) REFERENCES days(id)
    )");

    echo "Database setup completed.";
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}