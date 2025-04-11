<?php

namespace App\Jobs;

use App\Models\Beat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GenerateBeatPreview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $beat;

    public function __construct(Beat $beat)
    {
        $this->beat = $beat;
    }

    public function handle()
    {
        try {
            // Get the original audio file path
            $originalPath = storage_path('app/public/' . $this->beat->file_url);
            
            if (!file_exists($originalPath)) {
                throw new \Exception('Original audio file not found: ' . $originalPath);
            }

            // Generate preview filename
            $previewFilename = pathinfo($this->beat->file_url, PATHINFO_FILENAME) . '_preview.mp3';
            $previewPath = 'beats/previews/' . $previewFilename;
            $outputPath = storage_path('app/public/' . $previewPath);

            // Ensure previews directory exists
            if (!file_exists(storage_path('app/public/beats/previews'))) {
                mkdir(storage_path('app/public/beats/previews'), 0755, true);
            }

            // FFmpeg command to generate 30-second preview at 96kbps
            $command = sprintf(
                'ffmpeg -i "%s" -t 30 -c:a libmp3lame -b:a 96k -y "%s"',
                $originalPath,
                $outputPath
            );

            // Execute FFmpeg command
            exec($command, $output, $returnVar);

            if ($returnVar !== 0) {
                throw new \Exception('FFmpeg processing failed. Command: ' . $command);
            }

            // Update beat with preview URL
            $this->beat->update([
                'preview_url' => $previewPath
            ]);

            Log::info('Beat preview generated successfully', [
                'beat_id' => $this->beat->id,
                'preview_url' => $previewPath
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to generate beat preview', [
                'beat_id' => $this->beat->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // You might want to notify the admin about the failure
            // or implement a retry mechanism
        }
    }

    public function failed(\Throwable $exception)
    {
        Log::error('Beat preview generation job failed', [
            'beat_id' => $this->beat->id,
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ]);
    }
} 