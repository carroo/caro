<?php

namespace App\Http\Livewire;

use App\Models\Agama;
use App\Models\Feedback;
use App\Models\Like;
use App\Models\User;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\NilaiAspek;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public $chart;
    public $form,$photo;
    public $rated,$feedback,$data_feedback;
    public $id_profile;
    public $isguru;
    public function mount($profile){
        $this->chart = [
            (int)NilaiAspek::where('user',$profile)->avg('tanggung_jawab'),
            (int)NilaiAspek::where('user',$profile)->avg('kedisiplinan'),
            (int)NilaiAspek::where('user',$profile)->avg('sosialisasi'),
            (int)NilaiAspek::where('user',$profile)->avg('perilaku'),
            (int)NilaiAspek::where('user',$profile)->avg('keaktifan'),
        ];
        $data = User::where('users.id',$profile)
                    ->select('name','fullname','tgl_lahir','alamat','phone','email','agama')
                    ->first();
        $form = json_decode($data);
        $this->form = (array)$form;
        $this->id_profile = $profile;
        $this->rated = 0;
        $rate = Rate::where('dinilai',$this->id_profile)->where('penilai',Auth::user()->id)->first();
        if($rate){
            $this->rated = $rate->nilai;
        }
        $this->rated = '';
        $feedback = Feedback::where('diberi',$this->id_profile)->where('pemberi',Auth::user()->id)->first();
        if($feedback){
            $this->feedback = $feedback->feed;
        }
        $this->data_feedback = Feedback::where('diberi',$profile)->get();
        $this->isguru = User::where('id',$profile)->where('level',1)->first();
    }
    public function render()
    {
        if($this->isguru){
            $user = User::join('mapel','mapel.id','=','users.mapel')
                        ->join('agama','users.agama','=','agama.id')
                        ->where('users.id',$this->id_profile)
                        ->select('users.*','mapel.mapel as nmapel','agama.agama as nagama')
                        ->first();
        }else{
            $user = User::join('jurusan','jurusan.id','=','users.jurusan')
                        ->join('agama','users.agama','=','agama.id')
                        ->where('users.id',$this->id_profile)
                        ->select('users.*','jurusan.jurusan as njurusan','jurusan.lengkap as fulljurusan','agama.agama as nagama')
                        ->first();
        }
        return view('livewire.profile',[
            'profile'       => $user,
            'rate'          => Rate::where('dinilai',$this->id_profile)->avg('nilai'),
            'ratecount'     => Rate::where('dinilai',$this->id_profile)->count(),
            'like'          => Like::where('disuka',$this->id_profile)->count(),
            'ratingcount'   => Rate::where('penilai',$this->id_profile)->count(),
            'likingcount'   => Like::where('penyuka',$this->id_profile)->count(),
            'agama'         => Agama::get(),
            'liked'         => Like::where('disuka',$this->id_profile)->where('penyuka',Auth::user()->id)->first()
        ]);
    }
    public function updateprofile(){
        if($this->photo){
            $this->validate([
                'photo' => 'image|max:3072',
            ]);
            $name = md5( $this->id_profile .date('dmyhis')).'.'.$this->photo->extension();
            $this->photo->storeAs('public/photo',$name);
            $this->form['photo'] = $name;
            if(Auth::user()->photo){
                Storage::disk('public')->delete('photo/'.Auth::user()->photo);
            }
        }
           
        User::where('id',$this->id_profile)->update($this->form);
        $this->dispatchBrowserEvent('swalsuccess');
    }
    public function save_rate(){
        $cek = Rate::where('dinilai',$this->id_profile)->where('penilai',Auth::user()->id)->first();
        if($cek){
            Rate::where('dinilai',$this->id_profile)->where('penilai',Auth::user()->id)->update([
                'nilai'     => $this->rated,
            ]);
        }else{
            Rate::create([
                'penilai'   => Auth::user()->id,
                'dinilai'   => $this->id_profile,
                'nilai'     => $this->rated,
            ]);
        }
        $this->dispatchBrowserEvent('swalsuccess');
    }
    public function save_like(){
        $cek = Like::where('disuka',$this->id_profile)->where('penyuka',Auth::user()->id)->first();
        if($cek){
            Like::where('disuka',$this->id_profile)->where('penyuka',Auth::user()->id)->forcedelete();
        }else{
            Like::create([
                'penyuka'   => Auth::user()->id,
                'disuka'   => $this->id_profile,
            ]);
        }
    }
    public function save_feedback(){
        $cek = Feedback::where('diberi',$this->id_profile)->where('pemberi',Auth::user()->id)->first();
        if($cek){
            Feedback::where('diberi',$this->id_profile)->where('pemberi',Auth::user()->id)->update([
                'feed' => $this->feedback
            ]);
        }else{
            Feedback::create([
                'pemberi'   => Auth::user()->id,
                'diberi'    => $this->id_profile,
                'feed'      => $this->feedback
            ]);
        }
        $this->dispatchBrowserEvent('swalsuccess'); 
    }
}
