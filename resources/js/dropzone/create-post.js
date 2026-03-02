// If you are using JavaScript/ECMAScript modules:
import Dropzone from "dropzone";


// If you are using an older version than Dropzone 6.0.0,
// then you need to disabled the autoDiscover behaviour here:
Dropzone.autoDiscover = false;

const myDropzone = new Dropzone("#dropzone", { 
    maxFilesize: 10, // MB
    acceptedFiles: '.png, .jpg, .jpeg',
    thumbnailWidth: 240,
    thumbnailHeight: 240,
    maxFiles: 1,
    uploadMultiple: false,
    addRemoveLinks: true,
    dictDefaultMessage: 'Arrastra o agrega tu imagen aquí',
    dictRemoveFile: "Eliminar imagen",

    init: function() {
        if(document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {}
            imagenPublicada.size = 1234
            imagenPublicada.name = document.querySelector("[name=imagen]").value

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`)

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
        }
    }
});
    


myDropzone.on("success", function(file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen
});

myDropzone.on("removedfile", function() {
    document.querySelector('[name="imagen"]').value = ''
})