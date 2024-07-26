@extends('layouts.main')

@section('content')
    <h2 class="pt-5">Maps Sebaran PPKS</h2>
    <div class="card">
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
        console.log(data)

        // Tambahkan marker untuk setiap titik data
        data.forEach(function(ppks) {
            var markerColor = 'blue'; // Warna default jika tidak ada kriteria yang cocok

            // Tentukan warna marker berdasarkan nilai kriteria
            if (ppks.jenis.id === 2) {
                markerColor = 'red';
            } else if (ppks.jenis.id === 3) {
                markerColor = 'green';
            }

            // Tambahkan marker dengan warna yang telah ditentukan
            var marker = L.marker([ppks.langitude, ppks.longatitude], {
                icon: coloredIcon(markerColor)
            }).addTo(map);
            marker.bindPopup('<b>' + ppks.nama + '</b><br>' + ppks.jenis.jenis);
        });

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
