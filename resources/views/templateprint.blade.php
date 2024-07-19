<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
     @media print {
        body {
            margin: 0;
        }

        header, footer {
            position: fixed;
            width: 100%;
            margin: 0;
            padding: 10px;
            background-color: #f0f0f0; /* Sesuaikan dengan warna latar belakang yang diinginkan */
        }

        header {
            top: 0;
        }

        footer {
            bottom:0;
        }

        main {
            margin-top: 200px; /* Sesuaikan dengan tinggi header */
            margin-bottom: 200px; /* Sesuaikan dengan tinggi footer */
        }

        .page-break {
        page-break-before: always;
    }

    .meeting-info.page-2 {
        margin-top: 0; /* Atur margin top menjadi 0 agar dimulai dari atas halaman */
    }
    }
    /*/*/
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
        padding-top: 240px;
        padding-right: 200px;
      }
      .signature p:first-child {
        margin-bottom: 150px;
      }
      footer {
        text-align: center;
        margin-top: auto;
        padding-top: 20px;
      }
      footer img {
        padding-bottom: 20px;
        max-width: 100%;
        height: auto;
      }
    </style>
  </head>
  <body>
    
    <header class="container">
        <img src="{{ asset('img/logo_print.png') }}"  alt="Logo" />
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
    </header>
    
    <main>
    <div class="meeting-info page-1">
      
      <table class="meeting-table">
       
        <tr>
          <th>Nomor Undangan</th>
          <td>{{$items->undangan}}</td>
        </tr>
        <tr>
          <th>Hari/Tanggal</th>
          <td>{{$items->waktu_rapat}}</td>
        </tr>
        <tr>
          <th>Tempat</th>
          <td>{{$items->tempat_rapat}}</td>
        </tr>
        <tr>
          <th>Acara</th>
          <td>{{$items->topik_rapat}}</td>
        </tr>
        <tr>
          <th>Pemimpin Rapat</th>
          <td>{{$items->pemimpin_rapat}}</td>
        </tr>
       
        <tr>
          <th>Jumlah Peserta</th>
          <td>{{$totalPeserta}}</td>
        </tr>
     
        <tr>
          <th>Notulensi Rapat</th>
          <td>{{$items->notulensi_rapat}}</td>
        </tr>
        <tr>
          <th>Undangan</th>
          @foreach ($notula->upload as $up)
          <td><img src="{{ Storage::url($up->undangan) }}" alt="" /></td>
          @endforeach
        </tr>
      </table>
    </div>
    </main>
        <div class="page-break"></div>
      

        <main>
  <div class="meeting-info page-2">
    
    <table class="meeting-table">
     
        
      <th>Presensi</th>
          @if ($notula->upload && $notula->upload->count() > 0)
          @foreach ($notula->upload as $up)
          @php
          $presensiArray = explode(',', $up->presensi);
          @endphp
          @foreach ($presensiArray as $presensi)
        <td><img class="documentationImage" src="{{ asset('storage/' . trim($presensi)) }}" style="width: 16rem; height: 9rem; margin: 20px 0;"></td>
          @endforeach
          @endforeach
          @else
        <p></p>
    @endif
  </table>
</div> 
<div class="meeting-info page-2">
    
  <table class="meeting-table">
   
        
          <th>Dokumentasi</th>
          @if ($notula->upload && $notula->upload->count() > 0)
          @foreach ($notula->upload as $up)
          @php
          $dokumentasiArray = explode(',', $up->dokumentasi);
          @endphp
          @foreach ($dokumentasiArray as $dokumentasi)
        <td><img class="documentationImage" src="{{ asset('storage/' . trim($dokumentasi)) }}" style="width: 16rem; height: 9rem; margin: 20px 0;"></td>
          @endforeach
          @endforeach
          @else
        <p></p>
    @endif
        
      </table>
        </div>


        <div class="signature">
         
          <p>{{$pemimpin->jabatan}}</p>
          
          <p>{{$items->pemimpin_rapat}}</p>
          
          <p>NIP {{$pemimpin->nip}}</p>
        
        </div>
      
    </main> 
      
      
      
  

  
    <footer><img src="{{ asset('img/footer_print.png') }}"  alt="" /></footer>
   
  <script>
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>