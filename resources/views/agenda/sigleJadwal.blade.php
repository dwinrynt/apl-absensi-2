@extends('mylayouts.main')

@section('container')
<div class="card">
    <div class="card-body">
        <h4 class="card-title float-left">Jadwal {{ $kelas->nama }}</h4>
        @if (auth()->user()->can('add_agenda'))
        <form action="/agenda/create" method="get">
            @include('mypartials.tahunajaran')
            <input type="hidden" name="idk" value="{{ $kelas->id }}">
            <button type="submit" class="btn btn-sm text-white font-weight-bold float-right" style="background-color: #3bae9c">Tambah</button>
        </form>
        @endif
        <form action="/agenda" method="get">
            @include('mypartials.tahunajaran')
            <input type="hidden" name="idk" value="{{ $kelas->id }}">
            <button type="submit" class="btn btn-sm text-white font-weight-bold float-right mr-2" style="background-color: red">Kembali</button>
        </form>

        <div class="container-fluid p-0 mt-5">
            @foreach ($agendas as $key => $agenda)
            <p style="color: #3bae9c; font-weight: 500;">{{ $key }}</p>
            <table class="table">
                <thead>
                    <tr class="text-center mt-3">
                        <th scope="col">Jam Ke</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Mapel</th>
                        <th scope="col">Guru</th>
                        @if (auth()->user()->can('edit_agenda') || auth()->user()->can('delete_agenda'))
                        <th scope="col">action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($agenda as $sigleJadwal) 
                    <tr class="text-center">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $sigleJadwal->jam_awal }} - {{ $sigleJadwal->jam_akhir }}</td>
                        <td>{{ $sigleJadwal->mapel->nama }}</td>
                        <td>{{ $sigleJadwal->user->name }}</td>
                        @if (auth()->user()->can('edit_agenda') || auth()->user()->can('delete_agenda'))     
                        <td>
                            @if (auth()->user()->can('edit_agenda'))
                            <form action="/agenda/{{ $sigleJadwal->id }}/edit" method="get">
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-sm btn-warning text-white font-weight-bold" style="min-width: 5vw; margin:2px;">Edit</button>
                            </form>
                            @endif
                            @if (auth()->user()->can('delete_agenda'))
                            <form action="/agenda/{{ $sigleJadwal->id }}" method="post">
                                @csrf
                                @method('delete')
                                @include('mypartials.tahunajaran')
                                <button type="submit" class="btn btn-sm btn-danger text-white font-weight-bold" onclick="return confirm('yakin ingin menghapus ini?')" style="min-width: 5vw; margin:2px;">Delete</button>
                            </form>
                            @endif
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endforeach
        </div>
    </div>
</div>
@endsection