<?php
session_start();

// Check if user is logged in and has a picture
if (!isset($_SESSION['user']) || !isset($_SESSION['user']['picture'])) {
    // Serve a default user icon SVG
    header('Content-Type: image/svg+xml');
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>';
    exit;
}

$imageUrl = $_SESSION['user']['picture'];

// Set appropriate headers
header('Content-Type: image/jpeg');
header('Cache-Control: max-age=3600'); // Cache for 1 hour

// Output the image directly
readfile($imageUrl);
?>