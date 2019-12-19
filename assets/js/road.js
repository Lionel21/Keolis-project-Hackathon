centerOrleans = [47.90182932, 1.90897107];
console.log(centerOrleans);
const map = L.map('mapRoad', { gestureHandling: true }).setView(centerOrleans, 14);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>',
}).addTo(map);
L.control.scale().addTo(map);

document.addEventListener('DOMContentLoaded', () => {
    const stationsList = document.querySelector('.js-stations');
    stations = JSON.parse(stationsList.dataset.stations);
    for (station in stations) {
        m = L.marker([stations[station][0], stations[station][1]]);
        m.bindPopup('<p>' + station + '</p>');
        map.addLayer(m);
    }
});
