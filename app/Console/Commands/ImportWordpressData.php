<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SimpleXMLElement;

class ImportWordpressData extends Command
{
    protected $signature = 'import:wordpress-data {file}';

    protected $description = 'Import WordPress data from XML file';

    public function handle(): void
    {
        $file = $this->argument('file');
        $xml = simplexml_load_file($file);

        $xml->registerXPathNamespace('wp', 'http://wordpress.org/export/1.2/');
        $xml->registerXPathNamespace('content', 'http://purl.org/rss/1.0/modules/content/');

        foreach ($xml->channel->item as $item) {
            // Get post type
            $postType = (string)$item->children('wp', true)->post_type;

            // Process the content to extract text within paragraphs
            $content = (string)$item->children('http://purl.org/rss/1.0/modules/content/', true)->encoded;

            // Extract text within <!-- wp:paragraph --> elements
            preg_match_all('/<!-- wp:paragraph -->(.*?)<!-- \/wp:paragraph -->/s', $content, $matches);

            // Combine extracted content into a single string
            $contentText = implode("\n", $matches[1]);

            // Update the $post array with the extracted content
            $post['content'] = $contentText;

            // Check if the title and content elements exist
            if (isset($item->title, $item->children('content', true)->encoded)) {
                $title = (string)$item->title;
                $content = (string)$item->children('content', true)->encoded;

                // Handle different post types
                if ($postType === 'music') {
                    $oembed = (string)$item->xpath('wp:postmeta[wp:meta_key="_oembed"]')[0]->children('wp', true)->meta_value;
                    $oembedTime = (string)$item->xpath('wp:postmeta[wp:meta_key="_oembed_time"]')[0]->children('wp', true)->meta_value;

                    // Insert music post data into the database
                    $this->insertMusicPost($title, $content, $oembed, $oembedTime);
                } else {
                    // Handle regular post
                    $this->insertRegularPost($title, $content);
                }
            } else {
                $this->warn('Skipping record due to missing title and content.');
                $this->outputSkippedRecord($item);
            }
        }

        $this->info('WordPress data import process completed.');
    }

    protected function insertMusicPost($title, $content, $oembed, $oembedTime): void
    {
        // Handle insertion of music post data into the database
        // You need to adjust this part based on your database schema
        // Example:
        DB::table('music_posts')->insert(array(
            'title' => $title,
            'content' => $content,
            'oembed' => $oembed,
            'oembed_time' => $oembedTime,
            'created_at' => now(),
            'updated_at' => now(),
        ));
    }

    protected function insertRegularPost($title, $content): void
    {
        // Handle insertion of regular post data into the database
        // You need to adjust this part based on your database schema
        // Example:
        DB::table('posts')->insert(array(
            'title' => $title,
            'content' => $content,
            'created_at' => now(),
            'updated_at' => now(),
        ));
    }

    protected function outputSkippedRecord(SimpleXMLElement $record): void
    {
        $this->line('Skipping record:');
        $this->line($record->asXML());
        $this->line('---');
    }
}
