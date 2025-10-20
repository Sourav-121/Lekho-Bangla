<?php
header('Content-Type: text/plain; charset=UTF-8');

$title = isset($_GET['title']) ? $_GET['title'] : '';

$file = 'custom_texts.json';
if (!file_exists($file)) {
    echo "";
    exit;
}

$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) $data = [];

foreach ($data as $entry) {
    if ($entry['title'] === $title) {
        echo $entry['content'];
        exit;
    }
}

echo "";
?>
