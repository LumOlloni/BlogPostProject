<?php

namespace App\Classes;

use Intervention\Image\Facades\Image;
use App\Post;
use App\Http\Requests\EditPostValidation;
use App\Http\Requests\PostValidation;
use File;

  class ImageService {

    public  function uploadEditImage($file , Post $post , EditPostValidation  $request){

      if ($request->hasFile($file)) {

        $files = $request->file($file);
       
       // for save original image
       $ImageUpload = Image::make($files);
       $originalPath = public_path('/images/');
       $ImageUpload->resize(340,340);

      //  Add watermark in image   
      //  $ImageUpload->insert(public_path('watermark/watermark.png'), 'bottom-right', 10, 10);

       $ImageUpload->save($originalPath.time().$files->getClientOriginalName());
        
       // for save thumnail image
       $thumbnailPath = public_path('/thumbnail/');
       $ImageUpload->resize(250,125);
       $ImageUpload = $ImageUpload->save($thumbnailPath.time().$files->getClientOriginalName());

        $this->deleteImage($post);
        
    
        $post->image = time().$files->getClientOriginalName(); 

        return $post->image;
      }
    }
    
    public function uploadCreateImage($file , Post $post , PostValidation  $request){

      if ($request->hasFile($file)) {

        $files = $request->file($file);
       
       // for save original image
       $ImageUpload = Image::make($files);
       $originalPath = public_path('/images/');
       $ImageUpload->resize(340,340);

      

       $ImageUpload->save($originalPath.time().$files->getClientOriginalName());
        
       // for save thumnail image
       $thumbnailPath = public_path('/thumbnail/');
       $ImageUpload->resize(250,125);
       $ImageUpload = $ImageUpload->save($thumbnailPath.time().$files->getClientOriginalName());

        // Insert Image name in database
        $post->image = time().$files->getClientOriginalName(); 

        return $post->image;
      }
    }


    public function deleteImage(Post $post){

        $oldImage = $post->image;
        $image_path = public_path('/images/' . $oldImage);
        $image_thumbnail = public_path('/thumbnail/' . $oldImage);

      if(File::exists($image_path) && File::exists($image_thumbnail) ) {
          File::delete($image_path);
          File::delete($image_thumbnail);
     }

    }
  }