<?php
function img_process($img,$path){
            try{ 
          if($img != null ){
               $imageDir = $path;
         $data = explode(',', $img );
          $milli = round(microtime(true) * 1000);
           $value = base64_decode($data[1]);
      $ext = "";
       $source_img = imagecreatefromstring($value);
      if($data[0] == "data:image/png;base64" ){
        $ext = "png";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagepng($source_img, $output_file, 9);
      }
     
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
         $imageSave = imagejpeg($source_img, $output_file, 100);
      }
      elseif($data[0] == "data:image/jpeg;base64" ){
        $ext = "jpg";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagejpeg($source_img, $output_file, 100);
      }
       elseif($data[0] == "data:image/gif;base64" ){
        $ext = "gif";
        $output_file = $imageDir.'/'.$milli.'.'.$ext;
        $imageSave = imagegif($source_img, $output_file, 100);
      }
      else
      {

        exit;
      }
    
        imagedestroy($source_img);
        file_put_contents($output_file, $value);
        $array = [];
        $array[0]= $milli;
        $array[1]= $ext;
        return $array;
}
else{
    return false;
}
}
  catch(\Exception $e){

                return response()->json(['status'=>$e->getMessage()], 500);
            }
    }


//for pdf uploads
    function pdf_process($file,$path){
     try{
       if($file !=null){
         $data = explode(',', $file );
           $milli = round(microtime(true) * 1000);
          $value = base64_decode($data[1]);
         $ext = "";
          if($data[0] == "data:application/pdf;base64" ){
           $ext = "pdf";
           $output_file = $path.'/'.$milli.'.'.$ext;
           $value = base64_decode($data[1]);
            file_put_contents($output_file,$value);
            $array = [];
             $array[0]= $milli;
             $array[1]= $ext;
           return $array;
          }
          else{
            return false;
          }
   
       }
       else{
   return false;
     }
     }
     catch(\Exception $e){
       return response()->json(['status'=>$e->getMessage()], 500);
     }

   }

?>