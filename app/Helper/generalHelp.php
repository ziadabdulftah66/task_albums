<?php
define('PAGINATION_COUNT',6);
/*
function getFolder(){
    return app()->getLocale()=='ar'?'css-rtl':'css';
}
*/
function uploadimage($folder,$photo){
    $photo->store('/',$folder);
  $filename=  $photo->hashname();
  return $filename;
}
function delete_photo($photo){
    $path=public_path().'/'.$photo;
    $path=str_replace('http://127.0.0.1:8000/','',$path);
    unlink($path);


}


