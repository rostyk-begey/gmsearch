$(function () {
    $.readURL = input => {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);


                let icon = {
                    url: e.target.result, // url
                    scaledSize: new google.maps.Size(40, 40), // scaled size
                    origin: new google.maps.Point(0,0), // origin
                    anchor: new google.maps.Point(0, 0) // anchor
                };
                tempMarker.setAnimation(null);
                tempMarker.setIcon(icon);
                tempMarker.setMap(map);
            }
            reader.readAsDataURL(input.files[0]);
        }



    }
    $("#logo").change(function() {
        readURL(this);
    });
});
