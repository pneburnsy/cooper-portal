<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'Contacts Map';
$breadcrumbtitle = 'Your Contacts';
$breadcrumbchild = 'Contacts Map';
include 'layouts/header.php';

// IMPORT QUERIES
doif_cooperadminonly(true, 'contacts_travel');

admin_all_users_travel();
contacts_status(false);

accounts_team_distinct(false);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<?php include 'layouts/page_title.php'; ?>

<div class="row contacts-travel">
    <div class="col-12 col-xl-6 col-xxl-4">
        <div id="map_results" class="card">
            <div class="card-body">
                <input type="text" placeholder="Search..." class="modal_input" id="search_input">

                <div class="modal-card">
                    <label>Search Along Route</label>
                    <div class="form-6">
                        <input type="text" id="start_address" class="modal_input" placeholder="From...">
                    </div>
                    <div class="form-6 lastchild">
                        <input type="text" id="end_address" class="modal_input mb-0" placeholder="To...">
                    </div>
                    <label>Route Search Radius (Miles)</label>
                    <input type="number" id="radius_input" class="modal_input mb-3" step="1" min="1" max="25" placeholder="Radius in miles" value="1">
                </div>

                <button class="btn btn-primary mb-4 mt-2 d-block" onclick="searchContactsAlongRoute()">Search Contacts</button>

                <small id="contacts_count" class="text-muted mb-4 d-block">Your results, showing the location of <?= $count_contacts ?> contacts.</small>
                <ul class="mt-4" id="locations_list"></ul>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6 col-xxl-8 h-100">
        <div id="map" class="h-100"></div>
    </div>
</div>

<script src="https://unpkg.com/@turf/turf@6.5.0/turf.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAupCbPArcBKr35P7auRfTxZ4xlZOJ6Vks&libraries=geometry&callback=initMap"
        async
        defer
        onload="initMap()">
</script>

