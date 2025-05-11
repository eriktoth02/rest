<?php
function save_to_json($filename, $data) {
    if (!file_exists("../data")) {
        mkdir("../data", 0755, true);
    }
    $file = "../data/" . $filename;

    if (file_exists($file)) {
        $existing = json_decode(file_get_contents($file), true);
        if (!is_array($existing)) $existing = [];
    } else {
        $existing = [];
    }

    $existing[] = $data;
    file_put_contents($file, json_encode($existing, JSON_PRETTY_PRINT));
}
?>