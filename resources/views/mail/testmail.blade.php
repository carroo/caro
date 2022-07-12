
<h1>Halo {{ $guru }}</h1>
@if($type==1)
<p>Murid yang bernama {{ $murid }} telah bergabung ke {{ $kelas }} pada {{ date('d-m-yy h:i:s') }}</p> 
@elseif($type==2)
<p>Murid yang bernama {{ $murid }} telah meninggalkan {{ $kelas }} pada {{ date('d-m-yy h:i:s') }}</p>
@endif 
