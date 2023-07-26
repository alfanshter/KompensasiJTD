<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <style type="text/css">
        .tg {
            border-collapse: collapse;
            border-spacing: 0;
        }

        .tg td {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family: Arial, sans-serif;
            font-size: 12px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg th {
            border-color: black;
            border-style: solid;
            border-width: 1px;
            font-family:Arial, sans-serif;
            font-size: 12px;
            font-weight: normal;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;
        }

        .tg .tg-0lax {
            text-align: left;
            vertical-align: top;
            border: none;
            line-height: 0.2em;
        }

        .awal {
            width: 80px;
        }

        .akhir {
            width: auto;
        }
    </style>
    <center>
        <div style="display: flex; flex-direction:column">
            <img src="{{ public_path('storage/logokompen.png')}}" style="width: 2.5cm; height:2.5cm;position: absolute; top :0px; left:0px" alt="" srcset="">
            <div>
                <p style=" font-weight: bold;text-transform:uppercase;font-size:12px">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</p>
                <p style=" font-weight: bold;text-transform:uppercase;font-size:12px;line-height: 0.2em;">POLITEKNIK NEGERI MALANG</p>
                <p style=" font-weight: bold;text-transform:uppercase;font-size:12px;line-height: 0.2em;">JURUSAN TEKNIK ELEKTRO</p>
                <p style=" font-weight: bold;text-transform:uppercase;font-size:12px;line-height: 0.2em;">PROGRAM STUDI TEKNIK TELEKOMUNIKASI</p>
                <p style=" font-weight: bold;text-transform:uppercase;font-size:12px;line-height: 0.2em;">PROGRAM STUDI JARINGAN TELEKOMUNIKASI DIGITAL</p>
                <p style=" font-weight: bold;font-size:9px;line-height: 0.2em;">Jl. Soekarno Hatta No.9 Malang 65141 Telp. 0341-404424 Ext. 1077 Fax. 0341-404420</p>

            </div>
            <hr>

        </div>

        <p><b>KARTU BEBAS KOMPENSASI MAHASISWA</b></p>
        <p style="line-height: 0.2em;"><b>SEMESTER GANJIL TAHUN AJARAN 2023</b></p>

    </center>
    <table class="tg" style="border: none; margin-left:50px">
        <thead>
            <tr>
                <th class="tg-0lax awal">NAMA</th>
                <th class="tg-0lax akhir">: {{$kompen->mahasiswa->nama}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-0lax">NIM</td>
                <td class="tg-0lax">: {{$kompen->mahasiswa->nip}} </td>
            </tr>
            <tr>
                <td class="tg-0lax">KELAS</td>
                <td class="tg-0lax">: {{$kompen->mahasiswa->kelas}} </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="tg" style="margin-left: 155px;">
        <thead>
            <tr>
                <th class="tg-0lax">Jumlah Jam Kompen</th>
                <th class="tg-0lax akhir">: {{$kompen->mahasiswa->jumlahkompen + $kompen->jam}} Jam</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="tg-0lax">Kompensasi yang Sudah Dibayar</td>
                <td class="tg-0lax">: {{$kompen->jam}} Jam</td>
            </tr>
            <tr>
                <td class="tg-0lax">Sisa Kompensasi</td>
                <td class="tg-0lax">: {{$kompen->mahasiswa->jumlahkompen}} Jam</td>
            </tr>
        </tbody>
    </table>

    <p style="margin-left:160px">LUNAS/BELUM LUNAS</p>
    <table class="tg" style="margin-left: 385px;">
        <thead>
            <tr>
                <th class="tg-0lax">
                    <p>Malang, ..............</p>
                    <p>Penanggung Jawab</p>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr><td class="tg-0lax"></td>
            </tr>
            <tr><td class="tg-0lax"></td>
            </tr>
            <tr>
                <td class="tg-0lax"> ......................</td>

            </tr>
        </tbody>
    </table>

    
</body>

</html>