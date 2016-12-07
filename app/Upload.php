<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    public function uploadedFiles(){
        return $this->hasMany(UploadedFile::class);
    }
}
