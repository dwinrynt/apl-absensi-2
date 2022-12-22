@extends('mylayouts.main')

@section('tambahcss')
<style>
    @media (min-width:590px) {
        .cover {
            display: flex;
            gap: 20px;
        }
    }

    @media (min-width:590px) {
        .cover1 {
            display: flex;
            gap: 20px;
        }
    }

    @media (min-width:590px) {
        .cover2 {
            display: flex;
            gap: 20px;
        }
    }

    @media (max-width:590px) {
        .logo {
            display: flex;
            justify-content: center
        }
    }

    @media (min-width:590px) {
        .kompetensi {
            width: 58%;

        }
    }

    @media (min-width:590px) {
        .super {
            display: flex;
            justify-content: space-between;
        }
    }

    @media (max-width:590px) {

        .jumlah_sekolahs,
        .roles,
        .tahun_ajarans {
            width: 50%;
        }
    }

    @media (max-width:590px) {

        .jumlah_sekolah,
        .role,
        .tahun_ajaran {
            padding: 10px;
            border-bottom: 2px solid #000000;
        }
    }

    @media (min-width:590px) {

        .role,
        .tahun_ajaran {
            padding-left: 50px;
            border-left: 2px solid #000000;
        }
    }
</style>
@endsection

@section('container')

@if (Auth::user()->hasRole('super_admin'))
{{-- <div class="containerSuper">
    <div class="card" style="height: 15rem;overflow: auto;">
        <div class="card-body super">
            <div class="d-flex mt-3 jumlah_sekolah">
                <span class="jumlah_sekolahs" style="min-width: 10vw; font-weight: bold">Jumlah Sekolah :</span>
                <div class="table-responsive table-borderless">
                    <table>
                        <tr>
                            <td>{{ $countSekolah }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  Role Tersedia :
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  Tahun Ajaran Tersedia
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
              </div>
            </div>
          </div>
    </div>
</div> --}}

<div class="card">
    <div class="card-body">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                  Sekolah Tersedia : {{ $countSekolah }}
                </button>
              </h2>
              <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="table-responsive table-borderless">
                        <table>
                            @foreach ($sekolah as $s)
                            <tr>
                                <td>- {{ $s->nama }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                  Role Tersedia : {{ $countRole }}
                </button>
              </h2>
              <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="table-responsive table-borderless">
                        <table>
                            @foreach ($roles as $role)
                            @if ($role->name != 'super_admin')
                            <tr>
                                <td>- {{ $role->name }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </table>
                    </div>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                  Tahun Ajaran Tersedia : {{ $countTahunAjaran }}
                </button>
              </h2>
              <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <div class="table-responsive table-borderless">
                        <table>
                            @foreach ($tahun_ajarans as $tahun_ajaran)
                            <tr>
                                <td>- {{ $tahun_ajaran->tahun_awal }}/{{ $tahun_ajaran->tahun_akhir }} Semester {{
                                    $tahun_ajaran->semester }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div> 
                </div>
              </div>
            </div>
          </div>
    </div>
</div>

@else
<div class="row">
    <div class="col-md">
        <div class="card mb-3" style="height: 15rem;overflow: auto;">
            <div class="card-body">
                <div class="title" style="display: flex; justify-content: space-between">
                    <h4 class="card-title" style="color: #369488; font-weight:600;">Profile Sekolah</h4>
                    @if (auth()->user()->can('edit_sekolah'))
                    <form action="/edit-sekolah" method="get">
                        @include('mypartials.tahunajaran')
                        <button class="btn btn-warning btn-sm text-white" style="min-width: 5vw;font-weight: 500;border-radius: 5px;">Edit</button>
                    </form>
                    @endif
                </div>
                <div class="cover">
                    <div class="logo">
                        @if ( Auth::user()->sekolah->logo != '/img/tutwuri.png' )
                        <img src="{{ asset('storage/' . Auth::user()->sekolah->logo) }}" alt="" scale="1/1"
                            style="width: 10rem; height: 10rem; object-fit: cover; border-radius: 5px;">
                        @else
                        <img src="{{ Auth::user()->sekolah->logo }}" alt="" scale="1/1"
                            style="width: 10rem; height: 10rem; object-fit: cover; border-radius: 5px;">
                        @endif
                        <div class="mt-1" style="display: flex; justify-content: center; gap:20px;">
                            @if ( Auth::user()->sekolah->instagram )
                            <a href="{{ Auth::user()->sekolah->instagram }}"><i class="bi bi-instagram"
                                    style="color: purple;"></i></a>
                            @endif
                            @if ( Auth::user()->sekolah->youtube )
                            <a href="{{ Auth::user()->sekolah->youtube }}"><i class="bi bi-youtube"
                                    style="color: red"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table>
                            <tr>
                                <th>Nama Sekolah</th>
                                <td>&nbsp;</td>
                                <td>:</td>
                                <td>&nbsp;</td>
                                <td>{{ Auth::user()->sekolah->nama }}</td>
                            </tr>
                            <tr>
                                <th>NPSN</th>
                                <td>&nbsp;</td>
                                <td>:</td>
                                <td>&nbsp;</td>
                                <td>{{ Auth::user()->sekolah->npsn }}</td>
                            </tr>
                            <tr>
                                <th>Nama Kepala Sekolah</th>
                                <td>&nbsp;</td>
                                <td>:</td>
                                <td>&nbsp;</td>
                                <td>{{ Auth::user()->sekolah->kepala_sekolah }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>&nbsp;</td>
                                <td>:</td>
                                <td>&nbsp;</td>
                                <td>{{ Auth::user()->sekolah->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->can('view_users') && !Auth::user()->hasRole('yayasan') )
    <div class="col-md-4">
        <div class="card mb-3" style="height: 15rem;overflow: auto;">
            <div class="card-body">
                <div class="title-yayasan" style="display: flex; justify-content: space-between">
                    <h4 class="card-title" style="color: #369488; font-weight:600;">Yayasan</h4>
                    @if (!$yayasan)
                    <form action="/create-yayasan" method="get">
                        @include('mypartials.tahunajaran')
                        <button type="submit" class="btn btn-sm text-white p-0"
                            style="background-color: #369488; min-width: 5rem; height: 1.5rem; font-weight: 500; border-radius: 5px;">Tambah</button>
                    </form>
                    @endif
                </div>
                @if ($yayasan)
                <div class="table table-responsive table-hover text-center" style="border-radius: 3px;">
                    <table class="table align-middle">
                        <thead style="background-color: #3bae9ddc; color: aliceblue;">
                            <tr>
                                <th style="width: 5%;">Nama</th>
                                <th style="width: 5%;">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width: 15%; height: 8vh">{{ $yayasan->name }}</td>
                                <td style="width: 15%; height: 8vh">{{ $yayasan->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-danger" role="alert">
                    Maaf tidak ada data yayasan ditemukan
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

@if (!Auth::user()->hasRole('siswa'))

@if (auth()->user()->can('view_users') || auth()->user()->can('view_mapel') || auth()->user()->can('view_kelas'))
<div class="container-fluid p-0">
    <div class="row">
        @if (auth()->user()->can('view_users'))
        <div class="col-md">
            <div class="card mb-3" style="height: 15rem;overflow: auto;">
                <div class="card-body">
                    <h4 class="card-title" style="color: #369488; font-weight:600;">Data User</h4>
                    <div class="table table-responsive table-hover text-center" style="border-radius: 3px;">
                        <table class="table align-middle">
                            <thead style="background-color: #3bae9ddc; color: aliceblue;">
                                <tr>
                                    <th>User</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td style="width: 5%">{{ $user }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->user()->can('view_mapel'))
        <div class="col-md">
            <div class="card mb-3" style="height: 15rem;overflow: auto;">
                <div class="card-body">
                    <h4 class="card-title" style="color: #369488; font-weight:600;">Mapel</h4>
                    <div class="table table-responsive table-hover text-center" style="border-radius: 3px;">
                        @if (count(Auth::user()->sekolah->mapel) > 0)
                        <table class="table align-middle">
                            <thead style="background-color: #3bae9ddc; color: aliceblue;">
                                <tr>
                                    <th>Mapel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->sekolah->mapel as $mapel)
                                <tr>
                                    <td style="width: 5%">{{ $mapel->nama }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-danger" role="alert">
                            Maaf tidak ada data mapel ditemukan
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->user()->can('view_kelas'))
        <div class="col-md">
            <div class="card mb-3" style="height: 15rem;overflow: auto;">
                <div class="card-body">
                    <h4 class="card-title" style="color: #369488; font-weight:600;">Kelas</h4>
                    <div class="table table-responsive table-hover text-center" style="border-radius: 3px;">
                        @if (count(Auth::user()->sekolah->kelas) > 0)
                        <table class="table align-middle">
                            <thead style="background-color: #3bae9ddc; color: aliceblue;">
                                <tr>
                                    <th>Nama Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->sekolah->kelas as $kelas)
                                <tr class="text-center">
                                    <td style="width: 5%">{{ $kelas->nama }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <div class="alert alert-danger" role="alert">
                            Maaf tidak ada data kelas ditemukan
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endif

@if (auth()->user()->can('view_kompetensi'))
<div class="container-fluid p-0">
    <div class="card mb-3">
        <div class="card-body">
            <h4 class="card-title" style="color: #369488; font-weight:600;">Kompetensi</h4>
            @if (count(Auth::user()->sekolah->kompetensi) > 0)
            <div class="table table-responsive table-hover text-center" style="border-radius: 3px;">
                <table class="table align-middle">
                    <thead style="background-color: #3bae9ddc; color: aliceblue;">
                        <tr>
                            <th style="width: 5%">Kompetensi</th>
                            <th style="width: 5%">Program Keahlian</th>
                            <th style="width: 5%">Bidang Keahlian</th>
                        </tr>
                    </thead>

                    @foreach (Auth::user()->sekolah->kompetensi as $kompetensi)
                    <tbody>
                        <tr>
                            <td style="width: 5%">{{ $kompetensi->kompetensi }}</td>
                            <td style="width: 5%">{{ $kompetensi->program }}</td>
                            <td style="width: 5%">{{ $kompetensi->bidang }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                Maaf tidak ada data Kompetensi ditemukan
            </div>
            @endif
        </div>
    </div>
</div>
@endif

@else
{{-- Siswa --}}
@endif
@endif
@endsection