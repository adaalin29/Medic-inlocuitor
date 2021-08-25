<?php

namespace App\Http\Controllers;

use Spatie\Image\Image;
use Illuminate\Http\Request;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\Storage;

class ThumbController extends Controller
{
    
    private $thumbDisk = 'thumb';
    
    public function index($query, $file)
    {
        $queryArray = [];
        foreach (explode(';', $query) as $item) {
            if (strpos($item, ':') === false) continue;
            $item = explode(':', $item);
            $queryArray[$item[0]] = $item[1];
        }
        $fileDisk = 'public';
        // $fileDisk = isset($queryArray['disk']) ? $queryArray['disk'] : 'public';
        $thumbStorage = Storage::disk($this->thumbDisk);
        $fileStorage = Storage::disk($fileDisk);
        $thumbPath = "$query/$file";
        $thumbAbsolutePath = config("filesystems.disks.{$this->thumbDisk}.root")."/$thumbPath";
        
        if (!$fileStorage->exists($file)) abort(404);
        $thumbStorage->put($thumbPath, $fileStorage->get($file));
        
        $imageCrop = 'crop';
        $imageCropAccepted = ['contain', 'max', 'fill', 'stretch', 'crop'];
        if (isset($queryArray['crop']) && in_array($queryArray['crop'], $imageCropAccepted))
            $imageCrop = strtolower($queryArray['crop']);
        
        $imageOptimize = true;
        if (isset($queryArray['optimize']))
            $imageOptimize = boolval($queryArray['optimize']);
        
        $imageWidth = null;
        if (isset($queryArray['width']) && $queryArray['width'] !== 'auto')
            $imageWidth = intval($queryArray['width'], 10);
        
        $imageHeight = null;
        if (isset($queryArray['height']) && $queryArray['height'] !== 'auto')
            $imageHeight = intval($queryArray['height'], 10);
        
        $imageControl = Image::load($thumbAbsolutePath);
        
        if ($imageWidth && $imageHeight)
            $imageControl->fit($imageCrop, $imageWidth, $imageHeight);
        else if ($imageWidth)
            $imageControl->width($imageWidth);
        else if ($imageHeight)
            $imageControl->height($imageHeight);
        
        if ($imageOptimize) $imageControl->optimize();
        $imageControl->save($thumbAbsolutePath);
        
        return response()->file($thumbAbsolutePath);
    }
    
}