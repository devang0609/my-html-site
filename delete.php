<?php
$folder = __DIR__;
$files = array_diff(scandir($folder), ['.', '..', 'delete.php']);

foreach ($files as $file) {
    $path = $folder . DIRECTORY_SEPARATOR . $file;
    if (is_dir($path)) {
        // Recursively delete folder
        $iterator = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
        $filesToDelete = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($filesToDelete as $item) {
            $item->isDir() ? rmdir($item) : unlink($item);
        }
        rmdir($path);
    } else {
        unlink($path);
    }
}

echo "✅ All files deleted (except this script)";
?>
