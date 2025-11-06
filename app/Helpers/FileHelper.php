<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * Format file size to human readable format
     */
    public static function formatFileSize($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = (float) max($bytes, 0);
        $pow = $bytes > 0 ? floor(log($bytes) / log(1024)) : 0;
        $pow = min($pow, count($units) - 1);
        $bytes = $bytes > 0 ? $bytes / (1 << (10 * $pow)) : 0;

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Get file info with formatted size
     */
    public static function getFileInfo($filePath, $fileSize = null)
    {
        $fullPath = 'public/' . ltrim($filePath, '/');
        $size = $fileSize ?: (Storage::exists($fullPath) ? Storage::size($fullPath) : 0);
        
        return [
            'path' => $filePath,
            'size' => $size,
            'formatted_size' => $size ? self::formatFileSize($size) : 'Unknown size',
            'extension' => pathinfo($filePath, PATHINFO_EXTENSION),
        ];
    }
}
