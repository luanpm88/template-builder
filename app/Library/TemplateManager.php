<?php

namespace App\Library;

use File;

class TemplateManager
{
    public $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function readFromDir($path): array
    {
        $templateSchemas = [];
        $directories = File::directories($path);

        foreach ($directories as $directory) {
            $schema = $this->readSchemaByDir($directory);

            //
            $templateSchemas[] = $schema;
        }

        return $templateSchemas;
    }

    public function readSchemaByDir($directory)
    {
        //
        $schema = [];

        // @path
        $schema['path'] = basename($directory);

        // @Thumb
        $thumbPathPng = $directory . '/thumb.png';
        $thumbPathSvg = $directory . '/thumb.svg';

        if (File::exists($thumbPathSvg)) {
            $schema['thumb_path'] = basename($directory) . '/thumb.svg';
        } elseif (File::exists($thumbPathPng)) {
            $schema['thumb_path'] = basename($directory) . '/thumb.png';
        }

        // @title
        // Load the index.html file
        $filename = $directory . '/index.html';
        if (!file_exists($filename)) {
            die("File not found!");
        }

        $html = file_get_contents($filename);

        // Create a new DOMDocument
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Prevents warnings due to malformed HTML
        $dom->loadHTML($html);
        libxml_clear_errors();

        // Get the <title> tag content
        $titleTag = $dom->getElementsByTagName('title');

        if ($titleTag->length > 0) {
            $schema['title'] = $titleTag->item(0)->textContent;
        } else {
            $schema['title'] = "No title tag found!";
        }

        return $schema;
    }
}
