'use strict'

$(function () {

    /*$(".hide").fadeTo(2000, 500).slideUp(500, function(){
        $(this).slideUp(500);
    });*/
    $(".hide").fadeOut(2000);


});

let updateCompany = (json) => {
    console.log(json);

    let company = json;//JSON.parse(json);

    //console.log(company);

    deleteTempMarker();
    //alert("Test: " + marker.getPosition().lat());
    document.getElementById("imagePreview").style.backgroundImage = 'url('+ company.logo +')';
    document.getElementById('form_name').innerText = "Update company";
    document.getElementById('form_submit').value = "Update company";
    document.getElementById('name').value = company.name;
    document.getElementById('address').value = company.address;
    document.getElementById('description').value = company.description;
    document.getElementById('latitude').value = company.latitude;
    document.getElementById('longitude').value = company.longitude;
};