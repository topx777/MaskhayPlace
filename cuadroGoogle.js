var marker;
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: {lat: 40.4165000, lng: -3.7025600}
            });
            marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: 40.4165000, lng: -3.7025600}
            });
            marker.addListener('click', toggleBounce);
            marker.addListener( 'dragend', function (event)
            {
                //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                document.getElementById("coordenadasEquipo").value = this.getPosition().lat()+","+ this.getPosition().lng();
            });
        }
        // permite arrastar el marcador
        function toggleBounce() {
            if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
            } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
        // captura el evento click sobre le marcador
        function funcionClick() {
            if (marker.getAnimation() != null) {
            marker.setAnimation(null);
            } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
        // cargamos el mapa en la ventana modal
        $('#ModalEquipos').on('shown.bs.modal', function(){
            initMap();
        });
        google.maps.event.addListener( map, "click", function(ele) {
            // codigo que crea el marcador
            new google.maps.Marker({
                map: map
            })
        });
