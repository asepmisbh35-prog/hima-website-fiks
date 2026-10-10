<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizer
{
    /**
     * Resize (downscale only) & compress an uploaded image, then store it.
     * Falls back to a plain, unmodified store() if GD is unavailable or
     * the file type isn't a supported raster image (so nothing ever breaks).
     *
     * @param  UploadedFile $file
     * @param  string       $directory  e.g. 'landing', 'profile-photos'
     * @param  string       $disk       e.g. 'public'
     * @param  int          $maxWidth   image is never upscaled beyond its original size
     * @param  int          $maxHeight
     * @param  int          $quality    0-100, applies to jpg/webp compression
     * @return string       stored relative path (usable with Storage::url())
     */
    public static function store(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        int $maxWidth = 1600,
        int $maxHeight = 1600,
        int $quality = 80
    ): string {
        $mime = $file->getMimeType();
        $supported = ['image/jpeg', 'image/png', 'image/webp'];

        if (!extension_loaded('gd') || !in_array($mime, $supported, true)) {
            return $file->store($directory, $disk);
        }

        $size = @getimagesize($file->getRealPath());
        if (!$size) {
            return $file->store($directory, $disk);
        }
        [$width, $height] = $size;

        $source = match ($mime) {
            'image/jpeg' => @imagecreatefromjpeg($file->getRealPath()),
            'image/png'  => @imagecreatefrompng($file->getRealPath()),
            'image/webp' => @imagecreatefromwebp($file->getRealPath()),
            default      => null,
        };

        if (!$source) {
            return $file->store($directory, $disk);
        }

        // Perbaiki orientasi foto dari HP (EXIF) supaya tidak kesimpan miring/terbalik
        if ($mime === 'image/jpeg' && function_exists('exif_read_data')) {
            $exif = @exif_read_data($file->getRealPath());
            if (!empty($exif['Orientation'])) {
                $rotated = match ($exif['Orientation']) {
                    3       => imagerotate($source, 180, 0),
                    6       => imagerotate($source, -90, 0),
                    8       => imagerotate($source, 90, 0),
                    default => null,
                };
                if ($rotated) {
                    $source = $rotated;
                    $width  = imagesx($source);
                    $height = imagesy($source);
                }
            }
        }

        // Hanya perkecil, tidak pernah diperbesar
        $ratio     = min($maxWidth / $width, $maxHeight / $height, 1);
        $newWidth  = max(1, (int) round($width * $ratio));
        $newHeight = max(1, (int) round($height * $ratio));

        $canvas = imagecreatetruecolor($newWidth, $newHeight);

        if (in_array($mime, ['image/png', 'image/webp'], true)) {
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
            imagefilledrectangle($canvas, 0, 0, $newWidth, $newHeight, $transparent);
        }

        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $extension = match ($mime) {
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp',
        };

        $filename     = Str::random(40) . '.' . $extension;
        $directory    = trim($directory, '/');
        $relativePath = $directory . '/' . $filename;

        Storage::disk($disk)->makeDirectory($directory);
        $fullPath = Storage::disk($disk)->path($relativePath);

        match ($mime) {
            'image/jpeg' => imagejpeg($canvas, $fullPath, $quality),
            'image/png'  => imagepng($canvas, $fullPath, (int) round(9 - ($quality / 100 * 9))),
            'image/webp' => imagewebp($canvas, $fullPath, $quality),
        };

        imagedestroy($source);
        imagedestroy($canvas);

        return $relativePath;
    }
}
