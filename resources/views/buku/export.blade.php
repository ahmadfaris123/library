<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('layouts.header')
</head>

<body>
    <div class="content">
        <div class="card card-info-outline">
            <div class="card-header">
                <h4> Data Buku </h4>
                <div class="card-tools">
                   
                </div>
            </div>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            #
                        </td>
                        <th> Foto </th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Kategori</th>
                        <th>ISBN</th>
                        <th>Tahun Terbit</th>
                        <th>Bahasa</th>
                        <th>Stok</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($datas as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th> <img src="{{ asset('img/'. $data->foto ) }}" height="60%" width="60%" alt="" srcset=""></th>
                        <th> {{ $data->judul_buku }} </th>
                        <th>
                            @foreach ($datas2 as $pengarang)
                            @if ($data->id_pengarang == $pengarang->id)
                            {{ $pengarang->nama_pengarang }}
                            @endif
                            @endforeach
                        </th>
                        <th>
                            @foreach ($datas1 as $penerbit)
                            @if ($data->id_penerbit== $penerbit->id)
                            {{ $penerbit->nama_penerbit }}
                            @endif
                            @endforeach
                        </th>
                        <th>
                            @foreach ($datas3 as $kategori)
                            @if ($data->id_kategori== $kategori->id)
                            {{ $kategori->kategori}}
                            @endif
                            @endforeach
                        </th>
                        <th> {{ $data->ISBN }} </th>
                        <th> {{ $data->tahun_terbit }} </th>
                        <th> {{ $data->bahasa }} </th>
                        <th> {{ $data->stok }} </th>

                        <th> <a href="{{ url('edit-buku', $data->id) }}"><i class="fas fa-pencil-alt text-red-400 mr-1"></i></a>
                            <a href="{{ url('delete-buku', $data->id) }}"><i class="fas fa-trash-alt text-red-400 mr-1" style="color: red"></i></a>
                        </th>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.content-wrapper -->

        </div>

    </div>




    @include('layouts.script')
    @include('sweetalert::alert')
    <script>
        $('document').ready(function() {
            window.print();
        });
    </script>
</body>

</html>