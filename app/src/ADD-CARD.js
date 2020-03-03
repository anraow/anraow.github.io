'use strict';

// preview image
function previewImages() {

    var $preview = $('#preview');
    if (this.files) $.each(this.files, readAndPreview);

    function readAndPreview(i, file) {

        if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
            return alert(file.name + " is not an image");
        } // else...

        var reader = new FileReader();

        if ($preview.children().length == 0) {
            if (i === 0) {
                $(reader).on("load", function () {
                    $preview.append('<div class="carousel-item active" id="carouselItem"><img class="d-block" src="' + this.result + '"></div>');
                });
            } else {
                $(reader).on("load", function () {
                    $preview.append('<div class="carousel-item" id="carouselItem"><img class="d-block" src="' + this.result + '"></div>');
                });
            }
        } else {
            $(reader).on("load", function () {
                $preview.append('<div class="carousel-item" id="carouselItem"><img class="d-block" src="' + this.result + '"></div>');
            });
        }
        reader.readAsDataURL(file);

    }

}

$('#file-input').on("change", previewImages);


// carousel interval
$('.carousel').carousel({
    interval: 0
})


// delete photo button
function deletePhoto() {

    $("#preview div.active").remove();
    // $(".carousel-item:first-child").addClass("active");

}

$('#delete-btn').on("click", deletePhoto);

// $("#preview").on('click', ':button', function() {
//     $("div.active").remove();
// });