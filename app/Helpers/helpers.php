<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('formatFileSize')) {
    /**
     * Format file size to human readable format
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    function formatFileSize($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
