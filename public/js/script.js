      var map;
      var driverMap;
      var myLatLng;
      var marker;
      var geocoder;
      var infowindow;
      var mapType;
      var gmarkers = [];
      var latval;
      var lngval;
      var distance;
      var prev_infowindow =false; 
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $(document).ready(function() {
        if (document.getElementById('map')){
          geoLocationInit();
        }else if(document.getElementById('driverMap')){showMap();
        }else if(document.getElementById('showMap')){showMap();
        }

        function geoLocationInit() {
          geocoder = new google.maps.Geocoder();
          infowindow = new google.maps.InfoWindow();
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);
          } else {
            alert("Browser not supported");
          }
        }

        function success(position) {
        // console.log(position);
        latval = position.coords.latitude;
        lngval = position.coords.longitude;

        // console.log(latval, lngval);
        myLatLng = new google.maps.LatLng(latval, lngval);
        mapType = 'driverMap';
        
        // nearbySearch(myLatLng, "school");
        if (document.getElementById('map')){
          mapType = 'map';
          searchDrivers(latval,lngval);
          // console.log('MAP0 '+ latval,lngval);
        }
        createMap(myLatLng,mapType);
        // console.log(gmarkers);
        geocodeLatLng(geocoder, map, infowindow, latval, lngval);
        document.getElementById('lat').innerHTML = latval;
        document.getElementById('lon').innerHTML = lngval;
        $('#lat').val(latval);
        $('#lon').val(lngval);
      }

      function fail() {
        myLatLng = new google.maps.LatLng(18.788322, 98.985234);
        if (document.getElementById('map')){
          mapType = 'map';
        }else if (document.getElementById('driverMap')){
          mapType = 'driverMap';
        }else if (document.getElementById('showMaps')){
          mapType = 'showMaps';
        }
        createMap(myLatLng,mapType);
        alert("Failed to show the current location.");
      }

    //Create Map
    function createMap(myLatLng,type) {
      map = new google.maps.Map(document.getElementById(type), {
        center: myLatLng,
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });

      var input = document.getElementById('address');
      // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.bindTo('bounds', map);

      // var infowindow = new google.maps.InfoWindow();

      marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
      });

      google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng);
      });

      autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          window.alert("Autocomplete's returned place contains no geometry");
          return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
          map.fitBounds(place.geometry.viewport);
        } else {
          map.setCenter(place.geometry.location);
          // map.setZoom(13);
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);

        var address = '';
        if (place.address_components) {
          address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
          ].join(' ');
        }

        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);

        $('#lat').val(place.geometry.location.lat());
        $('#lon').val(place.geometry.location.lng());
        //Location details
        document.getElementById('lat').innerHTML = place.geometry.location.lat();
        document.getElementById('lon').innerHTML = place.geometry.location.lng();
        if (document.getElementById('map')){
          distance = select.options[select.selectedIndex].value;
          searchDrivers(place.geometry.location.lat(),place.geometry.location.lng());
          // console.log('MAP1 '+ latval,lngval);
        }
      });

    }

    function geocodeLatLng(geocoder, map, infowindow, lat, lng) {
      // var input = document.getElementById('latlng').value;
      // var latlngStr = input.split(',', 2);
      var latlng = {lat: lat, lng: lng};
      geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === 'OK') {
          if (results[1]) {
            // map.setZoom(13);
            // var marker = new google.maps.Marker({
            //   position: latlng,
            //   map: map
            // });
            $('#address').val(results[0].formatted_address);
            infowindow.setContent(results[1].formatted_address);
            infowindow.open(map, marker);
            if (document.getElementById('map')){
              searchDrivers(lat,lng);
            }
          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
    }

    //Create marker
    function createMarker(latlng, icn, name, contentString) {
      var infowindow = new google.maps.InfoWindow({
       content: contentString
     });
      var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        icon: icn,
        title: name
      });
      marker.addListener('click', function() {
        if( prev_infowindow ) {
         prev_infowindow.close();
       }
       prev_infowindow = infowindow;
       infowindow.open(map, marker);
     });
      gmarkers.push(marker);
    }

    function placeMarker(location) {
      if ( marker ) {
        marker.setPosition(location);
      } else {
        marker = new google.maps.Marker({
          position: location,
          map: map
        });
        removeMarkers();
      }
      var lat = marker.getPosition().lat();
      var lng = marker.getPosition().lng();
      var select = document.getElementById('select');
      if ( document.getElementById('map') ){
        distance = select.options[select.selectedIndex].value;
      }
      $('#lat').val(lat);
      $('#lon').val(lng);
      $('#distance').val(distance);
      document.getElementById('lat').innerHTML = lat;
      document.getElementById('lon').innerHTML = lng;
      console.log(latval, lngval,distance);

      geocodeLatLng(geocoder, map, infowindow, lat, lng);
    }

    function searchDrivers(lat,lng){
      removeMarkers();

      $.post('http://localhost:8000/searchDrivers', {lat:lat, lng:lng, distance:distance}, function(match){
          // console.log(lat,lng,distance);

          $.each(match,function(i,val){
            var glatval = val.lat;
            var glngval = val.lng;
            var gname = val.driver_firstname  +" "+ val.driver_lastname;
            var GLatLng = new google.maps.LatLng(glatval, glngval);
            var gicn = 'https://pixady.com/img/2017/01/684620_ic.png';
            var arraySchools = ["Chiang Mai Demonstration School", "Chiang Mai International School", "Dara Academy", 
            "Grace International School", "Hopra School", "Kawila Wittayalai School",
            "Kowittamrong Chiang Mai School", "Kumthianganusorn School", "Lanna International School", "Montfort CM School"
            , "Montfort College", "Nakorn Payap International School", "Nawamindhrachudhit Payap School", 
            "Prem Tinsulanonda International School", "Regina Coeli College", "Sacred Heart School", "The Prince Royal's College", "Wattanothaipayap School",
            "Varee Chiangmai School"];

            var schools = '<h5 align="center"><u><i>School stops</i></u></h5>'+ '<ul>' +
            '<li>'+ arraySchools[val.school_stop_one] +'</li>' +
            '<li>'+ arraySchools[val.school_stop_two] +'</li>' +
            '<li>'+ arraySchools[val.school_stop_three] +'</li>' +
            '<li>'+ arraySchools[val.school_stop_four] +'</li>' +
            '<li>'+ arraySchools[val.school_stop_five] +'</li>' +
            '</ul>';
            if (val.school_stop_one + val.school_stop_two + val.school_stop_three 
              + val.school_stop_four + val.school_stop_five == 0) schools = " ";

              var star = Math.floor(val.rating_cache);
            var i;
            var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<img src="/uploads/avatars/' + val.photo +'" class="img-infowindow">'+
            '<h3 id="firstHeading" class="firstHeading text-center" style="margin-top: -10px">' + val.driver_firstname  +" "+ val.driver_lastname + '</h3>'+
            '<div id="bodyContent">'+
            schools + 
            '<p><b>Service fee</b>: ' + val.fee + ' ฿</p>' +
            '<p style="margin-top: -5px"><b>Rating</b>: ';
            for (i = 0; i < star; i++) {
             contentString +=  '<span class="glyphicon glyphicon-star"></span>';
           }
           contentString+= "  " + val.rating_cache + " stars";

           contentString += '</p>'
           '<a href="" class="btn btn-primary form-control">' +
           '<i class="glyphicon glyphicon-send"></i> Request</a>' +
           '</div>'+
           '</div>';
           createMarker(GLatLng,gicn,gname, contentString);

         })
        });
    }

    function removeMarkers(){
      for(i=0; i<gmarkers.length; i++){
        gmarkers[i].setMap(null);
      }
    }

    function getSchool(){
      var a = [];
      $.post('http://localhost:8000/getSchool', function(match){
        $.each(match,function(i,val){
          sLen = val.length;
          for (var j = 0; j < sLen; j++) {
            a.push(val[j].school_name);
          }
          return a;
        });
      });
    }

    function showMap() {
      var latlng;
      mapType = 'showMap';
      if (document.getElementById('driverMap')){
        mapType = 'driverMap';
      }
      $.post('http://localhost:8000/getLocation', function(match){
        $.each(match,function(i,val){
          var glatval = val.lat;
          var glngval = val.lng;
          latlng = {lat: glatval, lng: glngval};
          map = new google.maps.Map(document.getElementById(mapType), {
            center: latlng,
            scrollwheel: false,
            zoom: 13
          });
          var marker = new google.maps.Marker({
            position: latlng,
            map: map
          });
        });
        console.log("inside",latlng,mapType);
        if (mapType == 'driverMap'){
          geocoder = new google.maps.Geocoder();
          infowindow = new google.maps.InfoWindow();
          createMap(latlng,mapType);
        }
      });
    }
  });

      
      (function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

      var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

      $(function(){

        $('#new-review').autosize({append: "\n"});

        var reviewBox = $('#post-review-box');
        var newReview = $('#new-review');
        var openReviewBtn = $('#open-review-box');
        var closeReviewBtn = $('#close-review-box');
        var ratingsField = $('#ratings-hidden');

        openReviewBtn.click(function(e)
        {
          reviewBox.slideDown(400, function()
          {
            $('#new-review').trigger('autosize.resize');
            newReview.focus();
          });
          openReviewBtn.fadeOut(100);
          closeReviewBtn.show();
        });

        closeReviewBtn.click(function(e)
        {
          e.preventDefault();
          reviewBox.slideUp(300, function()
          {
            newReview.focus();
            openReviewBtn.fadeIn(200);
          });
          closeReviewBtn.hide();
          
        });

        $('.starrr').on('starrr:change', function(e, value){
          ratingsField.val(value);
        });
      });