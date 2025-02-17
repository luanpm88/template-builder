<?php

namespace App\Library;

use File;
use DOMDocument;
use DOMXPath;
use DOMNode;

class TemplateItem
{
    public $path;
    public $baseName;
    public $title;
    public $thumbPath;
    public $content;


    public function __construct($path)
    {
        $this->path = $path;

        $this->init();
    }

    public function init()
    {
        //
        $schema = [];

        // @path
        $this->baseName = basename($this->path);

        // @Thumb
        $thumbPathPng = $this->path . '/thumb.png';
        $thumbPathSvg = $this->path . '/thumb.svg';

        if (File::exists($thumbPathSvg)) {
            $this->thumbPath = basename($this->path) . '/thumb.svg';
        } elseif (File::exists($thumbPathPng)) {
            $this->thumbPath = basename($this->path) . '/thumb.png';
        }

        // @title
        // Load the index.html file
        $filename = $this->path . '/index.html';
        if (!file_exists($filename)) {
            die("File not found!");
        }

        $this->content = file_get_contents($filename);

        // Create a new DOMDocument
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Prevents warnings due to malformed HTML
        $dom->loadHTML($this->content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        // Get the <title> tag content
        $titleTag = $dom->getElementsByTagName('title');

        if ($titleTag->length > 0) {
            $this->title = $titleTag->item(0)->textContent;
        } else {
            $this->title = "No title tag found!";
        }

        return $schema;
    }

    public function renderContent()
    {
        $content = $this->content;


        // Blocks processing...
        if (file_exists($this->path . '/blocks/')) {
            // 1. Blocks from /blocks
            $blocks = [];
            $blockFiles = File::files($this->path . '/blocks/');
            foreach ($blockFiles as $path) {
                $blocks[] = file_get_contents($path);
            }


            // 2. Append all blocks to the PageElement
            $html = $this->content;
            $dom = new DOMDocument();
            libxml_use_internal_errors(true); // Suppress warnings
            $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            // Find the target element
            $xpath = new DOMXPath($dom);
            $targetElement = $xpath->query('//*[@builder-element="PageElement"]')->item(0);

            if ($targetElement) {
                foreach ($blocks as $block) {
                    $fragmentDom = new DOMDocument();
                    libxml_use_internal_errors(true);
                    $fragmentDom->loadHTML(mb_convert_encoding($block, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                    libxml_clear_errors();

                    // Import each child node into the main document and append
                    foreach ($fragmentDom->childNodes as $child) {
                        $importedNode = $dom->importNode($child, true);
                        $targetElement->appendChild($importedNode);
                    }
                }
            }

            // Output the modified HTML
            $content = $dom->saveHTML();
        }




        //
        return $content;
    }
}
