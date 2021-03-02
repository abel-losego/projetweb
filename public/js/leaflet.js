
/*LOAD MAP*/
let mymap = L.map('mapid').setView([43.262448, 6.658939], 13);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    tileSize: 512,
    zoomOffset: -1,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoiYnJlbmRhbjc4MzMwIiwiYSI6ImNrbHMzbDNueTB2NzIycGxsdG9icTZmZ3oifQ.tOMbhVIstg5MBHh6_m5_WA'
}).addTo(mymap);

let bounds = [];

/*ADDs POPUPS*/
Array.from(document.querySelectorAll('.js-marker')).forEach((item) => {

    let point = [item.dataset.lat, item.dataset.lon];
    bounds.push(point);

    let popup = L.popup({
        autoClose: false,
        closeOnEscapeKey: false,
        closeOnClick: false,
        closeButton: false,
        className: 'marker',
        maxWidth: 400
    })
        .setLatLng(point)
        .setContent(item.dataset.price + "€")
        .openOn(mymap);

    item.addEventListener('mouseover', function () {
        popup.getElement().classList.add('is-active');
    })
});

mymap.fitBounds(bounds);