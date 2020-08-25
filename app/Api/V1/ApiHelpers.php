<?php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

function upload_file($file , $target, $permission=null) 
{
    if($file){        
        $fileName = Str::random(60).'.'.$file->getClientOriginalExtension();
        $file_path = "documents/".$target."/".$fileName;

        $exists = Storage::disk('public')->exists($file_path);

        if($exists)
        {
            return upload_file($file , $target);
        }
    
        Storage::disk('public')->put($file_path, file_get_contents($file), $permission);     

        return $file_path;
    }
    else{
        return null;
    }
  
}

?>