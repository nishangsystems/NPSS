<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function renderImage($filename) {
      $path = storage_path() . '/app/files/' . $filename;

      if(!\File::exists($path)) abort(404);

      $file = \File::get($path);
      $type = \File::mimeType($path);

      $response = \Response::make($file, 200);
      $response->header("Content-Type", $type);

      return $response;
    }
}
