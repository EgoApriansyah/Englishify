<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$materials = App\Models\Material::all();
foreach ($materials as $m) {
    echo "ID: " . $m->id . "\n";
    echo "Title: " . $m->title . "\n";
    // extract all src
    preg_match_all('/src="([^"]+)"/', $m->content, $matches);
    if (!empty($matches[1])) {
        foreach ($matches[1] as $index => $src) {
            echo "  src[" . $index . "]: " . $src . "\n";
        }
    } else {
        echo "  No src found.\n";
    }
    echo "---------------------------\n";
}
