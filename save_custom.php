<?php
header('Content-Type: text/html; charset=UTF-8');

$title   = trim($_POST['title']);
$email   = trim($_POST['email']);
$content = trim($_POST['content']);
$date    = date("Y-m-d H:i:s");

if (!$title || !$email || !$content) {
    die("সব ঘর পূরণ করুন।");
}

$file = 'custom_texts.json';
$data = [];

if (file_exists($file)) {
    $data = json_decode(file_get_contents($file), true);
    if (!is_array($data)) $data = [];
}

$data[] = [
    'title'   => $title,
    'email'   => $email,
    'content' => $content,
    'date'    => $date
];

file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

echo "<script>alert('টেক্সট সংরক্ষণ করা হয়েছে!'); window.location.href='custom.html';</script>";
?>
