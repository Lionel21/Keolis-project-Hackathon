centerOrleans = [47.90182932, 1.90897107];

const map = L.map('map', { gestureHandling: true }).setView(centerOrleans, 14);

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

    let station1 = stations[document.getElementById("travel_start").value];
    let station2 = stations[document.getElementById("travel_finish").value];
    const change1 = document.getElementById('travel_start');
    const change2 = document.getElementById('travel_finish');

    change1.addEventListener('change', (e) => {
        station1 = stations[document.getElementById("travel_start").value];

        const routing = L.Routing.control({
            show: false,
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

            const inputDistance = document.createElement("input");
            inputDistance.setAttribute("type", "hidden");
            inputDistance.setAttribute("value", distance);
            inputDistance.setAttribute("name", "distance");
            document.getElementById("formHome").appendChild(inputDistance);
            const inputTime = document.createElement("input");
            inputTime.setAttribute("type", "hidden");
            inputTime.setAttribute("value", time);
            inputTime.setAttribute("name", "time");
            document.getElementById("formHome").appendChild(inputTime);
        });
    });

    change2.addEventListener('change', (e) => {
        station2 = stations[document.getElementById("travel_finish").value];

        const routing = L.Routing.control({
            show: false,
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

            const inputDistance = document.createElement("input");
            inputDistance.setAttribute("type", "hidden");
            inputDistance.setAttribute("value", distance);
            inputDistance.setAttribute("name", "distance");
            document.getElementById("formHome").appendChild(inputDistance);
            const inputTime = document.createElement("input");
            inputTime.setAttribute("type", "hidden");
            inputTime.setAttribute("value", time);
            inputTime.setAttribute("name", "time");
            document.getElementById("formHome").appendChild(inputTime);
        });
    });


    // change2.addEventListener('change', (e) => {
    //     station2 = stations[document.getElementById("travel_finish").value];
    //
    //     routing = L.Routing.control({
    //         show: false,
    //         waypoints: [
    //             L.latLng(station1[0], station1[1]),
    //             L.latLng(station2[0], station2[1])
    //         ],
    //         router: new L.Routing.mapbox('pk.eyJ1Ijoic2Rlc291c2EiLCJhIjoiY2s0YnBsMWN1MDQweTNlbTB6NXRmdHlxeSJ9.MN6NQxtqrcLz0qUDeTD-rg', { profile: 'mapbox/cycling' })
    //     });
    //     routing.addTo(map);
    //
    //     let totalDistance = routing.on('routesfound', function(e) {
    //         const distance = e.routes[0].summary.totalDistance;
    //         const time = e.routes[0].summary.totalTime;
    //
    //         const inputDistance = document.createElement("input");
    //         inputDistance.setAttribute("type", "hidden");
    //         inputDistance.setAttribute("value", distance);
    //         inputDistance.setAttribute("name", "distance");
    //         document.getElementById("formHome").appendChild(inputDistance);
    //         const inputTime = document.createElement("input");
    //         inputTime.setAttribute("type", "hidden");
    //         inputTime.setAttribute("value", time);
    //         inputTime.setAttribute("name", "time");
    //         document.getElementById("formHome").appendChild(inputTime);
    //
    //         console.log(distance);
    //     });
    // });

    // document.getElementById("formTravel").addEventListener('submit', () => {
    //     const station1 = stations[document.getElementById("travel_start").value];
    //     const station2 = stations[document.getElementById("travel_finish").value];
    //
    //     const routing = L.Routing.control({
    //         show: false,
    //         waypoints: [
    //             L.latLng(station1[0], station1[1]),
    //             L.latLng(station2[0], station2[1])
    //         ],
    //         router: new L.Routing.mapbox('pk.eyJ1Ijoic2Rlc291c2EiLCJhIjoiY2s0YnBsMWN1MDQweTNlbTB6NXRmdHlxeSJ9.MN6NQxtqrcLz0qUDeTD-rg', { profile: 'mapbox/cycling' })
    //     });
    //     routing.addTo(map);
    //
    //     let totalDistance = routing.on('routesfound', function(e) {
    //         const distance = e.routes[0].summary.totalDistance;
    //         const time = e.routes[0].summary.totalTime;
    //
    //         const inputDistance = document.createElement("input");
    //         inputDistance.setAttribute("type", "hidden");
    //         inputDistance.setAttribute("value", distance);
    //         inputDistance.setAttribute("name", "distance");
    //         const inputTime = document.createElement("input");
    //         inputTime.setAttribute("type", "hidden");
    //         inputTime.setAttribute("value", time);
    //         inputTime.setAttribute("name", "time");
    //
    //         document.getElementById("formHome").appendChild(inputDistance);
    //         document.getElementById("formHome").appendChild(inputTime);
    //
    //     });
    // });
});
