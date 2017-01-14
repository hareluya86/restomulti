$('#collapseMap').on('shown.bs.collapse', function (e) {
    initMap();

});

var initMap = function() {
    (function (A) {

        if (!Array.prototype.forEach)
            A.forEach = A.forEach || function (action, that) {
                for (var i = 0, l = this.length; i < l; i++)
                    if (i in this)
                        action.call(that, this[i], i, this);
            };

    })(Array.prototype);

    var
            mapObject,
            markers = [],
            markersData = loadMarkersData();
            
    var mapOptions = {
        zoom: 14,
        center: new google.maps.LatLng(48.865633, 2.321236),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        panControl: false,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.TOP_LEFT
        },
        scrollwheel: false,
        scaleControl: false,
        scaleControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        styles:
                [{"featureType": "landscape", "stylers": [{"hue": "#FFBB00"}, {"saturation": 43.400000000000006}, {"lightness": 37.599999999999994}, {"gamma": 1}]}, {"featureType": "road.highway", "stylers": [{"hue": "#FFC200"}, {"saturation": -61.8}, {"lightness": 45.599999999999994}, {"gamma": 1}]}, {"featureType": "road.arterial", "stylers": [{"hue": "#FF0300"}, {"saturation": -100}, {"lightness": 51.19999999999999}, {"gamma": 1}]}, {"featureType": "road.local", "stylers": [{"hue": "#FF0300"}, {"saturation": -100}, {"lightness": 52}, {"gamma": 1}]}, {"featureType": "water", "stylers": [{"hue": "#0078FF"}, {"saturation": -13.200000000000003}, {"lightness": 2.4000000000000057}, {"gamma": 1}]}, {"featureType": "poi", "stylers": [{"hue": "#00FF6A"}, {"saturation": -1.0989010989011234}, {"lightness": 11.200000000000017}, {"gamma": 1}]}]

    };
    //test
    var marker;
        mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
    for (var key in markersData) {
        var item = markersData[key];
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
            map: mapObject,
            icon: '/assets/images/quickfood/img/pins/' + (key%7 + 1) + '.png',
        });

        if ('undefined' === typeof markers[key])
            markers[key] = [];
        markers[key].push(marker);
        google.maps.event.addListener(marker, 'click', (function () {
            closeInfoBox();
            getInfoBox(item).open(mapObject, this);
            mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
        }));
    }

    function hideAllMarkers() {
        for (var key in markers)
            markers[key].forEach(function (marker) {
                marker.setMap(null);
            });
    }
    ;

    function closeInfoBox() {
        $('div.infoBox').remove();
    }
    ;

    function getInfoBox(item) {
        return new InfoBox({
            content:
                    '<div class="marker_info" id="marker_info">' +
                    '<img width="80" height="80" src="' + item.map_image_url + '" alt=""/>' +
                    '<h3>' + item.name_point + '</h3>' +
                    '<em>' + item.type_point + '</em>' +
                    '<span>' + ((item.description_point.length > 30) ? item.description_point.substring(0,30)+'...' : item.description_point) + 
                    //'<strong>' + item.open_status + '</strong>' + '</span>' +
                    '<a href="' + item.url_point + '" class="btn_1">Details</a>' +
                    '</div>',
            disableAutoPan: false,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(10, 110),
            closeBoxMargin: '5px -20px 2px 2px',
            closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
            isHidden: false,
            alignBottom: true,
            pane: 'floatPane',
            enableEventPropagation: true
        });


    }
    ;

    function getCurrLoc() {
        var lat = localStorage.getItem("lat");
        var lng = localStorage.getItem("lng");
        if (lat && lng) {
            mapObject.setCenter(new google.maps.LatLng(lat, lng));
            return;
        }
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                mapObject.setCenter(new google.maps.LatLng(lat, lng));
                localStorage.setItem("lat", lat);
                localStorage.setItem("lng", lng);
            })
        }

    }

    $(document).ready(function () {
        getCurrLoc();
    })
}

var loadMarkersData = function() {
    var MarkersData = {};
    var $mapObj = $("input[name*=mapObj]");
    $mapObj.each(function(index,element){
        var id = element.dataset.id;
        var field = element.dataset.field;
        if(!(id in MarkersData)) {
            MarkersData[id] = {};
        }
        MarkersData[id][field] = element.value;
    });
    
    return MarkersData;
}