@extends('layouts.main')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row">
            @foreach ($groupedByJenis as $jenisId => $data)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $data['jenis'] }}</h5>
                            <p class="card-text">Jumlah PPKS: {{ $data['count'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <h2 class="container">Maps Sebaran PPKS</h2>
    <div class="container  card">
        <div class="card-body">
            <div id="map" style="height: 500px;"></div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var map = L.map('map').setView([5.10784476011659, 96.82475720265029], 12); // Set koordinat awal dan zoom level
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Ambil data dari PHP (dapat disesuaikan sesuai struktur data dan endpoint di Laravel)
        var data = {!! json_encode($ppks) !!};
        console.log(data);

        // Tambahkan marker untuk setiap titik data
        data.forEach(function(ppks) {
            // Tentukan warna marker secara acak
            var markerColor = getRandomColor();

            // Tambahkan marker dengan warna yang telah ditentukan
            var marker = L.marker([ppks.langitude, ppks.longatitude], {
                icon: coloredIcon(markerColor)
            }).addTo(map);
            marker.bindPopup('<b>' + ppks.nama + '</b><br>' + "<span>Jenis:</span>" + ppks.jenis.jenis +
                '</b><br>' + "<span>Tindakan:</span>" +
                ppks.terminasi.nama);
        });

        // Fungsi untuk menghasilkan warna acak
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        function coloredIcon(color) {
            return L.divIcon({
                className: 'custom-div-icon',
                html: '<svg width="24" height="24" viewBox="0 0 24 24"><circle cx="12" cy="12" r="8" fill="' +
                    color + '" /></svg>',
                iconSize: [24, 24],
                iconAnchor: [12, 12]
            });
        }
    </script>
@endsection
