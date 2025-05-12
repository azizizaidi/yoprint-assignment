<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\Upload;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCsvUpload implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $upload;

    public function __construct(Upload $upload)
    {
        $this->upload = $upload;
    }

    public function handle(): void
    {
        $this->upload->update(['status' => 'processing']);

        $path = storage_path('app/private/' . $this->upload->filename);

        if (!file_exists($path)) {
            Log::error("CSV file not found: $path");
            $this->upload->update(['status' => 'failed']);
            return;
        }

        $file = fopen($path, 'r');
        if ($file === false) {
            Log::error("Failed to open CSV file: $path");
            $this->upload->update(['status' => 'failed']);
            return;
        }

        fgetcsv($file); // skip header

        while (($row = fgetcsv($file)) !== false) {
            // Ensure UTF-8 encoding
            $row = array_map(function ($cell) {
                return mb_convert_encoding($cell, 'UTF-8', 'UTF-8');
            }, $row);

            if (count($row) < 8 || !is_numeric($row[7])) {
                continue; // Skip invalid rows
            }

            Product::updateOrCreate(
                ['unique_key' => $row[0]],
                [
                    'upload_id'           => $this->upload->id,
                    'product_title'       => $row[1] ?? '',
                    'product_description' => $row[2] ?? '',
                    'style'               => $row[3] ?? '',
                    'mainframe_color'     => $row[4] ?? '',
                    'size'                => $row[5] ?? '',
                    'color_name'          => $row[6] ?? '',
                    'piece_price'         => $row[7] ?? 0,
                ]
            );
        }

        fclose($file);

        $this->upload->update([
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }
}