<script>
    var locations = <?php echo json_encode($locations); ?>;
    var map, currentInfoWindow, markers = [], routePath = null, directionsRenderer;
    var proximityRadius = 1609.34;
    var filteredByRoute = [];
    var routePolygon = null;
    //console.log(locations);

    function initMap() {
        
        var mapCenter = { lat: parseFloat(locations[0].lat), lng: parseFloat(locations[0].lon) };
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: mapCenter
        });

        directionsRenderer = new google.maps.DirectionsRenderer({ suppressMarkers: true });
        directionsRenderer.setMap(map);

        displayLocationList(locations);
        addMarkers(locations);
        updateContactsCount(locations.length);

        // Search input listener
        document.getElementById('search_input').addEventListener('input', function () {
            filterContacts(this.value);
        });

        // Radius input listener
        document.getElementById('radius_input').addEventListener('input', function () {
            proximityRadius = parseFloat(this.value) * 1609.34; // Convert miles to meters
            if (routePath) {
                findContactsAlongRoute(routePath);
            }
        });
    }

    function addMarkers(locations) {
        markers.forEach(marker => marker.setMap(null));
        markers = [];

        locations.forEach(function (location, index) {
            var position = { lat: parseFloat(location.lat), lng: parseFloat(location.lon) };
            var marker = new google.maps.Marker({
                position: position,
                map: map,
                title: location.display_name
            });
            markers.push(marker);

            var accountLink = location.account_displayid
                ? `<a class="account_icon_full" style="background-color:rgba(${location.account_array}, 0.3)" href="page_accounts_view.php?displayid=${location.account_displayid}">${location.account_name}</a>`
                : `<span class="placeholder">No Account</span>`;

            var infoWindow = new google.maps.InfoWindow({
                content: `<div>
                <h5><strong class="mb-2 d-block">${location.display_name}</strong></h5>
                <div class="account-contact mb-3">
                    ${accountLink}
                </div>
                <div class="mb-1 d-block"><strong>Email:</strong> ${location.email}</div>
                <div class="mb-1 d-block"><strong>Office Phone:</strong> ${location.office_phone}</div>
                <div class="mb-3 d-block"><strong>Mobile Phone:</strong> ${location.mobile_phone}</div>
                <div class="mb-0 d-block"><strong>Address:</strong> ${location.address}</div>
                <a class="btn btn-primary mt-3" href="https://portal.cooperhandling.com/app/page_view_users_view.php?displayid=${location.displayid}">View Contact</a>
            </div>`
            });

            marker.addListener('click', function () {
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                }
                infoWindow.open(map, marker);
                currentInfoWindow = infoWindow;
            });

            map.addListener('click', function () {
                if (currentInfoWindow) {
                    currentInfoWindow.close();
                }
            });

            document.getElementById('location_' + index).addEventListener('click', function () {
                map.setCenter(marker.getPosition());
                map.setZoom(8);
                google.maps.event.trigger(marker, 'click');
            });
        });
    }

    function displayLocationList(locations) {
        var listContainer = document.getElementById('locations_list');
        listContainer.innerHTML = '';
        locations.forEach(function (location, index) {
            var listItem = document.createElement('li');
            var accountLink = location.account_displayid
                ? `<a class="account_icon_full" style="background-color:rgba(${location.account_array}, 0.3)" href="page_accounts_view.php?displayid=${location.account_displayid}">${location.account_name}</a>`
                : `<span class="placeholder">No Account</span>`;
            listItem.id = 'location_' + index;
            listItem.innerHTML = `
        <div>
            <div class="position-relative">
                <h5><strong class="mb-2 d-block">${location.display_name}</strong></h5>
                <div class="account-contact position-absolute">
                    ${accountLink}
                </div>
                <div class="mb-1 d-block"><strong>Email:</strong> ${location.email}</div>
                <div class="mb-1 d-block"><strong>Office Phone:</strong> ${location.office_phone}</div>
                <div class="mb-3 d-block"><strong>Mobile Phone:</strong> ${location.mobile_phone}</div>
                <div class="mb-0 d-block"><strong>Address:</strong> ${location.address}</div>
            <div>
        </div>
        `;
            listContainer.appendChild(listItem);
        });
    }

    function updateContactsCount(count) {
        document.getElementById('contacts_count').textContent = `Showing the location of ${count} contact${count !== 1 ? 's' : ''}.`;
    }

    function searchContactsAlongRoute() {
        var startAddress = document.getElementById('start_address').value;
        var endAddress = document.getElementById('end_address').value;

        if (startAddress && endAddress) {
            calculateRoute(startAddress, endAddress);
        } else {
            filteredByRoute = locations;
            filterContacts(document.getElementById('search_input').value);
            drawBufferWithTurf([]);
        }
    }

    function calculateRoute(startAddress, endAddress) {
        var directionsService = new google.maps.DirectionsService();
        directionsService.route(
            {
                origin: startAddress,
                destination: endAddress,
                travelMode: google.maps.TravelMode.DRIVING,
            },
            function (response, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(response);
                    routePath = response.routes[0].overview_path;
                    findContactsAlongRoute(routePath);
                    drawBufferWithTurf(routePath);
                } else {
                    alert('Could not display route: ' + status);
                }
            }
        );
    }

    function findContactsAlongRoute(route) {
        if (!route || route.length === 0) {
            filteredByRoute = locations;
        } else {
            filteredByRoute = [];
            locations.forEach(function (location) {
                var contactPosition = new google.maps.LatLng(location.lat, location.lon);
                var isNearby = route.some(function (routePoint) {
                    var routePosition = new google.maps.LatLng(routePoint.lat(), routePoint.lng());
                    return google.maps.geometry.spherical.computeDistanceBetween(contactPosition, routePosition) <= proximityRadius;
                });
                if (isNearby) {
                    filteredByRoute.push(location);
                }
            });
        }
        filterContacts(document.getElementById('search_input').value);
    }

    function drawBufferWithTurf(route) {
        if (routePolygon) {
            routePolygon.setMap(null);
        }

        var geojsonLine = {
            type: 'Feature',
            geometry: {
                type: 'LineString',
                coordinates: route.map(point => [point.lng(), point.lat()]),
            }
        };

        var buffered = turf.buffer(geojsonLine, proximityRadius / 1000, { units: 'kilometers' });

        var bufferedCoordinates = buffered.geometry.coordinates[0].map(coord => ({
            lat: coord[1],
            lng: coord[0],
        }));

        routePolygon = new google.maps.Polygon({
            paths: bufferedCoordinates,
            strokeColor: '#3c8ce2',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            fillColor: 'rgba(46,138,187,0.49)',
            fillOpacity: 0.4,
            map: map,
        });
    }

    function filterContacts(searchTerm) {
        var filteredLocations = filteredByRoute.filter(function (location) {
            return location.display_name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                (location.account_name && location.account_name.toLowerCase().includes(searchTerm.toLowerCase())) ||
                (location.email && location.email.toLowerCase().includes(searchTerm.toLowerCase())) ||
                (location.office_phone && location.office_phone.toLowerCase().includes(searchTerm.toLowerCase())) ||
                (location.mobile_phone && location.mobile_phone.toLowerCase().includes(searchTerm.toLowerCase())) ||
                (location.address && location.address.toLowerCase().includes(searchTerm.toLowerCase()));
        });

        updateDisplay(filteredLocations);
        updateContactsCount(filteredLocations.length);
    }

    function updateDisplay(filteredLocations) {
        displayLocationList(filteredLocations);
        addMarkers(filteredLocations);

        if (filteredLocations.length > 0) {
            var firstLocation = filteredLocations[0];
            var mapCenter = { lat: parseFloat(firstLocation.lat), lng: parseFloat(firstLocation.lon) };
            map.setCenter(mapCenter);
            map.setZoom(6);
        }
    }
</script>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
