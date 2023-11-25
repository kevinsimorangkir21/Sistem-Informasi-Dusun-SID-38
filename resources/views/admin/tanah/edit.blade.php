@extends('layouts.theme.backend.master')
@section('title')
    Ubah Data {{ $data->nama_terbaru }}
@endsection

@section('content')
    <div class="row">
        <div class="col-lg">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@yield('title')</h5>
                    <small class="text-muted float-end">Default label</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('admin.tanah.update', $data->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Nomor <small
                                                    class="text-danger">* wajib di isi</small></label>
                                            <input type="text" class="form-control @error('nomor') is-invalid @enderror"
                                                id="basic-default-fullname" name="nomor" value="{{ $data->nomor }}"
                                                placeholder="E.g NP001 - 001">
                                            @error('nomor')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Luas Tanah <small
                                                    class="text-danger">* wajib di isi</small></label>
                                            <input type="number"
                                                class="form-control @error('luas_tanah') is-invalid @enderror"
                                                id="basic-default-fullname" name="luas_tanah"
                                                value="{{ $data->luas_tanah }}" placeholder="E.g 10000">
                                            @error('luas_tanah')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Luas Bangunan <small
                                                    class="text-danger">* wajib</small></label>
                                            <input type="number"
                                                class="form-control @error('luas_bangunan') is-invalid @enderror"
                                                id="basic-default-fullname" name="luas_bangunan"
                                                value="{{ $data->luas_bangunan }}" placeholder="E.g 1000">
                                            @error('luas_bangunan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Alamat Tanah <small
                                                    class="text-danger">* wajib</small></label>
                                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                id="basic-default-fullname" name="alamat" value="{{ $data->alamat }}"
                                                placeholder="E.g GKI 12A">
                                            @error('alamat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Pemilik Sekarang <small
                                                    class="text-danger">* wajib di isi</small></label>
                                            <input type="text"
                                                class="form-control @error('pemilik_terbaru') is-invalid @enderror"
                                                id="basic-default-fullname" name="pemilik_terbaru"
                                                value="{{ $data->nama_terbaru }}" placeholder="E.g Budi Supadi">
                                            @error('pemilik_terbaru')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-fullname">Pemilik
                                                Sebelumnya</label>
                                            <input type="text"
                                                class="form-control @error('pemilik_lama') is-invalid @enderror"
                                                id="basic-default-fullname" name="pemilik_lama"
                                                value="{{ $data->nama_sebelumnya }}" placeholder="E.g Supadi">
                                            @error('pemilik_lama')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-message">Keterangan Tanah <small
                                                    class="text-danger">* wajib di isi</small></label>
                                            <textarea id="basic-default-message" rows="6" name="keterangan"
                                                class="form-control @error('keterangan') is-invalid @enderror" placeholder="Hi, Do you have a moment to talk Joe?">{{ $data->keterangan }}</textarea>
                                            @error('keterangan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="basic-default-message">Sebab Perubahan</label>
                                            <textarea id="basic-default-message" rows="6" name="perubahan"
                                                class="form-control @error('perubahan') is-invalid @enderror" placeholder="Hi, Do you have a moment to talk Joe?">{{ $data->perubahan }}</textarea>
                                            @error('perubahan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label">Longtitude.</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Latitude</label>
                                                </div>
                                            </div>
                                            @foreach ($geo as $key => $item)
                                                <div class="col-md-12 p-0">
                                                    <div class="col-md-12 form_field_outer p-0">
                                                        <div class="row form_field_outer_row">
                                                            <div class="form-group mb-3 col-md-4">
                                                                <input type="text" class="form-control w_90"
                                                                    name="longtitude[]" value="{{ $item->longtitude }}"
                                                                    id="longtitude_1" placeholder="E.g 109.xxx" />
                                                            </div>
                                                            <div class="form-group mb-3 col-md-4">
                                                                <input type="text" class="form-control w_90"
                                                                    name="latitude[]" value="{{ $item->latitude }}"
                                                                    id="latitude_1" placeholder="E.g -89.xxx" />
                                                            </div>
                                                            <div class="form-group col-md-4 add_del_btn_outer">
                                                                <button class="btn btn-info add_node_btn_frm_field"
                                                                    title="Copy or clone this row" type="button">
                                                                    <i class="bx bx-copy"></i>
                                                                </button>

                                                                <button class="btn btn-danger remove_node_btn_frm_field"
                                                                    type="button" data-nomor="{{ $key }}">
                                                                    <i class="bx bx-trash-alt"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </form>
                        </div>

                        <div class="col-md-6">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
    <style>
        #map {
            width: 100%;
            height: 100%;
            border-radius: 15px
        }
    </style>
@endsection

@section('scripts')
    <script>
        ///======Clone method
        $(document).ready(function() {
            $("body").on("click", ".add_node_btn_frm_field", function(e) {
                var index = $(e.target).closest(".form_field_outer").find(".form_field_outer_row").length +
                    1;
                var cloned_el = $(e.target).closest(".form_field_outer_row").clone(true);

                $(e.target).closest(".form_field_outer").last().append(cloned_el).find(
                    ".remove_node_btn_frm_field:not(:first)").prop("disabled", false);

                $(e.target).closest(".form_field_outer").find(".remove_node_btn_frm_field").first().prop(
                    "disabled", true);

                //change id
                $(e.target)
                    .closest(".form_field_outer")
                    .find(".form_field_outer_row")
                    .last()
                    .find("input[type='text']")
                    .attr("id", "mobileb_no_" + index);

                $(e.target)
                    .closest(".form_field_outer")
                    .find(".form_field_outer_row")
                    .last()
                    .find("select")
                    .attr("id", "no_type_" + index);

                console.log(cloned_el);
                //count++;
            });
        });

        $(document).ready(function() {
            //===== delete the form fieed row
            $("body").on("click", ".remove_node_btn_frm_field", function() {
                var nomor = $(this).attr('data-nomor');
                if (nomor != 0) {
                    $(this).closest(".form_field_outer_row").remove();
                }
            });
        });
    </script>
    <script type="text/javascript">
        const statesData = @json($json);
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

        // get color depending on population density value
        function getColor(d) {
            return d > 1000 ? '#800026' :
                d > 500 ? '#BD0026' :
                d > 200 ? '#E31A1C' :
                d > 100 ? '#FC4E2A' :
                d > 50 ? '#FD8D3C' :
                d > 20 ? '#FEB24C' :
                d > 10 ? '#FED976' : '#FFEDA0';
        }

        function style(feature) {
            return {
                weight: 2,
                opacity: 1,
                color: 'black',
                dashArray: '3',
                fillOpacity: 0.5,
                fillColor: getColor(feature.properties.density)
            };
        }

        /* global data */
        const geojson = L.geoJson(statesData, {
            style
        }).addTo(map);

        geojson.eachLayer((layer) => {
            layer.bindPopup(layer.feature.properties.name);
        });
    </script>
@endsection
