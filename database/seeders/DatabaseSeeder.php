<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
             'name' => 'admin',
             'email' => 'admin@mail.com',
             'password' => Hash::make('password'),
             'level' => 2,
        ]);
        \App\Models\User::create([
            'name' => 'Look Man',
            'fullname' => 'look man guru besar rpl',
            'email' => 'guru@mail.com',
            'password' => Hash::make('password'),
            'level' => 1,
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
            'mapel' => 1,
            'nip' => rand(),
        ]);
        \App\Models\User::create([
            'name' => 'Pinasti',
            'fullname' => 'PIN guru besar rpl',
            'email' => 'guru1@mail.com',
            'password' => Hash::make('password'),
            'level' => 1,
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
            'mapel' => 1,
            'nip' => rand(),
        ]);
        \App\Models\User::create([
            'name' => 'catur',
            'fullname' => 'catur hendra putra pamungkas',
            'email' => 'catur@mail.com',
            'password' => Hash::make('password'),
            'kelas' => 12,
            'jurusan'=> 1,
            'nisn' => rand(),
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
        ]);
        \App\Models\User::create([
            'name' => 'ferry',
            'email' => 'ferry@mail.com',
            'password' => Hash::make('password'),
            'kelas' => 12,
            'jurusan'=> 1,
            'nisn' => rand(),
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
        ]);
        \App\Models\User::create([
            'name' => 'falka',
            'email' => 'falka@mail.com',
            'password' => Hash::make('password'),
            'kelas' => 12,
            'jurusan'=> 1,
            'nisn' => rand(),
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
        ]);
        \App\Models\User::create([
            'name' => 'abidiin',
            'email' => 'abidiin@mail.com',
            'password' => Hash::make('password'),
            'kelas' => 12,
            'jurusan'=> 1,
            'nisn' => rand(),
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
        ]);
        \App\Models\User::create([
            'name' => 'diaz',
            'email' => 'diaz@mail.com',
            'password' => Hash::make('password'),
            'kelas' => 12,
            'jurusan'=> 1,
            'nisn' => rand(),
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
        ]);
        \App\Models\User::create([
            'name' => 'bitang',
            'email' => 'bintang@mail.com',
            'password' => Hash::make('password'),
            'kelas' => 12,
            'jurusan'=> 1,
            'nisn' => rand(),
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
        ]);
        \App\Models\User::create([
            'name' => 'aldi',
            'email' => 'aldi@mail.com',
            'password' => Hash::make('password'),
            'kelas' => 12,
            'jurusan'=> 1,
            'nisn' => rand(),
            'alamat' => 'surabaya',
            'tgl_lahir' => date('yy-m-d'),
            'phone' => rand(),
            'agama' => 1,
            'kelamin' => 1,
        ]);
        \App\Models\Agama::create([
            "agama" => "islam"
        ]);
        \App\Models\Agama::create([
            "agama" => "kristen"
        ]);
        \App\Models\Agama::create([
            "agama" => "katolik"
        ]);
        \App\Models\Agama::create([
            "agama" => "budha"
        ]);
        \App\Models\Agama::create([
            "agama" => "hindu"
        ]);
        \App\Models\Agama::create([
            "agama" => "lainnya"
        ]);
        \App\Models\Jurusan::create([
            "jurusan" => "RPL",
            "lengkap" => "Rekayasa Perangkat Lunak"
        ]);
        \App\Models\Jurusan::create([
            "jurusan" => "TKJ",
            "lengkap" => "Teknik Komputer Jaringan"
        ]);
        \App\Models\NilaiAspek::create([
            "user" => "3",
            "guru" => "2",
            "tanggung_jawab" => 8,
            "kedisiplinan" => 9,
            "sosialisasi" => 6,
            "perilaku" => 7,
            "keaktifan" => 5,
        ]);
        \App\Models\Mapel::create([
            "mapel" => "Bahasa Indonesia",
            "kode" => "BI"
        ]);
    }
}
