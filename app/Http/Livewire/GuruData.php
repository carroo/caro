<?php

namespace App\Http\Livewire;

use App\Models\Agama;
use App\Models\Mapel;
use App\Models\User;
use Livewire\Component;

class GuruData extends Component
{
    public $form,$edit_id;
    public function render()
    {
        $this->dispatchBrowserEvent('reload'); 
        return view('livewire.guru-data',[
            'guru' =>  User::join('mapel','mapel.id','=','users.mapel')
                            ->join('agama','users.agama','=','agama.id')
                            ->where('level',1)
                            ->select('users.*','mapel.mapel as nmapel','agama.agama as nagama')
                            ->get(),
            'agama' =>  Agama::get(),
            'mapel' =>  mapel::get()
        ]);
    }
    public function simpan()
    {
        $this->validate([
            'form.name' =>['required'],
            'form.fullname' =>['required'],
            'form.email' =>['required'],
            'form.mapel' =>['required'],
            'form.nip' =>['required'],
            'form.tgl_lahir' =>['required'],
            'form.phone' =>['required'],
            'form.agama' =>['required'],
            'form.kelamin' =>['required'],
        ]);
        if($this->edit_id){
            User::where('id',$this->edit_id)->update($this->form);
        }else{
            $this->form['level'] = 1;
            User::create($this->form);
        }
        $this->reset_form();
        $this->dispatchBrowserEvent('closeModal'); 
        $this->dispatchBrowserEvent('swalsuccess');
    }
    public function reset_form()
    {
        $this->form = [];
        $this->edit_id = '';
    }
    public function edit($id)
    {
        $this->edit_id =  $id;
        $data = User::where('id',$id)->first();
        $this->form = [
            'name' => $data->name,
            'fullname' => $data->fullname,
            'email' => $data->email,
            'mapel' => $data->mapel,
            'nip' => $data->nip,
            'tgl_lahir' => $data->tgl_lahir,
            'phone' => $data->phone,
            'agama' => $data->agama,
            'kelamin' => $data->kelamin,
        ];
    }
    public function hapus($id)
    {
        
        User::where('id',$id)->delete();
        $this->dispatchBrowserEvent('swalsuccess');
    }
}
