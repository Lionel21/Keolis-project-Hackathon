centerOrleans = [47.90182932, 1.90897107];
const map = L.map('mapRoad', { gestureHandling: true }).setView(centerOrleans, 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>',
}).addTo(map);
L.control.scale().addTo(map);

document.addEventListener('DOMContentLoaded', () => {
    const stationsList = document.querySelector('.js-stations');
    stations = JSON.parse(stationsList.dataset.stations);
    const travelList = document.querySelector('.js-travel');
    travel = JSON.parse(travelList.dataset.travel);

    m = L.marker([stations[travel[0]][0], stations[travel[0]][1]]);
    m.bindPopup('<p>' + travel[0] + '</p>');
    map.addLayer(m);
    m = L.marker([stations[travel[1]][0], stations[travel[1]][1]]);
    m.bindPopup('<p>' + travel[1] + '</p>');
    map.addLayer(m);

    const routing = L.Routing.control({
        show: false,
        waypoints: [
            L.latLng(stations[travel[0]][0], stations[travel[0]][1]),
            L.latLng(stations[travel[1]][0], stations[travel[1]][1])
        ],
        router: new L.Routing.mapbox('pk.eyJ1Ijoic2Rlc291c2EiLCJhIjoiY2s0YnBsMWN1MDQweTNlbTB6NXRmdHlxeSJ9.MN6NQxtqrcLz0qUDeTD-rg', { profile: 'mapbox/cycling' })
    });
    routing.addTo(map);
});
