<?php

namespace App\Http\Livewire;

use App\Models\Like;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Guru extends Component
{
    public $cari;
    public $guru;
    public $rated,$ratedcount,$liked,$likedcount,$rate;
    public $frate,$rateid;
    public function render()
    {
        if(!$this->cari){$this->mount();}
        else{$this->cari();}
        return view('livewire.guru');
    }
    public function mount()
    {
        $this->guru =   User::join("mapel","users.mapel",'=','mapel.id')
                            ->where('level',1)
                            ->where('users.id','!=',Auth::user()->id)
                            ->select('users.*','mapel.mapel as nmapel')
                            ->get();
        $this->data_nilai();
    }
    public function data_nilai()
    {
        foreach ($this->guru as $key => $value) {
            $this->rate[$key] = Rate::where('dinilai',$value->id)->avg('nilai');
            $this->rated[$key] = Rate::where('dinilai',$value->id)->where('penilai',Auth::user()->id)->first();
            $this->liked[$key] = Like::where('disuka',$value->id)->where('penyuka',Auth::user()->id)->first();
            $this->ratedcount[$key] = Rate::where('dinilai',$value->id)->count();
            $this->likedcount[$key] = Like::where('disuka',$value->id)->count();
        }
    }
    public function save_like($id)
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
    public function modal_rate($id)
    {
        $cek = Rate::where('dinilai',$id)->where('penilai',Auth::user()->id)->first();
        if($cek){
            $this->frate = $cek->nilai;
            $this->rateid = $id;
        }else{
            $this->frate = '';
            $this->rateid = $id;
        }
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
    public function cari()
    {
        $this->guru =   User::join("mapel","users.mapel",'=','mapel.id')
                            ->where('level',1)
                            ->where('users.id','!=',Auth::user()->id)
                            ->where('nip','LIKE',$this->cari.'%')
                            ->orWhere('name','LIKE',$this->cari.'%')
                            ->select('users.*','mapel.mapel as nmapel')
                            ->get();
        $this->data_nilai();
    }
}
