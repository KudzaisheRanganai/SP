var options = {
  minimumInputLength: 1,
  ajax: {
    url: 'https://autocomplete.geocoder.cit.api.here.com/6.2/suggest.json',
    delay: 250,
    dataType: 'json',
    data: function (params) {
      return {
        query: params.term,
        app_id: 'DemoAppId01082013GAL',
        app_code: 'AJKnXv84fjrb0KIHawS0Tg',
        beginHighlight: '<b>',
        endHighlight: '</b>',
        country: 'ZAF'
      };
    },
    processResults: function (data) {
      return {
        results: $.map(data.suggestions, function (obj) {
          return { id: obj.locationId, text: obj.label.split(', ').reverse().join(', ') };
        })
      };
    }
  },
  escapeMarkup: function (markup) { return markup; }
};

$('#location').select2(options).on('select2:select', function (e) {
  $.getJSON('https://geocoder.cit.api.here.com/6.2/geocode.json', {
    app_id: 'DemoAppId01082013GAL',
    app_code: 'AJKnXv84fjrb0KIHawS0Tg',
    locationId: e.params.data.id
  }).done(function (data) {
    console.log(data);
    var locn = data.Response.View[0].Result[0].Location;
    console.log(locn);
    var mymap = L.map('map').setView([locn.DisplayPosition.Latitude, locn.DisplayPosition.Longitude], 13);

    var opts = {
      attribution: 'Map &copy; 1987-' + new Date().getFullYear() + ' <a href="http://developer.here.com">HERE</a>',
      subdomains: '1234',
      app_id: 'DemoAppId01082013GAL',
      app_code: 'AJKnXv84fjrb0KIHawS0Tg',
      variant: 'normal.day'
    };
    L.tileLayer('https://{s}.base.maps.cit.api.here.com/maptile/2.1/maptile/newest/{variant}/{z}/{x}/{y}/256/png8?app_id={app_id}&app_code={app_code}&lg=eng', opts).addTo(mymap);

    var marker = L.marker([locn.DisplayPosition.Latitude, locn.DisplayPosition.Longitude], {
      title: locn.Address.Label
    }).addTo(mymap);
  });
});