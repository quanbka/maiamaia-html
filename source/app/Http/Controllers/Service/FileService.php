<?php
/**
 * Created by PhpStorm.
 * User: tuanpa
 * Date: 1/19/18
 * Time: 2:31 PM
 */


namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class FileService extends BaseService {

    public function __construct() {

    }

    public function get($path, Request $request)
    {
        $path = resource_path($path);
        $file = new File($path);
        $type = $file->getMimeType($path);
        $name = $file->getFilename();
        $headers = array('Content-Type' => $type);
        return response()->download($path, $name, $headers);
    }

    public function images(Request $request)
    {
        $path = $request->input('path', '/images/');
        $this->validate($request, [
            'images.*' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);
        $allImage = $request->file('images');
        $data = [];
        foreach ($allImage as $imageObj) {
            $data[] = $this->fileUpload($imageObj, $path);
        }
        return $this->response($data);

    }

    public function files(Request $request)
    {
        $allFiles = $request->file('files');
        foreach ($allFiles as $fileObj) {
            $data[] = $this->fileUpload($fileObj);
        }
        return $this->response($data);
    }

    public function unlink(Request $request)
    {
        $paths = $request->input('paths');
        foreach ($paths as $path) {
            $this->removeFileUpload($path);
        }
        return $this->response([]);
    }



    public function fileUpload($fileObj, $path = '/', $fileName = '')
    {
        $destinationPath = public_path($path);
        if(!$fileName){
            $fileName = str_slug($fileObj->getClientOriginalName()) . time();
            $fileName .= '.' . $fileObj->getClientOriginalExtension();
        }
        
        $fileObj->move($destinationPath, $fileName);
        return $path . $fileName;
    }

    public function removeFileUpload($filePath)
    {
        resource_path($filePath);
        @unlink(resource_path($filePath));
    }

}

