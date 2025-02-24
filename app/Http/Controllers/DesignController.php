<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class DesignController extends Controller
{
    public function index()
    {
        $manager = new \App\Library\TemplateManager(public_path('templates'));
        $templateItems = $manager->getAllTemplateItems();
        
        return view('design.index', [
            'templateItems' => $templateItems,
        ]);
    }

    public function previewWithBuilder($path)
    {
        $manager = new \App\Library\TemplateManager(public_path('templates'));
        $templateItem = $manager->getItemFromPath(public_path('templates') . '/' . $path);

        return view('design.previewWithBuilder', [
            'templateItem' => $templateItem,
        ]);
    }

    public function preview($path)
    {
        $manager = new \App\Library\TemplateManager(public_path('templates'));
        $templateItem = $manager->getItemFromPath(public_path('templates') . '/' . $path);

        // echo file_get_contents(public_path('templates') . '/' . $path . '/index.html');
        echo $templateItem->renderContent();
    }
}
