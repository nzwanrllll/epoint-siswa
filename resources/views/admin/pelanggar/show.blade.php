<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Show Pelanggar</title>
  <style type="text/css">
  table {
    border-collapse: collapse;
    margin: 20px 0px;
    text-align: left;
  }

  table,
  th,
  td {
    border: 1px solid;
    text-align: left;
    padding-right: 20px;
  }
  </style>
</head>

<body>
   
     <h1>Detail Pelanggar</h1>
     <a href="{{ route('pelanggar.index') }}">Kembali</a>

     <table>
      <tr>
        <td colspan="4" style="text-align: center;"><img src="{{ asset('storage/siswas/'.$pelanggar->image) }}" width="120px" height="120px"></td>
      </tr>
      <tr>
        <th colspan="2">Akun Pelanggar</th>
        <th colspan="2">Data Pelanggar</th>
      </tr>
      <tr>
        <th>Nama</th>
        <td>: {{ $pelanggar->name }}</td>
        <th>Nis</th>
        <td>: {{ $pelanggar->nis }}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>: {{ $pelanggar->email }}</td>
        <th>Kelas</th>
        <td>: {{ $pelanggar->tingkatan }} {{ $pelanggar->jurusan }} {{ $pelanggar->kelas }}</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <th>No Hp</th>
        <td>: {{ $pelanggar->hp }}</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <th>Status</th>
        @if($pelanggar->status == 1) :
        <td>: Aktif</td>
        @else
        <td>: Tidak Aktif</td>
        @endif
      </tr>
     </table>
     <br><br>

     <h1>Pilih Pelanggaran</h1>
     <br><br>
     <form action="" method="get">
      <label>Cari :</label>
      <input type="text" name="cari">
      <input type="submit" value="Cari">
     </form>
     <br><br>

     @if(Session::has('succes'))
     <div class="alert alert-succes" role="alert">
      {{ Session::get('succes') }}
     </div>
     @endif

     <table class="tabel">
      <tr>
        <th>jenis</th>
        <th>konsekuensi</th>
        <th>poin</th>
        <th>Aksi</th>
      </tr>
      @forelse ($pelanggarans as $pelanggaran)
      <tr>
        <td>{{ $pelanggaran->jenis }}</td>
        <td>{{ $pelanggaran->konsekuensi }}</td>
        <td>{{ $pelanggaran->poin }}</td>
        <td>
          <form action="{{ route('pelanggar.storePelanggaran', $pelanggaran->id) }}" method="POST">
            @csrf
            <input type="hidden" name="id_pelanggar" value="{{ $pelanggar->id }}">
            <input type="hidden" name="id_user" value="{{ $idUser }}">
            <input type="hidden" name="id_pelanggaran" value="{{ $pelanggaran->id }}">
            <button type="submit">Tambah Pelanggaran</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td>
          <p>data tidak ditemukan</p>
        </td>
        <td>
          <a href="{{ route('pelanggaran.index') }}">Kembali</a>
        </td>
      </tr>
      @endforelse
     </table>
     {{ $pelanggarans->links() }}
  
</body>
</html>