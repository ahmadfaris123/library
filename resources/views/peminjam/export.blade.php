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
                <h4> Data Peminjam </h4>
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            #
                        </td>
                        <th>Nama Peminjam</th>
                        <th>Nama Buku</th>
                        <th>Tanggal Meminjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Nama Petugas</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($datas as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th>{{ $data->nama_anggota }}</th>
                        <th>{{ $data->name }}</th>
                        <th>{{ $data->tgl_pinjam }}</th>
                        <th>{{ $data->tgl_kembali }}</th>
                        <th>{{ $data->judul_buku }}</th>
                        <th>{{ $data->status }}</th>
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