<?php

namespace App\Jobs;

use App\Models\Beat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class GenerateBeatPreview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Beat $beat;

    /**
     * Create a new job instance.
     */
    public function __construct(Beat $beat)
    {
        $this->beat = $beat;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $fileUrl = $this->beat->file_url;

            if (!$fileUrl || !str_contains($fileUrl, 'res.cloudinary.com')) {
                throw new \Exception("Invalid or missing Cloudinary file URL.");
            }

            $publicId = $this->extractPublicId($fileUrl);

            // Generate preview URL using Cloudinary transformation
            $previewUrl = Cloudinary::video($publicId)
                ->format('mp3')
                ->transformation([
                    'audio_codec'  => 'mp3',
                    'start_offset' => 0,
                    'end_offset'   => 30,
                    'bit_rate'     => '96k',
                ])
                ->secure() // ensure HTTPS
                ->toUrl();

            $this->beat->update([
                'preview_url' => $previewUrl,
            ]);

            Log::info('Cloudinary preview generated successfully.', [
                'beat_id'     => $this->beat->id,
                'preview_url' => $previewUrl,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error generating Cloudinary preview.', [
                'beat_id' => $this->beat->id,
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('GenerateBeatPreview job failed.', [
            'beat_id' => $this->beat->id,
            'error'   => $exception->getMessage(),
            'trace'   => $exception->getTraceAsString(),
        ]);
    }

    /**
     * Extract Cloudinary public_id from a Cloudinary file URL.
     */
    protected function extractPublicId(string $url): string
    {
        $path = parse_url($url, PHP_URL_PATH); // e.g. /your-cloud/video/upload/v1234567890/folder/filename.mp3
        $segments = explode('/', trim($path, '/'));
        $uploadIndex = array_search('upload', $segments);

        if ($uploadIndex === false || !isset($segments[$uploadIndex + 1])) {
            throw new \Exception("Cloudinary URL structure is invalid.");
        }

        // Remove version and extension
        $publicPathSegments = array_slice($segments, $uploadIndex + 1);
        if (preg_match('/^v\d+$/', $publicPathSegments[0])) {
            array_shift($publicPathSegments);
        }

        $publicIdWithExtension = implode('/', $publicPathSegments);
        $publicId = preg_replace('/\.[a-z0-9]+$/i', '', $publicIdWithExtension);

        return $publicId;
    }
}
