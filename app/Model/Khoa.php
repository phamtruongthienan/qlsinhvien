<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model ;

class Khoa extends Model
{
    protected $table = 'khoa';
    public $timestamps = false;
    protected $primaryKey = 'maKhoa';
    
    public function Lop()
    {
        return $this->hasMany("App\Model\Lop", 'MaKhoa', 'MaKhoa');
    }

    // public function SinhVien()
    // {
    //     return $this->hasManyThrough('App\Model\SinhVien',"App\Model\Lop","maLop","maKhoa","maKhoa");
        
    // }

   
   
}
