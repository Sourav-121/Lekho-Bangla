<?php
header('Content-Type: application/json; charset=UTF-8');

$file = 'custom_texts.json';
if (!file_exists($file)) {
    echo json_encode([]);
    exit;
}

$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) $data = [];

$titles = [];
foreach ($data as $entry) {
    $titles[] = ['title' => $entry['title']];
}

echo json_encode($titles, JSON_UNESCAPED_UNICODE);
?>
