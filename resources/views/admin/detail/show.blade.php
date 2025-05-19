<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Detail Pelanggaran</title>
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
    <h1>Data Pelanggar</h1>
<a href="{{ route('pelanggar.index') }}">kembali</a>    


<table>
    <tr>
        <td colspan="4" style="text-align: center;"><img src="{{ asset('storage/siswas/'.$pelanggar->image) }}" width="120px" hight="120px" alt=""></td>
    </tr>
    <tr>
            <th colspan="2">Akun pelanggar</th>
            <th colspan="2">Data pelanggar</th>
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
            @if($pelanggar->status == 0) :
            <td>: Tidak Perlu Ditindak </td>
            @elseif ($pelanggar->status == 1)
            <td>: Perlu Ditindak</td>
            @else
            <td>: Sudah Ditindak</td>
            @endif
        </tr>
        <tr>
            <td>
                Total Poin
            </td>
            <td>: <h1>{{ $pelanggar->poin_pelanggar }}</h1>
        </td>
        </tr>
</table>
<br><br>

<h1>Pelanggaran Yang Dilakukan</h1>
<br><br>

@if(Session::has('success'))
<div class="alert alert-success" role="alert">
    {{ Session::get('success') }}
</div>
@endif

@if($pelanggar->status == 0 || $pelanggar->status == 1) :
    <button onclick="myFunction()">Tambah Pelanggaran</button>

    <script>
        function myFunction() {
            alert("Poin Pelanggar Sudah Mencapai {{ $pelanggar->poin_pelanggar }} Poin, Pelanggar Perlu Ditindak!");
        }
    </script>
@else
<a href="{{ route('pelanggar.show', $pelanggar->id) }}">Tambah Pelanggaran</a>
@endif

<table class="tabel">
    <tr>
        <th>Nama PTK</th>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Konsekuensi</th>
        <th>Poin</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    @forelse ($details as $detail)
    <tr>
        <td>{{ $detail->name }}</td>
        <td>{{ $detail->created_at }}</td>
        <td>{{ $detail->jenis }}</td>
        <td>{{ $detail->konsekuensi }}</td>
        <td>{{ $detail->poin }}</td>
        @if($detail->status == 0) :
            <td>
                <form onsubmit="return confirm('Apakah {{ $pelanggar->name }} Sudah Diberikan Sanksi ?');" action="{{ route('detailPelanggar.update', $detail->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_pelanggar" value="{{ $detail->id_pelanggar }}">
                    <button type="submit">Belum Diberikan Sanksi</button>
                </form>
            </td>
            @else
            <td>Sudah Diberikan Sanksi</td>
            @endif
            <td>
                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('detailPelanggar.destroy', $detail->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id_pelanggar" value="{{ $detail->id_pelanggar }}">
                    <input type="hidden" name="poin_pelanggaran" value="{{ $detail->poin }}">
                    <button type="submit">Hapus Pelanggaran</button>
                </form>
            </td>
    </tr>
    @empty
    <tr>
        <td>
            <p>data tidak ditemukan, Silahkan Tambah Pelanggaran</p>
        </td>
        <td>
            <a href="{{ route('pelanggar.show', $pelanggar->id) }}">Tambah</a>
        </td>
    </tr>
    @endforelse
</table>
{{ $details->links() }}
</body>
</html>