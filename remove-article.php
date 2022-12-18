<?php

$filename = __DIR__ . '/data/articles.json';

$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if (!$id) {
    header('location: /');
} elseif ($id) {
    if (file_exists($filename)) {
        $articles = json_decode(file_get_contents($filename), true) ?? [];
        $articleIdex = array_search($id, array_column($articles, 'id'));
        array_splice($articles, $articleIdex, 1);
        file_put_contents($filename, json_encode($articles));
    }
}

header('location: /');
