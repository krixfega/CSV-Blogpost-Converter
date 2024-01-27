<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class ImportWordpressData extends Command
{
    protected $signature = 'import:wordpress-data {file}';
    protected $description = 'Import WordPress data from a CSV file';

    public function handle()
    {
        $file = $this->argument('file');

        $csv = Reader::createFromPath($file, 'r');
        $csv->setHeaderOffset(0);

        $records = $csv->getRecords();

        foreach ($records as $record) {
            $title = $record['title'] ?? null;
            $content = $record['content'] ?? null;

            // Skip the record if both title and content are missing
            if ($title || $content) {
                $author = [
                    'id' => $record['author_id'] ?? null,
                    'login' => $record['author_login'] ?? null,
                    'email' => $record['author_email'] ?? null,
                    'display_name' => $record['author_display_name'] ?? null,
                    'first_name' => $record['author_first_name'] ?? null,
                    'last_name' => $record['author_last_name'] ?? null,
                ];

                // Insert author only if at least one of the author fields is present
                if (array_filter($author)) {
                    $authorId = DB::table('authors')->insertGetId($author);

                    DB::table('posts')->insert([
                        'title' => $title,
                        'content' => $content,
                        'author_id' => $authorId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    // If no author information, insert post without author
                    DB::table('posts')->insert([
                        'title' => $title,
                        'content' => $content,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->info('WordPress data imported successfully!');
    }
}
