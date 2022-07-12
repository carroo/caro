<?php

namespace App\Http\Livewire;

use App\Mail\SendMail;
use App\Models\kelas as Dkelas;
use App\Models\KelasMurid;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Kelas extends Component
{
    public $form,$cari_kelas;
    public function render()
    {
        if(Auth::user()->level==0){
            $kelas = Dkelas::join('users','users.id','=','kelas.guru_id')
                            ->join('kelas_murid','kelas_murid.kelas_id','=','kelas.id')
                            ->where('kelas_murid.murid_id',Auth::user()->id)
                            ->select('kelas.*','users.name','users.photo')
                            ->get();
        }else{
            $kelas = Dkelas::join('users','users.id','=','kelas.guru_id')
                            ->where('kelas.guru_id',Auth::user()->id)
                            ->select('kelas.*','users.name','users.photo')
                            ->get();
        }
        return view('livewire.kelas',[
            'kelas' =>$kelas
        ]);
    }
    public function simpan()
    {
        $this->validate([
            'form.nama' =>['required','max:50'],
            'form.desc' =>['required','max:200'],
        ]);
        $this->form['kode'] = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
        $this->form['guru_id'] = Auth::user()->id;
        Dkelas::create($this->form);
        $this->form = '';
        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('swalsuccess','Berhasil membuat kelas');
    }
    public function cari_kelas()
    {
        // $mail = 0;
        $cekelas = Dkelas::where('kode',$this->cari_kelas)->first();
        if($cekelas){
            $cekmasuk = KelasMurid::where('kelas_id',$cekelas->id)->where('murid_id',Auth::user()->id)->first();
                if($cekmasuk){
                    $this->dispatchBrowserEvent('swalwarning','Kelas sudah dimasuki');
                }else{
                    KelasMurid::create([
                        'kelas_id' => $cekelas->id,
                        'murid_id' => Auth::user()->id
                    ]);
                    // $mail = 1;
                    // $this->dispatchBrowserEvent('swalsuccess','Berhasil masuk kelas');
                }
        }else{
            $this->dispatchBrowserEvent('swalerror','kelas tidak ada');
        }
        // if($mail == 1){
        //     $this->sendmail();
        // }
        // $this->dispatchBrowserEvent('closeModal');
    }
    // public function sendmail()
    // {
    //     $cekelas = Dkelas::where('kode',$this->cari_kelas)->first();
    //     $namemurid = Auth::user()->name;
    //     $emailguru = user::where('id',$cekelas->guru_id)->select('email','name')->first();
    //     $kirim = Mail::to($emailguru->email)->send(new SendMail($namemurid,$emailguru->name,$cekelas->nama,1));
    // }
}
