<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Exception;

class BookService
{
    /**
     * Upload a book file (PDF/EPUB) to the specified storage disk.
     *
     * @param UploadedFile $file
     * @param string $disk
     * @return string
     * @throws Exception
     */
    public function uploadBookFile(UploadedFile $file, string $disk = 'public'): string
    {
        $path = $file->store('books', $disk);

        if (!$path) {
            throw new Exception("Failed to upload the book file.");
        }

        return $path;
    }

    /**
     * Extract metadata from a given file path.
     * This is a placeholder for real PDF/EPUB parsing logic.
     *
     * @param string $filePath
     * @return array
     */
    public function extractMetadata(string $filePath): array
    {
        // Integration point for specific parsers (e.g. smalot/pdfparser)
        return [
            'pages' => null,
            'summary' => 'Extracted generic metadata placeholder.',
        ];
    }

    /**
     * Process cover image and convert to required formats using MediaLibrary.
     *
     * @param Book $book
     * @param UploadedFile $cover
     * @return void
     */
    public function processCover(Book $book, UploadedFile $cover): void
    {
        $book->addMedia($cover)
            ->toMediaCollection('covers');
    }
}
