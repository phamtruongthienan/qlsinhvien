<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model ;

class SinhVien extends Model
{
    protected $table = 'sinhvien';
    protected $primaryKey = 'maSV';
    public $timestamps = false;

   
    public function Lop(){
        return $this->belongsTo('App\Model\Lop','MaLop','MaLop');

    }

    // function categories(){
    //     return $this->belongsTo('App\Categories','id_type','id');
    // }

    // public function Khoa()
    // {
    //     return $this->has('App\Model\SinhVien',"App\Model\Khoa","maLop","maKhoa","maKhoa");
        
    // }
}
