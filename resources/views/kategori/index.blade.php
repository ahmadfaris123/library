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
        <h4>   Data Kategori </h4>
        <div class="card-tools">
            <a href="{{ route('create-kategori') }}" class="btn btn-success">Tambah Data <i class="fas da-plus-square"></i></a>
</div>
      </div>
      <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    #
                </td>
                <th>Nama Kategori</th>
                <th>Action</th>
            </tr>
            @foreach ($datas as $data)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <th>  {{ $data->kategori }}</th>

                <th> <a href="{{ url('edit-kategori',$data->id) }}"><i class="fas fa-pencil-alt text-red-400 mr-1" ></i></a>
                <a href="{{ url('delete-kategori',$data->id) }}"><i class="fas fa-trash-alt text-red-400 mr-1" style="color: red"></i></a>
                </th>
            </tr>
            @endforeach
        </table>
    </div>
  <!-- /.content-wrapper -->

</div>

</div>

<div class="card-footer">
    {{ $datas->links() }}
</div>
  </div>
</div>


<!-- REQUIRED SCRIPTS -->
@include('layouts.script')


@include('sweetalert::alert')
</body>
</html>
