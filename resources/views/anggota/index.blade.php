<!DOCTYPE html>

<html lang="en">
<head>
@include('layouts.header')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
 @include('layouts.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="content-header"> </div>


    <!-- Main content -->
    <div class="content">
<div class= "card card-info-outline" >
    <div class="card-header">
        <h4>   Data Anggota Perpustakaan </h4>
        <div class="card-tools">
            <a href="{{ route('create-anggota') }}" class="btn btn-success">Tambah Data <i class="fas da-plus-square"></i></a>
</div>
      </div>
      <div class="card-body">

        <table class="table table-bordered" >
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    #
                </td>
                <th width="300px" >Foto Profil</th>
                <th>Nama Anggota</th>
                <th>Nomor Anggota</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @foreach ($datas as $data)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <th>
                    <img src="{{ asset('img/'. $data->photo ) }}" height="60%" width="60%" alt="" srcset="">
                    {{-- <a href="{{ asset('img/'. $data->photo ) }}" target="_blank" rel="noopener noreferrer"></a> --}}
                </th>
                <th>  {{ $data->nama_anggota }}</th>
                <th>  {{ $data->no_anggota }}</th>
                <th>  {{ $data->jeniskelamin }}</th>
                <th>  {{ $data->alamat }}</th>
                <th>  {{ $data->no_hp }}</th>
                <th>  {{ $data->status->nama_status }}</th>
                <th> <a href="{{  url('edit-anggota',$data->id) }}"><i class="fas fa-pencil-alt text-red-400 mr-1" ></i></a>
                <a href="{{ url('delete-anggota',$data->id) }}"><i class="fas fa-trash-alt text-red-400 mr-1" style="color: red"></i></a>
                <a href="/cetak" class="btn btn-primary">Cetak Kartu</a>
                </th>
            </tr>
            @endforeach
        </table>
    </div>
  <!-- /.content-wrapper -->

</div>

</div>

<div class="card-footer">
    {{-- {{ $datas->links() }} --}}
</div>
  </div>
</div>


<!-- REQUIRED SCRIPTS -->
@include('layouts.script')


@include('sweetalert::alert')
</body>
</html>
