@extends('layouts.theme.backend.master')
@section('title')
    Dashboard | Dusun 3B
@endsection

@section('content')
    <div class="row">
        <!-- Expense Overview -->
        <div class="col-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-3">
                        <h5 class="m-0 me-2">Data Tanah</h5>
                        <small class="text-muted">Dusun 3B, Desa Karang Anyar</small>
                    </div>
                </div>
                <div class="card-body">
                    <div id="map"></div>
                </div>
            </div>
        </div>
        <!--/ Expense Overview -->
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Detail Tanah</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Nama Pemilik</td>
                                <td>:</td>
                                <td id="nama">@mdo</td>
                            </tr>
                            <tr>
                                <td>Pemilik Sebelumnya</td>
                                <td>:</td>
                                <td id="sebelum">@mdo</td>
                            </tr>
                            <tr>
                                <td>Objek Tanah</td>
                                <td>:</td>
                                <td>
                                    <ul>
                                        <li>Luas Bangunan : <strong id="bangunan"></strong> m<sup>2</sup></li>
                                        <li>Luas Luas : <strong id="tanah"></strong> m<sup>2</sup></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Keterangan</td>
                                <td>:</td>
                                <td id="keterangan">@mdo</td>
                            </tr>
                            <tr>
                                <td>Perubahan</td>
                                <td>:</td>
                                <td id="perubahan">@mdo</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td id="alamat">@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
    <style>
        #map {
            width: 100%;
            height: 530px;
            border-radius: 15px
        }

        /*Legend specific*/
        .legend {
            padding: 6px 8px;
            font: 14px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            line-height: 24px;
            color: #555;
        }

        .legend h4 {
            text-align: center;
            font-size: 16px;
            margin: 2px 12px 8px;
            color: #777;
        }

        .legend p {
            margin-bottom: -20px;
        }

        .legend span {
            position: relative;
            bottom: 3px;
        }

        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin: 0 8px 0 0;
            opacity: 0.7;
        }

        .legend i.icon {
            background-size: 18px;
            background-color: rgba(255, 255, 255, 1);
        }
    </style>
@endsection

@section('scripts')
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <script type="text/javascript">
        const statesData = @json($tanahJson);
    </script>
    <script type="text/javascript">
        L.mapbox.accessToken =
            'pk.eyJ1Ijoib2phbmFscGhhIiwiYSI6ImNreHR0ZGp1MzVuZGcyemt5MHg3Z2t4eHQifQ.peGpGa_e1Bs4amUI5AsDWQ';
        const map = L.map('map').setView([{{ env('MAP_LATITUDE') }}, {{ env('MAP_LONGITUDE') }}], 15);

        const tiles = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/{z}/{x}/{y}?access_token=' + L
            .mapbox.accessToken, {
                maxZoom: 19,
                attribution: '© <a href="https://www.mapbox.com/feedback/">Mapbox</a> © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(map);

        map.createPane('labels');

        /* global data */
        const geojson = L.geoJson(statesData).on('click', markerOnClick).addTo(map);

        function markerOnClick(e) {
            // alert("hi. you clicked the marker at " + e.latlng);
            const sampelData = e['layer']['feature']['properties'];
            var nama = sampelData['nama_terbaru'];
            var sebelum = sampelData['nama_sebelumnya'];
            var keterangan = sampelData['keterangan'];
            var perubahan = sampelData['perubahan'];
            var objek_bangunan = sampelData['luas_bangunan'];
            var objek_tanah = sampelData['luas_tanah'];
            var alamat = sampelData['alamat'];

            // console.log(sampelData);
            $("#exampleModal").modal('show');
            // set modal
            $("#nama").text(nama);
            $("#sebelum").text(sebelum);
            $("#keterangan").text(keterangan);
            $("#perubahan").text(perubahan);
            $("#tanah").text(objek_tanah);
            $("#bangunan").text(objek_tanah);
            $("#alamat").text(alamat);
        }

        /*Legend specific*/
        var legend = L.control({
            position: "bottomleft"
        });

        legend.onAdd = function(map) {
            var div = L.DomUtil.create("div", "legend");
            div.innerHTML += "<h4>Demografi</h4>";
            // div.innerHTML +=
            //     '<table><tbody><tr><td>&nbsp;Jumlah Penduduk</td><td>&nbsp;:&nbsp;</td><td>1000 Jiwa&nbsp;</td></tr><tr><td>&nbsp;Ketinggian</td><td>&nbsp;:&nbsp;</td><td>&nbsp;2321 MDPL</td></tr></tbody></table>';
            div.innerHTML += `<table>
        <tbody>
            <tr>
                <td>&nbsp;Jumlah Penduduk</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                <td>1000 Jiwa&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;Pekerjaan</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                <td>&nbsp;2321</td>
            </tr>
            <tr>
                <td>&nbsp;Jumlah Suku</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                <td>&nbsp;2321</td>
            </tr>
            <tr>
                <td>&nbsp;Jumlah Agama</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                <td>&nbsp;2321</td>
            </tr>
            <tr>
                <td>&nbsp;Jumlah Pendidikan</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</td>
                <td>&nbsp;2321</td>
            </tr>
        </tbody>
    </table>`;
            // div.innerHTML += '<i style="background: #448D40"></i><span>Forest</span><br>';
            // div.innerHTML += '<i style="background: #E6E696"></i><span>Land</span><br>';
            // div.innerHTML += '<i style="background: #E8E6E0"></i><span>Residential</span><br>';
            // div.innerHTML += '<i style="background: #FFFFFF"></i><span>Ice</span><br>';
            // div.innerHTML +=
            //     '<i class="icon" style="background-image: url(https://d30y9cdsu7xlg0.cloudfront.net/png/194515-200.png);background-repeat: no-repeat;"></i><span>Grænse</span><br>';
            return div;
        };

        legend.addTo(map);
    </script>
@endsection
