import './bootstrap';
import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Upload your image',
    acceptedFiles: '.png, .jpg, .jpeg, .gif',
    addRemoveLinks: true,
    dictRemoveFile: 'Remove image',
    maxFiles: 1,
    uploadMultiple: false,
    init: function() {
        if (document.querySelector('[name="image"]').value.trim()) {
            const postedImg = {};
            postedImg.size = 1000;
            postedImg.name = document.querySelector('[name="image"]').value;
            this.options.addedfile.call(this, postedImg);
            this.options.thumbnail.call(this, postedImg, `/uploads/${postedImg.name}`);
            postedImg.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

dropzone.on('success', function(_file, response) {
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.on('removedfile', function() {
    document.querySelector('[name="image"]').value = '';
})