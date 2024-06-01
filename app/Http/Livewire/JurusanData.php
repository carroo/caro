<?php

namespace App\Http\Livewire;

use App\Models\Jurusan;
use Livewire\Component;

class JurusanData extends Component
{
    public $form,$edit_id;
    public function render()
    {
        $this->dispatchBrowserEvent('reload'); 
        return view('livewire.jurusan-data',[
            'jurusan' =>  Jurusan::get(),
        ]);
    }
    public function simpan()
    {
        $this->validate([
            'form.jurusan' =>['required'],
            'form.lengkap' =>['required'],
        ]);
        if($this->edit_id){
            Jurusan::where('id',$this->edit_id)->update($this->form);
        }else{
            Jurusan::create($this->form);
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
        $data = Jurusan::where('id',$id)->first();
        $this->form = [
            'jurusan' => $data->jurusan,
            'lengkap' => $data->lengkap,
        ];
    }
    public function hapus($id)
    {
        
        Jurusan::where('id',$id)->delete();
        $this->dispatchBrowserEvent('swalsuccess');
    }
}
