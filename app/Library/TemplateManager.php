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

    public function getItemFromPath($path): TemplateItem
    {
        return new TemplateItem($path);
    }

    public function getAllTemplateItems(): array
    {
        $templateItems = [];
        $directories = File::directories($this->path);

        foreach ($directories as $path) {
            $templateItem = new TemplateItem($path);

            //
            $templateItems[] = $templateItem;
        }

        return $templateItems;
    }
}
