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
        console.log([stations[station][0], stations[station][1]]);
        m = L.marker([stations[station][0], stations[station][1]]);
        m.bindPopup('<p>' + station + '</p>');
        map.addLayer(m);
    }
});
