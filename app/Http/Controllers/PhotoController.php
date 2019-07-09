<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Repository;
use App\Models\Event;
use App\Models\RegisteredUser;

class PhotoController extends Controller
{
    //
    protected $event;
    protected $payment;

    public function __construct(Event $model, RegisteredUser $ru)
    {   
        $this->event = new Repository($model);
        $this->payment = new Repository($ru);
    }

    public function display_image($imageType, $id = null){
        if(!$id){
            
        }
        $imageFile = storage_path("app/public/");

        $id = decrypt($id);
        if($imageType == 'event'){
            $object = $this->event->show($id);
            $imageFile .= $object->header_image;
        }

        if($imageType == 'slip'){
            $object = $this->payment->show($id);
            $imageFile .= $object->supporting_doc;   
        }
        // dd($imageFile);
        if($object){
            $file = $imageFile;
            $ext = explode('.',$file);
            $ext = strtolower($ext[count($ext) - 1]);
            
            switch($ext){
                case "pdf":
                    header('Content-type:application/pdf');
                    break;
                case "jpeg":
                case "jpg":
                    header('Content-type:image/jpeg');
                    break;
                case "png":
                    header('Content-type:image/png');
                    break;
            }
            
            readfile($file);
        }

    }
}
