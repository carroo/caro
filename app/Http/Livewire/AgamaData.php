<?php

namespace App\Http\Livewire;

use App\Models\Agama;
use Livewire\Component;

class AgamaData extends Component
{
    public $form,$edit_id;
    public function render()
    {
        $this->dispatchBrowserEvent('reload'); 
        return view('livewire.agama-data',[
            'agama' =>  Agama::get(),
        ]);
    }
    public function simpan()
    {
        $this->validate([
            'form.agama' =>['required'],
        ]);
        if($this->edit_id){
            Agama::where('id',$this->edit_id)->update($this->form);
        }else{
            Agama::create($this->form);
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
        $data = Agama::where('id',$id)->first();
        $this->form = [
            'agama' => $data->agama,
        ];
    }
    public function hapus($id)
    {
        
        Agama::where('id',$id)->delete();
        $this->dispatchBrowserEvent('swalsuccess');
    }
}
