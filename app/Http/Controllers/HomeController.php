<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Khoa;
use App\Model\Lop;
use App\Model\SinhVien;
use Yajra\DataTables\DataTables;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function testAPI()
    {
        return 'Pham Truong Thien An';
    }

    public function index()
    {
        $query = Khoa::all();
        // $query = Khoa::with('Lop')->get();
        // $query = Lop::with('SinhVien')->get();
        // $query = SinhVien::with('Lop')->get();
        // $query = Lop::with('Khoa')->get();
        // $query = Lop::with('Khoa')->where('MaLop','d15a002')->get();
        echo ($query);
    }

    public function GetKhoa()
    {
        $query = Khoa::all();
        echo ($query);
    }

    public function GetLop()
    {
        $query = Lop::all();
        echo ($query);
    }

    public function GetSinhVien()
    {
        $query = SinhVien::all();
        echo ($query);
    }

    public function index1()
    {
        // $flights = Lop::all();
        // dd( $flights);
        $query = Lop::with('Khoa')->get();
        echo ($query);
    }

    public function index2()
    {
        $flights = SinhVien::all();
        return $flights;
    }

    public function ajaxsinhvien()
    {
        $flights = SinhVien::all();
        return Datatables::of($flights)
            ->editColumn('GioiTinh', function ($v) {
                if ($v->GioiTinh == '1')
                    return "Nam";
                else
                    return "Nữ";
            })
            ->addColumn('action', function ($v) {
                return '<a class="table-action table-action-edit text-green cursor-pointer" data-id="' . $v->MaSV . '"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" 
            data-lang="1" data-id="' . $v->MaSV . '"><i class="fa fa-trash"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function ajaxkhoa()
    {
        $flights = Khoa::all();
        return Datatables::of($flights)
            ->addColumn('action', function ($v) {
                return '<a class="table-action table-action-edit text-green cursor-pointer" 
                data-id="' . $v->MaKhoa . '"><i class="fa fa-edit"></i></a>
                <a class="table-action text-red table-action-delete cursor-pointer" 
            data-lang="1" data-id="' . $v->MaKhoa . '"><i class="fa fa-trash"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function ajaxlop()
    {
        $flights = Lop::all();
        return Datatables::of($flights)
            ->addColumn('action', function ($v) {
                return '<a class="table-action table-action-edit text-green cursor-pointer" 
            data-id="' . $v->MaLop . '"><i class="fa fa-edit"></i></a><a 
            class="table-action text-red table-action-delete cursor-pointer" 
            data-lang="1" data-id="' . $v->MaLop . '"><i class="fa fa-trash"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function ajaxgetsinhvien(Request $request)
    {
        $flights = SinhVien::Where('MaSV', $request->id)->first();
        return response()->json(['code' => 200, 'msg' => "$request->id.Thành công", 'data' => $flights]);
    }

    public function ajaxgetkhoa(Request $request)
    {
        if (empty($request->id))
            return "Bạn chưa nhập gì";
        $flights = Khoa::Where('MaKhoa', $request->id)->first();
        return response()->json(['code' => 200, 'msg' => "$request->id.Thành công", 'data' => $flights]);
    }

    public function ajaxgetlop(Request $request)
    {
        $flights = Lop::Where('MaLop', $request->id)->first();
        return response()->json(['code' => 200, 'msg' => "$request->id.Thành công", 'data' => $flights]);
    }

    public function getloptheokhoa(Request $request)
    {
        $flights = Lop::Where('MaKhoa', $request->id)->get();
        return $flights;
    }

    public function getsinhvientheolop(Request $request)
    {
        $flights = SinhVien::Where('MaLop', $request->id)->get();
        return Datatables::of($flights)
            ->editColumn('GioiTinh', function ($v) {
                if ($v->GioiTinh == '1')
                    return "Nam";
                else
                    return "Nữ";
            })
            ->addColumn('action', function ($v) {
                return '<a class="table-action table-action-edit text-green cursor-pointer" data-id="' . $v->MaSV . '"><i class="fa fa-edit"></i></a><a class="table-action text-red table-action-delete cursor-pointer" 
            data-lang="1" data-id="' . $v->MaSV . '"><i class="fa fa-trash"></i></a>';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function ajax_khoa(Request $request)
    {
        if ($request->action == 'update' || $request->action == 'delete') {
            $query = Khoa::Where('MaKhoa', $request->id);
        }

        if ($request->action == 'update' || $request->action == 'insert') {
            $data = [];
            if (empty($request->addMaKhoa))
                return "Chưa nhập mã khoa";
            if (empty($request->addTenKhoa))
                return "Chưa nhập tên khoa";
            if ($request->has('addMaKhoa') && !empty($request->addMaKhoa)) {
                $data['MaKhoa'] = $request->addMaKhoa;
            }
            if ($request->has('addTenKhoa') && !empty($request->addTenKhoa)) {
                $data['TenKhoa'] = $request->addTenKhoa;
            }
        }
        if ($request->action == "insert") {
            $khoa = new Khoa;
            $khoa->insert($data);
            return response()->json(['code' => 200, 'msg' => 'Thêm thành công']);
        } else if ($request->action == "update") {
            $query->update($data);
            return response()->json(['code' => 200, 'msg' => 'Sửa thành công']);
        } else {
            $query->delete();
            return response()->json(['code' => 200, 'msg' => "$request->id.Xóa thành công"]);
        }
    }

    public function ajax_sinhvien(Request $request)
    {
        if ($request->action == 'update' || $request->action == 'delete') {
            $query = SinhVien::Where('MaSV', $request->id);
        }

        if ($request->action == 'update' || $request->action == 'insert') {
            $data = [];
            if (empty($request->addMaSV))
                return "Chưa nhập mã addMaSV";
            if (empty($request->addTenSV))
                return "Chưa nhập tên addTenSV";
            if (empty($request->addNgaySinh))
                return "Chưa nhập tên addNgaySinh";
            if (empty($request->addGioiTinh))
                return "Chưa nhập tên addGioiTinh";
            if (empty($request->addDiaChi))
                return "Chưa nhập tên addDiaChi";
            if (empty($request->addMaLop))
                return "Chưa nhập tên addMaLop";

            $data['MaSV'] = $request->addMaSV;
            $data['HoTen'] = $request->addTenSV;
            $data['NgaySinh'] = $request->addNgaySinh;
            $data['GioiTinh'] = $request->addGioiTinh;
            $data['DiaChi'] = $request->addDiaChi;
            $data['MaLop'] = $request->addMaLop;

            // if($request->has('addMaKhoa') && !empty($request->addMaKhoa)) {
            //     $data['MaKhoa'] = $request->addMaKhoa;
            // }
            // if($request->has('addTenKhoa') && !empty($request->addTenKhoa)) {
            //     $data['TenKhoa'] = $request->addTenKhoa;
            // }
        }
        if ($request->action == "insert") {
            $sinhvien = new SinhVien;
            $sinhvien->insert($data);
            return response()->json(['code' => 200, 'msg' => 'Thêm thành công sinh viên']);
        } else if ($request->action == "update") {
            $query->update($data);
            return response()->json(['code' => 200, 'msg' => 'Sửa thành công']);
        } else {
            $query->delete();
            return response()->json(['code' => 200, 'msg' => "$request->id.Xóa thành công"]);
        }
    }

    public function ajax_lop(Request $request)
    {
        if ($request->action == 'update' || $request->action == 'delete') {
            $query = Lop::Where('MaLop', $request->id);
        }

        if ($request->action == 'update' || $request->action == 'insert') {
            $data = [];
            if (empty($request->addMaLop))
                return "Chưa nhập mã addMaLop";
            if (empty($request->addTenLop))
                return "Chưa nhập tên addTenLop";
            if (empty($request->addMaKhoa))
                return "Chưa nhập tên addMaKhoa";

            $data['MaLop'] = $request->addMaLop;
            $data['TenLop'] = $request->addTenLop;
            $data['MaKhoa'] = $request->addMaKhoa;

            // if($request->has('addMaKhoa') && !empty($request->addMaKhoa)) {
            //     $data['MaKhoa'] = $request->addMaKhoa;
            // }
            // if($request->has('addTenKhoa') && !empty($request->addTenKhoa)) {
            //     $data['TenKhoa'] = $request->addTenKhoa;
            // }
        }
        if ($request->action == "insert") {
            $Lop = new Lop;
            $Lop->insert($data);
            return response()->json(['code' => 200, 'msg' => 'Thêm thành công sinh viên']);
        } else if ($request->action == "update") {
            $query->update($data);
            return response()->json(['code' => 200, 'msg' => 'Sửa thành công']);
        } else {
            $query->delete();
            return response()->json(['code' => 200, 'msg' => "$request->id.Xóa thành công"]);
        }
    }
    public function admin_level_school_index()
    {
        return view('theme.backend.page.level_school');
    }

    public function sinhvien_index()
    {
        $Lop = Lop::all();
        return view('theme.backend.page.sinhvien', [
            'data' => 'SinhVien',
            'Lop' => $Lop
        ]);
    }

    public function timkiem_index()
    {
        $Lop = Lop::all();
        $Khoa = Khoa::all();
        return view('theme.backend.page.timkiem', [
            'data' => 'Lop',
            'Lop' => $Lop,
            'Khoa' => $Khoa
        ]);
    }

    public function lop_index()
    {
        $Khoa = Khoa::all();
        return view('theme.backend.page.lop', [
            'data' => 'Lop',
            'Khoa' => $Khoa
        ]);
    }

    public function khoa_index()
    {
        return view('theme.backend.page.khoa', ['data' => 'Khoa']);
    }

    public function login()
    {
        return view('theme.backend.page.login', ['data' => 'Khoa']);
    }



    public function login_action(Request $request)
    {
        $rules = array(
            'email' => 'required',
            'password' => 'required|min:6'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.login')->withErrors('Vui lòng kiểm tra lại tài khoản');
        } else {
            try {
                $username = $request->email;
                $password = $request->password;
                //dd(Auth::attempt(['name' => $username, 'password' => $password]));
                if (Auth::attempt(['name' => $username, 'password' => $password])) {
                    return redirect()->route('homeh');
                } else
                    return redirect()->route('admin.login')->withErrors('Vui lòng kiểm tra lại tài khoản');
                //$user = $this->instance->postLoginAdmin($request);
                // if (!empty($user)) {
                //   return redirect()->route('home.sinhvien');
                // } else {
                // return redirect()->route('admin.login')->withErrors('Vui lòng kiểm tra lại tài khoản');
                // }
            } catch (\Exception $e) {
                dd($e);
                return redirect()->route('admin.login')->withErrors('$e Vui lòng kiểm tra lại tài khoản');
            }
        }
    }

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function addKhoa(Request $request)
    {
        // return $request;
        $data = [];
        if (empty($request->addMaKhoa))
            return "Chưa nhập mã khoa";
        if (empty($request->addTenKhoa))
            return "Chưa nhập tên khoa";
        if ($request->has('addMaKhoa') && !empty($request->addMaKhoa)) {
            $data['MaKhoa'] = $request->addMaKhoa;
        }
        if ($request->has('addTenKhoa') && !empty($request->addTenKhoa)) {
            $data['TenKhoa'] = $request->addTenKhoa;
        }
        try{
            $khoa = new Khoa;
            $khoa->insert($data);
            return "Thêm thành khoa công.";
        } catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình thêm khoa";
        }
       
    }

    public function deletekhoa(Request $request)
    {
        try{
            $query = Khoa::Where('MaKhoa', $request->deleteMaKhoa);
            $query->delete();
            return "Xóa thành công";
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình xóa khoa";
        }
        
    }

    public function updateKhoa(Request $request)
    {
        $data = [];
        if (empty($request->updateMaKhoa))
            return "Chưa nhập mã khoa";
        if (empty($request->updateTenKhoa))
            return "Chưa nhập tên khoa";
        if ($request->has('updateMaKhoa') && !empty($request->updateMaKhoa)) {
            $data['MaKhoa'] = $request->updateMaKhoa;
        }
        if ($request->has('updateTenKhoa') && !empty($request->updateTenKhoa)) {
            $data['TenKhoa'] = $request->updateTenKhoa;
        }
        try{
            $query = Khoa::Where('MaKhoa', $request->updateMaKhoa);
            $query->update($data);
            return "Sửa khoa thành công";
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình sửa khoa";
        }
        
    }

    public function addLop(Request $request)
    {
        // return $request;
        if (empty($request->addMaLop))
            return "Chưa nhập mã addMaLop";
        if (empty($request->addTenLop))
            return "Chưa nhập tên addTenLop";
        if (empty($request->addMaKhoa))
            return "Chưa nhập tên addMaKhoa";

        $data['MaLop'] = $request->addMaLop;
        $data['TenLop'] = $request->addTenLop;
        $data['MaKhoa'] = $request->addMaKhoa;

        try{
            $Lop = new Lop;
            $Lop->insert($data);
            return "Thêm thành công lớp";
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình thêm lớp";
        }
        
    }

    public function deleteLop(Request $request)
    {
        //return $request;
        if (empty($request->deleteid))
            return "Chưa nhập tên deleteid";
        
        try{
            $query = Lop::Where('MaLop', $request->deleteid);
            $query->delete();
            return "Xóa thành công" ;
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình xóa lớp";
        }
    }

    public function updateLop(Request $request)
    {
        if (empty($request->addMaLop))
            return "Chưa nhập mã addMaLop";
        if (empty($request->addTenLop))
            return "Chưa nhập tên addTenLop";
        if (empty($request->addMaKhoa))
            return "Chưa nhập tên addMaKhoa";

        try{
             $query = Lop::Where('MaLop', $request->addMaLop);
        $data['MaLop'] = $request->addMaLop;
        $data['TenLop'] = $request->addTenLop;
        $data['MaKhoa'] = $request->addMaKhoa;
        $query->update($data);
        return "Chỉnh sửa lớp thành công";
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình sửa lớp";
        }
        
    }

    public function addSinhVien(Request $request)
    {
        $data = [];
        if (empty($request->addMaSV))
            return "Chưa nhập mã addMaSV";
        if (empty($request->addTenSV))
            return "Chưa nhập tên addTenSV";
        if (empty($request->addNgaySinh))
            return "Chưa nhập tên addNgaySinh";
        if (empty($request->addGioiTinh))
            return "Chưa nhập tên addGioiTinh";
        if (empty($request->addDiaChi))
            return "Chưa nhập tên addDiaChi";
        if (empty($request->addMaLop))
            return "Chưa nhập tên addMaLop";

        $data['MaSV'] = $request->addMaSV;
        $data['HoTen'] = $request->addTenSV;
        $data['NgaySinh'] = $request->addNgaySinh;
        $data['GioiTinh'] = $request->addGioiTinh;
        $data['DiaChi'] = $request->addDiaChi;
        $data['MaLop'] = $request->addMaLop;

        
        try{
            $sinhvien = new SinhVien;
            $sinhvien->insert($data);
            return "Thêm thành công sinh viên.";
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình thêm sinh viên";
        }
    }

    public function deleteSinhVien(Request $request)
    {
        
        try{
            $query = SinhVien::Where('MaSV', $request->id);
            $query->delete();
            return "Xóa thành công";
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình xóa sinh viên";
        }
    }

    public function updateSinhVien(Request $request)
    {
        
        $data = [];
        if (empty($request->addMaSV))
            return "Chưa nhập mã addMaSV";
        if (empty($request->addTenSV))
            return "Chưa nhập tên addTenSV";
        if (empty($request->addNgaySinh))
            return "Chưa nhập tên addNgaySinh";
        if (empty($request->addGioiTinh))
            return "Chưa nhập tên addGioiTinh";
        if (empty($request->addDiaChi))
            return "Chưa nhập tên addDiaChi";
        if (empty($request->addMaLop))
            return "Chưa nhập tên addMaLop";

        
        $data['MaSV'] = $request->addMaSV;
        $data['HoTen'] = $request->addTenSV;
        $data['NgaySinh'] = $request->addNgaySinh;
        $data['GioiTinh'] = $request->addGioiTinh;
        $data['DiaChi'] = $request->addDiaChi;
        $data['MaLop'] = $request->addMaLop;

        
        try{
            $query = SinhVien::Where('MaSV', $request->addMaSV);
            $query->update($data);
            return "Chỉnh sửa sinh viên thành công";
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình sửa sinh viên";
        }
    }

    public function searchSinhVien(Request $request)
    {
        if (empty($request->id))
            return "Bạn chưa nhập gì";
        try{
            $flights = SinhVien::Where('MaSV','like', '%'.$request->id.'%')
        ->orWhere('HoTen','like', '%'.$request->id.'%')
        ->orWhere('MaLop','like', '%'.$request->id.'%')
        ->orWhere('DiaChi','like', '%'.$request->id.'%')
        ->get();
        return $flights;
        }
        catch (\Exception $e) {
            return "Xảy ra lỗi trong quá trình tìm kiếm";
        }
        
    }

    public function homeh()
    {
        return view('theme.backend.page.homeh', ['data' => 'Trang chủ']);
    }

}


