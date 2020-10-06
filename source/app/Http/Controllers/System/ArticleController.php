<?php
/**
 * Created by PhpStorm.
 * User: DiemND
 * Date: 1/31/2018
 * Time: 2:47 PM
 */

namespace App\Http\Controllers\System;


use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index () {
        $listCategoryArticle = App::make('categoryService')->query([
            'types' => ['news', 'help'],
            'status' => 'enable',
            'columns' => ['id', 'name']
        ])->get();
        return view('system.article.index',[
            'listCategory' => $listCategoryArticle
        ]);
    }

    public function tinymceImageDialog() {
        return view("system.tinymce.upload_image_dialog");
    }

    public function tinymceImageUpload() {
        try {

            $path = Input::get('path', '/upload/images/news/content/' . date('Y') . '/' . date('m') . '/');
            $file = Input::file("file_upload");
            $data = $this->fileUpload($file, $path);
            return view("system.tinymce.upload_image_success", array(
                "fileName" => $data,
            ));
        } catch (FileException $fe) {
            $response = array(
                'status' => 'fail',
                'message' => 'Xảy ra lỗi, vui lòng liên hệ bộ phận kĩ thuật để được xử lý.' . $fe->getMessage()
            );
            return response()->json($response);
        }
    }

    private function storeImage($image, $type = "parameter", $title = "", $return = 'file_name') {
        try {

            $mimeType = $image->getClientMimeType();
            if (!preg_match('/image/', $mimeType)) {
                throw new FileException("Only allowed to upload image");
            }

            //get-image-root-directory, create directory if it doesn't exist
            $rootImageDirectoryPath = $this->getParameter("rootImageDirectory.path", public_path() . DIRECTORY_SEPARATOR . "upload");
            if (!file_exists($rootImageDirectoryPath)) {
                mkdir($rootImageDirectoryPath);
            }

            $imageDirectoryName = $type;

            $year = date('Y');
            $month = date('m');
            $fileName = $this->getFriendlyString($title) . '-' . date("dmYHis") . '.' . strtolower($image->getClientOriginalExtension());
            if ($type == 'news_content') {
                $pathFile = "news/content/{$year}/{$month}/{$fileName}";
            } else {
                $pathFile = "{$type}/{$year}/{$month}/{$fileName}";
            }

            if ($type == "news_content") {
                $imageDirectoryPath = $rootImageDirectoryPath . DIRECTORY_SEPARATOR . "news";
                if (!File::isDirectory($imageDirectoryPath)) {
                    File::makeDirectory($imageDirectoryPath, 0777);
                }
                $imageDirectoryPath = $rootImageDirectoryPath . DIRECTORY_SEPARATOR . "news" . DIRECTORY_SEPARATOR . 'content';
            } else {
                $imageDirectoryPath = $rootImageDirectoryPath . DIRECTORY_SEPARATOR . $imageDirectoryName;
            }

            //stored in the form "upload/category/{year}/{month}/image_file"
            if (!File::isDirectory($imageDirectoryPath)) {
                File::makeDirectory($imageDirectoryPath, 0777);
            }
            if (!File::isDirectory($imageDirectoryPath . DIRECTORY_SEPARATOR . $year)) {
                File::makeDirectory($imageDirectoryPath . DIRECTORY_SEPARATOR . $year, 0777);
            }
            if (!File::isDirectory($imageDirectoryPath . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month)) {
                File::makeDirectory($imageDirectoryPath . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month, 0777);
            }
            $imageDirectoryPath = $imageDirectoryPath . DIRECTORY_SEPARATOR . $year . DIRECTORY_SEPARATOR . $month;
            $image->move($imageDirectoryPath, $fileName);

            //return
            if ($return == 'path') {
                return $pathFile;
            }
            return $fileName;
        } catch (\Exception $exc) {
            throw $exc;
        }
    }

    protected function getParameter($key, $defaultValue = null) {
        $retVal = $defaultValue;
        $parameter = Setting::where("key", "=", $key)
            ->first();
        if ($parameter != null) {
            $retVal = $parameter->value;
        }
        return $retVal;
    }

    protected function getFriendlyString($text, $allowUnder = false) {
        static $charMap = array(
            "à" => "a", "ả" => "a", "ã" => "a", "á" => "a", "ạ" => "a", "ă" => "a", "ằ" => "a", "ẳ" => "a", "ẵ" => "a", "ắ" => "a", "ặ" => "a", "â" => "a", "ầ" => "a", "ẩ" => "a", "ẫ" => "a", "ấ" => "a", "ậ" => "a",
            "đ" => "d",
            "è" => "e", "ẻ" => "e", "ẽ" => "e", "é" => "e", "ẹ" => "e", "ê" => "e", "ề" => "e", "ể" => "e", "ễ" => "e", "ế" => "e", "ệ" => "e",
            "ì" => "i", "ỉ" => "i", "ĩ" => "i", "í" => "i", "ị" => "i",
            "ò" => "o", "ỏ" => "o", "õ" => "o", "ó" => "o", "ọ" => "o", "ô" => "o", "ồ" => "o", "ổ" => "o", "ỗ" => "o", "ố" => "o", "ộ" => "o", "ơ" => "o", "ờ" => "o", "ở" => "o", "ỡ" => "o", "ớ" => "o", "ợ" => "o",
            "ù" => "u", "ủ" => "u", "ũ" => "u", "ú" => "u", "ụ" => "u", "ư" => "u", "ừ" => "u", "ử" => "u", "ữ" => "u", "ứ" => "u", "ự" => "u",
            "ỳ" => "y", "ỷ" => "y", "ỹ" => "y", "ý" => "y", "ỵ" => "y",
            "À" => "A", "Ả" => "A", "Ã" => "A", "Á" => "A", "Ạ" => "A", "Ă" => "A", "Ằ" => "A", "Ẳ" => "A", "Ẵ" => "A", "Ắ" => "A", "Ặ" => "A", "Â" => "A", "Ầ" => "A", "Ẩ" => "A", "Ẫ" => "A", "Ấ" => "A", "Ậ" => "A",
            "Đ" => "D",
            "È" => "E", "Ẻ" => "E", "Ẽ" => "E", "É" => "E", "Ẹ" => "E", "Ê" => "E", "Ề" => "E", "Ể" => "E", "Ễ" => "E", "Ế" => "E", "Ệ" => "E",
            "Ì" => "I", "Ỉ" => "I", "Ĩ" => "I", "Í" => "I", "Ị" => "I",
            "Ò" => "O", "Ỏ" => "O", "Õ" => "O", "Ó" => "O", "Ọ" => "O", "Ô" => "O", "Ồ" => "O", "Ổ" => "O", "Ỗ" => "O", "Ố" => "O", "Ộ" => "O", "Ơ" => "O", "Ờ" => "O", "Ở" => "O", "Ỡ" => "O", "Ớ" => "O", "Ợ" => "O",
            "Ù" => "U", "Ủ" => "U", "Ũ" => "U", "Ú" => "U", "Ụ" => "U", "Ư" => "U", "Ừ" => "U", "Ử" => "U", "Ữ" => "U", "Ứ" => "U", "Ự" => "U",
            "Ỳ" => "Y", "Ỷ" => "Y", "Ỹ" => "Y", "Ý" => "Y", "Ỵ" => "Y"
        );

        $text = strtr($text, $charMap);

        $text = $this->cleanUpSpecialChars($text, $allowUnder);
        return strtolower($text);
    }

    private function cleanUpSpecialChars($text, $allowUnder = false) {
        $regExpression = "`\W`i";
        if ($allowUnder)
            $regExpression = "`[^a-zA-Z0-9-]`i";

        $text = preg_replace(array($regExpression, "`[-]+`",), "-", $text);
        return trim($text, "-");
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

}