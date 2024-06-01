<?php

namespace App\Http\Livewire;

use App\Mail\SendMail;
use App\Models\kelas;
use App\Models\KelasMurid;
use App\Models\KelasTugas;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class KelasInfo extends Component
{
    public $kelas_info,$form_edit_kelas,$tugas_info,$form_tugas,$form_idtugas;
    public function mount($id)
    {
        $this->kelas_info = Kelas::where('id',$id)->first();
        $this->form_edit_kelas = [
            'nama' => $this->kelas_info->nama,
            'desc' => $this->kelas_info->desc,
        ];
    }
    public function render()
    {
        $this->dispatchBrowserEvent('reload');
        return view('livewire.kelas-info',[
            'kelasinfo' => kelas::join('users','users.id','=','kelas.guru_id')
                                ->where('kelas.id',$this->kelas_info->id)
                                ->select('kelas.*','users.name','users.photo')
                                ->first(),
            'murid' => KelasMurid::join('users','users.id','=','kelas_murid.murid_id')
                                ->join('jurusan','jurusan.id','=','users.jurusan')
                                ->where('kelas_id',$this->kelas_info->id)
                                ->select('users.name','users.kelas','jurusan.jurusan','kelas_murid.*')
                                ->get(),
            'kelas_tugas' => KelasTugas::where('kelas_id',$this->kelas_info->id)->get(),

        ]);
    }
    public function keluarkan_murid($id)
    {
        KelasMurid::where('murid_id',$id)->forcedelete();
        $this->dispatchBrowserEvent('swalsuccess','Berhasil mengeluarkan murid');
        $this->dispatchBrowserEvent('reload');
    }
    public function keluar_kelas()
    {
        KelasMurid::where('murid_id',Auth::user()->id)->where('kelas_id',$this->kelas_info->id)->forcedelete();
        // $namemurid = Auth::user()->name;
        // $kelas = kelas::where('id',$this->kelas_info->id)->first();
        // $guru = User::where('id',$kelas->guru_id)->select('email','name')->first();
        // $kirim = Mail::to($guru->email)->send(new SendMail($namemurid,$guru->name,$kelas->nama,2));
        return redirect('kelas');
    }
    public function hapus_tugas($id)
    {
        if($this->kelas_info->guru_id == Auth::user()->id){
            KelasTugas::where('id',$id)->delete();
            $this->dispatchBrowserEvent('swalsuccess','Tugas berhasil dihapus');
        }else{
            $this->dispatchBrowserEvent('swalerror','Gagal');
        }
        $this->dispatchBrowserEvent('reload');
    }
    public function simpan_edit_kelas()
    {
        $this->validate([
            'form_edit_kelas.nama' =>['required','max:50'],
            'form_edit_kelas.desc' =>['required','max:200'],
        ]);
        if($this->kelas_info->guru_id == Auth::user()->id){
            Kelas::where('id',$this->kelas_info->id)->update($this->form_edit_kelas);
            $this->dispatchBrowserEvent('closeModal'); 
            $this->dispatchBrowserEvent('swalsuccess','Berhasil diedit');
        }else{
            $this->dispatchBrowserEvent('closeModal'); 
            $this->dispatchBrowserEvent('swalerror','Gagal');
        }
    }
    public function simpan_tugas()
    {
        $this->validate([
            'form_tugas.nama_tugas' =>['required','max:50'],
            'form_tugas.deskripsi_tugas' =>['required'],
        ]);
        if($this->form_idtugas){

        }else{
            $this->form_tugas['kelas_id'] = $this->kelas_info->id;
            KelasTugas::create($this->form_tugas);
            $this->form_tugas = "";
            $this->dispatchBrowserEvent('closeModal'); 
            $this->dispatchBrowserEvent('swalsuccess','Berhasil ditambahkan');
        }
    }
    public function edit_tugas($id)
    {
        $data = KelasTugas::find($id);
        dd((array) $data->attributes);
        if($data){
            $this->form_tugas['nama_tugas'] = $data->nama_tugas;
            $this->form_tugas['deskripsi_tugas'] = $data->deskripsi_tugas;
        }

    }
    public function tugas_info($id)
    {
        $this->tugas_info = KelasTugas::where('id',$id)->first();
    }
}
