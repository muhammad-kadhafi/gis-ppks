@extends('layouts.main')

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row">
            @foreach ($groupedByJenis as $jenisId => $data)
                <div class="col-md-4">
                    <div class="card mb-3" data-jenis-id="{{ $jenisId }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $data['jenis'] }}</h5>
                            <p class="card-text">Jumlah PPKS: {{ $data['count'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <h2 class="container pt-5">Maps Sebaran PPKS</h2>
    <div class="container card">
        <div class="card-body">
            <div id="map" style="height: 500px;"></div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // Generate colors for each jenis_id
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Map to store colors for each jenis_id
        var colors = {};

        // Retrieve and apply color for each card
        document.querySelectorAll('.card').forEach(function(card) {
            var jenisId = card.getAttribute('data-jenis-id');
            if (jenisId) {
                if (!colors[jenisId]) {
                    colors[jenisId] = getRandomColor();
                }
                var color = colors[jenisId];

                // Apply color to card border and title
                var cardBody = card.querySelector('.card-body');
                if (cardBody) {
                    cardBody.style.borderColor = color;
                }
                var cardTitle = card.querySelector('.card-title');
                if (cardTitle) {
                    cardTitle.style.color = color;
                }
            }
        });
        var map = L.map('map').setView([3.588411731660608, 98.67102025024282], 12); // Set koordinat awal dan zoom level
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        // Ambil data dari PHP (dapat disesuaikan sesuai struktur data dan endpoint di Laravel)
        var data = {!! json_encode($ppks) !!};

        // Tambahkan marker untuk setiap titik data
        data.forEach(function(ppks) {
            var jenisId = ppks.jenis.id;
            var markerColor = colors[jenisId] || getRandomColor();

            // Tambahkan marker dengan warna yang telah ditentukan
            var marker = L.marker([ppks.langitude, ppks.longatitude], {
                icon: coloredIcon(markerColor)
            }).addTo(map);
            marker.bindPopup(
                '<b>' + ppks.nama + '</b><br>' +
                '<span>Jenis:</span> ' + ppks.jenis.jenis + '<br>' +
                '<span>Tindakan:</span> ' + (ppks.terminasi && ppks.terminasi.nama ? ppks.terminasi.nama :
                    'Belum Ada Tindakan') + '<br>' +
                (ppks.foto ? '<img src="/storage/' + ppks.foto + '" alt="Foto ' + ppks.nama +
                    '" style="width: 100px; height: auto; margin-top: 10px;">' : '')
            );
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
