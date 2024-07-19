<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
      body {
        font-family: "Arial", sans-serif;
      }
      .container {
        display: flex;
        align-items: center;
      }
      .logo {
        width: 50px; /* Adjust the size as needed */
        height: auto;
        margin-right: 10px;
      }
      .title-container {
        margin-left: 10px;
      }
      .title {
        font-size: 18px;
        font-weight: bold;
      }
      .address {
        font-size: 14px;
        padding-top: 20px;
        margin-left: auto; /* Move address to the right */
      }
      .meeting-info {
        padding-top: 20px;
        text-align: center;
        margin-top: 20px;
      }
      .meeting-table {
        margin: 0 auto; /* Center the table */
        width: 60%; /* Adjust the width as needed */
        border-collapse: collapse;
        margin-top: 10px;
      }
      .meeting-table th,
      .meeting-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
      }
      .meeting-table img {
        max-width: 100%;
        height: auto;
      }
      .signature {
        text-align: right;
        padding-top: 40px;
        padding-right: 200px;
      }
      .signature p:first-child {
        margin-bottom: 125px;
      }
      footer {
        text-align: center;
        margin-top: auto;
        padding-top: 20px;
      }
      footer img {
        max-width: 100%;
        height: auto;
      }
      #printButton {
        margin-top: 20px;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <img src="{{ asset('img/logo_print.png') }}" alt="Logo" />
      <div class="title-container">
        <div class="title">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</div>
        <div class="title">UNIVERSITAS BRAWIJAYA</div>
      </div>
      <div class="address">
        <div>Fakultas Vokasi</div>
        <div>Jalan Veteran No. 12 – 16, Malang 65145, Indonesia</div>
        <div>Telp. +62341 553240</div>
        <div>Fax. +62341 553448</div>
        <div>E-mail: vokasi@ub.ac.id</div>
        <div>Website: <a href="http://vokasi.ub.ac.id">http://vokasi.ub.ac.id</a></div>
      </div>
    </div>

    <div class="meeting-info">
      <table class="meeting-table">
        <tr>
          <th>No</th>
          <th>Nama</th>
          <th>NIP</th>
          <th>Tanda Tangan</th>
        </tr>
        @foreach($presensi as $key => $p)
        <tr>
          <td> {{ $key + 1 }}</td>
          <td>{{$p->peserta->nama}}</td>
          <td>{{$p->peserta->nip}}</td>
          <td><img src="img/tanda_tangan_1.png" alt="" /></td>
        </tr>
        @endforeach
      </table>

      <div class="signature">
        <p>{{$pemimpin->jabatan}}</p>
        <p>{{$pemimpin->nama}}</p>
        <p>NIP {{$pemimpin->nip}}</p>
      </div>
    </div>
    <footer><img src="img/footer_print.png" alt="" /></footer>
  </body>
  <script>
    window.onload = function() {
        window.print();
    };
</script>
</html>