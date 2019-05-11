<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $table = 'lop';
    public $timestamps = false;
    protected $primaryKey = 'maLop';
   
    public function Khoa()
    {
        return $this->belongsTo('App\Model\Khoa', 'MaKhoa','MaKhoa');
    }

    function SinhVien(){
        return $this->hasMany('App\Model\SinhVien','MaLop','MaLop');
    }

    
}
