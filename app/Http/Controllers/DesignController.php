<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class DesignController extends Controller
{
    public function index()
    {
        $manager = new \App\Library\TemplateManager(public_path('templates'));
        $templateSchemas = $manager->readFromDir(public_path('templates'));
        
        return view('design.index', [
            'templateSchemas' => $templateSchemas,
        ]);
    }

    public function previewWithBuilder($path)
    {
        $manager = new \App\Library\TemplateManager(public_path('templates'));
        $templateSchema = $manager->readSchemaByDir(public_path('templates') . '/' . $path);

        return view('design.previewWithBuilder', [
            'templateSchema' => $templateSchema,
        ]);
    }

    public function preview($path)
    {
        $manager = new \App\Library\TemplateManager(public_path('templates'));
        $templateSchema = $manager->readSchemaByDir(public_path('templates') . '/' . $path);

        echo file_get_contents(public_path('templates') . '/' . $path . '/index.html');
    }
}
