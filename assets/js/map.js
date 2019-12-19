centerOrleans = [47.90182932, 1.90897107];

const map = L.map('map', { gestureHandling: true }).setView(centerOrleans, 14);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>',
}).addTo(map);
L.control.scale().addTo(map);

document.addEventListener('DOMContentLoaded', () => {
    const stationsList = document.querySelector('.js-stations');
    const stations = JSON.parse(stationsList.dataset.stations);

    for (station in stations) {
        m = L.marker([stations[station][0], stations[station][1]]);
        m.bindPopup('<p>' + station + '</p>');
        map.addLayer(m);
    }

    const station1 = stations['PLACEDUCHATELET'];
    const station2 = stations['PLACEDELALOIRE'];
    console.log(station1, station2);

    const routing = L.Routing.control({
        // show: false,
        waypoints: [
            L.latLng(station1[0], station1[1]),
            L.latLng(station2[0], station2[1])
        ],
        router: new L.Routing.mapbox('pk.eyJ1Ijoic2Rlc291c2EiLCJhIjoiY2s0YnBsMWN1MDQweTNlbTB6NXRmdHlxeSJ9.MN6NQxtqrcLz0qUDeTD-rg', { profile: 'mapbox/cycling' })
    });
    routing.addTo(map);

    let totalDistance = routing.on('routesfound', function(e) {
        const distance = e.routes[0].summary.totalDistance;
        const time = e.routes[0].summary.totalTime;

        var formData = new FormData();
        formData.append('distance', distance);
        formData.append('time', time);
        const request = new XMLHttpRequest();
        request.open("POST", '/road');
        request.send(formData);
    });
});


