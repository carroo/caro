<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Rate;
use App\Models\Like;
use App\Models\NilaiAspek;
use Illuminate\Support\Facades\Auth;

class Murid extends Component
{
    public $dnisn,$djurusan,$dkelas;
    public $murid,$jurusan;
    public $rated,$ratedcount,$liked,$likedcount,$ratedaspek;
    public $frate,$rateid,$formaspek,$formaspekid;
    public $drate;
    public function render()
    {
        if(!$this->dnisn && !$this->djurusan && !$this->dkelas){$this->mount();}
        elseif($this->djurusan){$this->cjurusan();}
        elseif($this->dkelas){$this->ckelas();}
        elseif($this->dnisn){$this->carinisn();}
        return view('livewire.murid');
    }
    function mount()
    {
        $this->jurusan = Jurusan::get();
        $this->murid = User::join('jurusan','jurusan.id','=','users.jurusan')
                ->Where('level',0)
                ->where('users.id','!=',Auth::user()->id)
                ->select('users.*','jurusan.jurusan as njurusan')
                ->get();
        $this->crate();
    }
    public function carinisn()
    {
        $this->murid =  User::join('jurusan','jurusan.id','=','users.jurusan')
                        ->Where('level',0)
                        ->Where('nisn','LIKE',$this->dnisn.'%')
                        ->orWhere('users.name','LIKE',$this->dnisn.'%')
                        ->where('users.id','!=',Auth::user()->id)
                        ->select('users.*','jurusan.jurusan as njurusan')
                        ->get();
        $this->djurusan = "";
        $this->dkelas = "";
        $this->crate();
    }
    public function ckelas()
    {
        if($this->djurusan){
            $this->murid =  User::join('jurusan','jurusan.id','=','users.jurusan')
                                ->Where('users.jurusan',$this->djurusan)
                                ->Where('kelas',$this->dkelas)
                                ->Where('level',0)
                                ->where('users.id','!=',Auth::user()->id)
                                ->select('users.*','jurusan.jurusan as njurusan')
                                ->get();
        }else{
        $this->murid =  User::join('jurusan','jurusan.id','=','users.jurusan')
                            ->Where('kelas',$this->dkelas)
                            ->Where('level',0)
                            ->where('users.id','!=',Auth::user()->id)
                            ->select('users.*','jurusan.jurusan as njurusan')
                            ->get();
        }
        $this->dnisn = "";
        $this->crate();
    }
    public function cjurusan()
    {
        if($this->dkelas){
            $this->murid =  User::join('jurusan','jurusan.id','=','users.jurusan')
                                ->Where('users.jurusan',$this->djurusan)
                                ->Where('kelas',$this->dkelas)
                                ->Where('level',0)
                                ->where('users.id','!=',Auth::user()->id)
                                ->select('users.*','jurusan.jurusan as njurusan')
                                ->get();
        }else{
        $this->murid =  User::join('jurusan','jurusan.id','=','users.jurusan')
                            ->Where('users.jurusan',$this->djurusan)
                            ->Where('level',0)
                            ->where('users.id','!=',Auth::user()->id)
                            ->select('users.*','jurusan.jurusan as njurusan')
                            ->get();

        }
        $this->dnisn="";
        $this->crate();
    }
    public function crate()
    {
        foreach ($this->murid as $key => $value) {
            $this->drate[$key] = Rate::where('dinilai',$value->id)->avg('nilai');
            $this->rated[$key] = Rate::where('dinilai',$value->id)->where('penilai',Auth::user()->id)->first();
            $this->ratedaspek[$key] = NilaiAspek::where('user',$value->id)->where('guru',Auth::user()->id)->first();
            $this->liked[$key] = Like::where('disuka',$value->id)->where('penyuka',Auth::user()->id)->first();
            $this->ratedcount[$key] = Rate::where('dinilai',$value->id)->count();
            $this->likedcount[$key] = Like::where('disuka',$value->id)->count();
        }
    }
    public function rating($id)
    {
        $cek = Rate::where('dinilai',$id)->where('penilai',Auth::user()->id)->first();
        if($cek){
            $this->frate = $cek->nilai;
        }else{
            $this->frate = '';
        }
        $this->rateid = $id;
    }
    public function save_rate()
    {
        $cek = Rate::where('dinilai',$this->rateid)->where('penilai',Auth::user()->id)->first();
        if($cek){
            Rate::where('dinilai',$this->rateid)->where('penilai',Auth::user()->id)->update([
                'nilai'     => $this->frate,
            ]);
        }else{
            Rate::create([
                'penilai'   => Auth::user()->id,
                'dinilai'   => $this->rateid,
                'nilai'     => $this->frate,
            ]);
        }
        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('swalsuccess');
    }
    public function liking($id)
    {
        $cek = Like::where('disuka',$id)->where('penyuka',Auth::user()->id)->first();
        if($cek){
            Like::where('disuka',$id)->where('penyuka',Auth::user()->id)->forcedelete();
        }else{
            Like::create([
                'penyuka'   => Auth::user()->id,
                'disuka'   => $id,
            ]);
        }
    }
    public function rating_aspek($id)
    {
        $cek = NilaiAspek::where('user',$id)->where('guru',Auth::user()->id)->first();
        if($cek){
            $this->formaspek = [
                'tanggung_jawab' => $cek->tanggung_jawab,
                'kedisiplinan' => $cek->kedisiplinan,
                'sosialisasi' => $cek->sosialisasi,
                'perilaku' => $cek->perilaku,
                'keaktifan' => $cek->keaktifan,
            ];
        }else{
            $this->formaspek = '';
        }
            $this->formaspekid = $id;
    }
    public function simpan_aspek()
    {
        $cek = NilaiAspek::where('user',$this->formaspekid)->where('guru',Auth::user()->id)->first();
        if($cek){
            NilaiAspek::where('user',$this->formaspekid)->where('guru',Auth::user()->id)->update($this->formaspek);
        }else{
            $this->formaspek['user'] = $this->formaspekid;
            $this->formaspek['guru'] = Auth::user()->id;
            NilaiAspek::create($this->formaspek);
        }
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('swallsuccess'); 
    }
}
