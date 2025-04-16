<!DOCTYPE html>
<html lang="en">
      
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Data Pelanggaran</title>
</head>

<body>
      <h1>Data Pelanggaran</h1>
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
      <a href="{{ route('pelanggaran.create') }}">Tambah Pelanggaran</a>

      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
      </div>
      @endif

      <table class="tabel" border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <th>Jenis</th>
                    <th>Konsekuensi</th>
                    <th>Poin</th>
                    <th>Aksi</th>
                </tr>
            @forelse ($pelanggarans as $pelanggaran)
                <tr>
                    <td>{{ $pelanggaran->jenis }}</td>
                    <td>{{ $pelanggaran->konsekuensi }}</td>
                    <td>{{ $pelanggaran->poin}}</td>
                    
                    <td>
                        <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('pelanggaran.destroy', $pelanggaran->id) }}" method="POST">
                            <a href="{{ route('pelanggaran.edit', $pelanggaran->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
                        <a href="{{ route('pelanggaran.index') }}">Kembali</a>
                    </td>
                </tr>
            @endforelse
      </table>
      {{ $pelanggarans->links() }}

</body>

</html>