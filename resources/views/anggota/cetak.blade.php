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
                <h4> Kartu Anggota </h4>
                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            #
                        </td>
                        <th width="300px">Foto Profil</th>
                        <th>Nama Anggota</th>
                        <th>Nomor Anggota</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Nomor HP</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($datas as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <th>
                            <img src="{{ asset('img/'. $data->photo ) }}" height="60%" width="60%" alt="" srcset="">
                            {{-- <a href="{{ asset('img/'. $data->photo ) }}" target="_blank" rel="noopener noreferrer"></a> --}}
                        </th>
                        <th> {{ $data->nama_anggota }}</th>
                        <th> {{ $data->no_anggota }}</th>
                        <th> {{ $data->jeniskelamin }}</th>
                        <th> {{ $data->alamat }}</th>
                        <th> {{ $data->no_hp }}</th>
                        <th> {{ $data->status->nama_status }}</th>
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