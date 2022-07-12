<?php

namespace App\Http\Livewire;

use App\Models\Mapel;
use Livewire\Component;

class MapelData extends Component
{
    public $form,$edit_id;
    public function render()
    {
        $this->dispatchBrowserEvent('reload'); 
        return view('livewire.mapel-data',[
            'mapel' =>  Mapel::get(),
        ]);
    }
    public function simpan()
    {
        $this->validate([
            'form.mapel' =>['required'],
            'form.kode' =>['required'],
        ]);
        if($this->edit_id){
            Mapel::where('id',$this->edit_id)->update($this->form);
        }else{
            Mapel::create($this->form);
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
        $data = Mapel::where('id',$id)->first();
        $this->form = [
            'mapel' => $data->mapel,
            'kode' => $data->kode,
        ];
    }
    public function hapus($id)
    {
        
        Mapel::where('id',$id)->delete();
        $this->dispatchBrowserEvent('swalsuccess');
    }
}
