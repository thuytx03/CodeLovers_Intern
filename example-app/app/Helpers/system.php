<?php

function uploadImage($nameFolder, $file){
    $fileName=time().'_'.$file->getClientOriginalName();
    return $file->storeAs($nameFolder,$fileName,'public');
}




?>
