/**
 * Creates a new marker and adds it to a group
 * @param {H.map.Group} group       The group holding the new marker
 * @param {H.geo.Point} coordinate  The location of the marker
 * @param {String} html             Data associated with the marker
 */
var mapDeliveryData;
$(()=>{
  mapDeliveryData=JSON.parse($("#dData").text());
  console.log(mapDeliveryData);
});

function addMarkerToGroup(group, coordinate, html) {
  var marker = new H.map.Marker(coordinate);
  // add custom data to the marker
  marker.setData(html);
  group.addObject(marker);
}

/**
 * Add two markers showing the position of Liverpool and Manchester City football clubs.
 * Clicking on a marker opens an infobubble which holds HTML content related to the marker.
 * @param  {H.Map} map      A HERE Map instance within the application
 */
function addInfoBubble(map,mapArr) {
  var group = new H.map.Group();

  map.addObject(group);

  // add 'tap' event listener, that opens info bubble, to the group
  group.addEventListener('tap', function (evt) {
    // event target is the marker itself, group is a parent event target
    // for all objects that it contains
    var bubble =  new H.ui.InfoBubble(evt.target.getGeometry(), {
      // read custom data
      content: evt.target.getData()
    });
    // show info bubble
    ui.addBubble(bubble);
  }, false);

  function addSVGMarkers(map){
  var svgMarkup = '<svg style="left:-14px;top:-36px;"' +
      'xmlns="http://www.w3.org/2000/svg" width="28px" height="36px" >' +
      '<path d="M 19 31 C 19 32.7 16.3 34 13 34 C 9.7 34 7 32.7 7 31 C 7 29.3 9.7 ' +
      '28 13 28 C 16.3 28 19 29.3 19 31 Z" fill="#000" fill-opacity=".2"></path>' +
      '<path d="M 13 0 C 9.5 0 6.3 1.3 3.8 3.8 C 1.4 7.8 0 9.4 0 12.8 C 0 16.3 1.4 ' +
      '19.5 3.8 21.9 L 13 31 L 22.2 21.9 C 24.6 19.5 25.9 16.3 25.9 12.8 C 25.9 9.4 24.6 ' +
      '6.1 22.1 3.8 C 19.7 1.3 16.5 0 13 0 Z" fill="#fff"></path>' +
      '<path d="M 13 2.2 C 6 2.2 2.3 7.2 2.1 12.8 C 2.1 16.1 3.1 18.4 5.2 20.5 L ' +
      '13 28.2 L 20.8 20.5 C 22.9 18.4 23.8 16.2 23.8 12.8 C 23.6 7.07 20 2.2 ' +
      '13 2.2 Z" fill="${COLOR}"></path>' +
      '<text transform="matrix( 1 0 0 1 13 18 )" x="0" y="0" fill-opacity="1" ' +
      'fill="#fff" text-anchor="middle" ' +
      'font-weight="bold" font-size="13px" font-family="arial">${TEXT}</text></svg>'

  // Add the first marker
  var parisIcon = new H.map.Icon(
    svgMarkup.replace('${COLOR}', 'blue').replace('${TEXT}', 'P')),
    parisMarker = new H.map.Marker({lat: 55.5607, lng: 12.9811 },
      {icon: parisIcon});

  map.addObject(parisMarker);
}

  for(let k=0;k<mapArr.length;k++)
  {
    addMarkerToGroup(group, {lat:mapArr[k]["LATITUDE"], lng:mapArr[k]["LONGITUDE"]},
    'Manchester City' +'City of Manchester Stadium Capacity: 48,000');
  }


  // addMarkerToGroup(group, {lat:53.430, lng:-2.961},
  //   'Liverpool' +'Anfield Capacity: 45,362');

}

/**
 * Boilerplate map initialization code starts below:
 */

// initialize communication with the platform
// In your own code, replace variable window.apikey with your own apikey
var platform = new H.service.Platform({
  apikey: "aIdEcQLgG65Si32sFD2jwHnyqd4sKfuRos3hBX37EIE"
});
var defaultLayers = platform.createDefaultLayers();

// initialize a map - this map is centered over Europe
var map = new H.Map(document.getElementById('map'),
  defaultLayers.vector.normal.map,{
  center: {lat: -25.64235, lng: 27.78417},
  zoom: 7,
  pixelRatio: window.devicePixelRatio || 1
});
// add a resize listener to make sure that the map occupies the whole container
window.addEventListener('resize', () => map.getViewPort().resize());

// MapEvents enables the event system
// Behavior implements default interactions for pan/zoom (also on mobile touch environments)
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

// create default UI with layers provided by the platform
var ui = H.ui.UI.createDefault(map, defaultLayers);

// Now use the map as required...
addInfoBubble(map,mapDeliveryData);