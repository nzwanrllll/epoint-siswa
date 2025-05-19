<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Data Pelanggar</title>
</head>

<body>
  <h1>Data Pelanggar</h1>
  <a href="{{ route('admin/dashboard') }}">Menu Utama</a>
  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
  <br><br>
  <form id="logout-form" action="{{ route('logout') }}" method="POST">
    @csrf
  </form>
  <br><br>
  <form action="" method="get">
    <label>Cari :</label>
    <input type="text" name="cari">
    <input type="submit" value="Cari">
  </form>
  <br><br>
  <a href="{{ route('pelanggar.create') }}">Tambah Pelanggar</a>

  @if(Session::has('succes'))
  <div class="alert alert-succes" role="alert">
    {{ Session::get('succes') }}
  </div>
  @endif

   <table class="tabel">
    <tr>
      <th>Foto</th>
      <th>NIS</th>
      <th>Nama</th>
      <th>Kelas</th>
      <th>No Hp</th>
      <th>Poin</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
    @forelse ($pelanggars as $pelanggar)
    <tr>
      <td>
        <img src="{{ asset('storage/siswas'.$pelanggar->image) }}" width="120px" height="120px" alt="">
      </td>
      <td>{{ $pelanggar->nis }}</td>
      <td>{{ $pelanggar->name }}</td>
      <td>{{ $pelanggar->tingkatan }} {{ $pelanggar->jurusan }} {{ $pelanggar->kelas }}</td>
      <td>{{ $pelanggar->hp }}</td>
      <td>{{ $pelanggar->poin_pelanggar}}</td>
      @if ($pelanggar->status == 0) :
      <td>Tidak Perlu Ditindak</td>
      @elseif ($pelanggar->status == 1)
      <td>
        <form onsubmit="return confirm('Apakah Anda Yakin {{$pelanggar->name}} Sudah Ditindak?');" action="{{ route('pelanggar.statusTindak', $pelanggar->id) }}" method="POST">
          @csrf
          @method('PUT')
          <button type="submit">Perlu Ditindak</button>
        </form>
      </td>
      @elseif ($pelanggar->status == 2)
      <td>Sudah Ditindak</td>
      @endif
      <td>
        <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('pelanggar.destroy', $pelanggar->id) }}" method="POST">
          <a href="{{ route('detailPelanggar.show', $pelanggar->id) }}" class="btn btn-sm btn-dark">DETAIL</a>
          @csrf
          @method('DELETE')
          <button type="submit">HAPUS</button>
        </form>
      </td>
    </tr>
    @empty
    <tr>
      <td>
        <p>data tidak ditemukan</p>
      </td>
      <td>
        <a href="{{ route('pelanggar.index') }}">kembali</a>
      </td>
    </tr>
    @endforelse
   </table>
   {{ $pelanggars->links() }}
</body>
</html>