<?php

// Check if a database migration request is made
if (isset($_GET['migrate']) && $_GET['migrate'] === 'yes') {
    try {
        // Load Composer Autoloader
        require __DIR__ . '/../vendor/autoload.php';
        
        echo "<h1>Running Database Migrations & Seeders...</h1>";
        
        // Boot Laravel application
        $app = require __DIR__ . '/../bootstrap/app.php';
        
        // Resolve Console Kernel
        $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
        
        // Run migrations
        echo "Migrating tables...<br>";
        $status = $kernel->call('migrate', ['--force' => true]);
        echo "Migration status: " . $status . " (Success)<br><br>";
        
        // Run seeders
        echo "Seeding data...<br>";
        $statusSeed = $kernel->call('db:seed', ['--force' => true]);
        echo "Seeding status: " . $statusSeed . " (Success)<br><br>";
        
        echo "<strong>Database successfully prepared!</strong><br>";
        echo "<a href='/'>Go to Homepage</a>";
        exit;
    } catch (\Exception $e) {
        echo "<h2>Error running migration:</h2>";
        echo "<pre>" . $e->getMessage() . "</pre>";
        exit;
    }
}

// Forward normal requests to Laravel's public index
require __DIR__ . '/../public/index.php';
