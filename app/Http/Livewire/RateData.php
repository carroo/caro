<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\Rate;
use App\Models\User;

class RateData extends Component
{
    public $nilai, $penilai, $dinilai;
    public $edit_id,$form;
    public function render()
    {
        
        $this->dispatchBrowserEvent('reload'); 
        return view('livewire.rate-data',[
            'dnilai' => Rate::get(),
            'dpenilai' => Rate::join('users','users.id','=','penilai')->get(),
            'ddinilai' => Rate::join('users','users.id','=','dinilai')->get(),
            'duser' => User::where('level','!=',2)->get()
        ]);
    }
    public function reset_form()
    {
        $this->penilai ="";
        $this->dinilai ="";
        $this->nilai ="";
        $this->edit_id ="";
    }
    public function simpan()
    {
        if($this->edit_id){
            $data = $this->validate([
                'penilai'   => 'required' ,
                'dinilai'   => 'required',
                'nilai'     => 'required',
            ]);
            Rate::where('id',$this->edit_id)->update($data);
            $this->reset_form();
            $this->dispatchBrowserEvent('closeModal'); 
            $this->dispatchBrowserEvent('swalsuccess');
        }else{
            $data = $this->validate([
                'penilai'   => 'required' ,
                'dinilai'   => 'required',
                'nilai'     => 'required',
            ]);
            Rate::create($data);
            $this->reset_form();
            $this->dispatchBrowserEvent('closeModal'); 
            $this->dispatchBrowserEvent('swalsuccess');
        }
    }
    public function edit($id)
    {
        $this->edit_id = $id;
        $data = Rate::where('id',$id)->first();
        $this->penilai = $data->penilai;
        $this->dinilai = $data->dinilai;
        $this->nilai = $data->nilai;
    }
    public function hapus($id)
    {
        Rate::where('id',$id)->delete();
        $this->dispatchBrowserEvent('swalsuccess');
    }
}
