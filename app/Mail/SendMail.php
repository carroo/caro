<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name_murid,$name_guru,$nama_kelas,$type)
    {
        $this->name_murid = $name_murid;
        $this->name_guru = $name_guru;
        $this->nama_kelas = $nama_kelas;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->type==1){
            $title = "Seorang Siswa Bergabung Dengan Kelas Anda";
        }else{
            $title = "Seorang Siswa Meninggalkan Kelas Anda";
        }
        return $this->from('caturotect@gmail.coom')
                    ->view('mail.testmail')
                    ->subject($title)
                    ->with(
                    [
                        'type' => $this->type,
                        'guru' => $this->name_guru,
                        'murid' => $this->name_murid,
                        'kelas' => $this->nama_kelas,
                    ]);

    }
}
