<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use App\Models\KelasMurid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasInfoController extends Controller
{
    public function index(Request $request)
    {
        $auth = Auth::user();
        if($auth->level==0){
            $cek = KelasMurid::where('kelas_id',$request->id)->where('murid_id',$auth->id)->first();
            if($cek){
                return view('kelas.kelas-info',['kelas_id' => $request->id]);
            }else{
                return redirect('kelas');
            }
        }elseif($auth->level==1){
            $cek = kelas::where('id',$request->id)->where('guru_id',$auth->id)->first();
            if($cek){
                return view('kelas.kelas-info',['kelas_id' => $request->id]);
            }else{
                return redirect('kelas');
            }
        }
        else{
            return view('kelas.kelas-info',['kelas_id' => $request->id]);
        }
    }
}
