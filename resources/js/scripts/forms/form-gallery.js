$('#gallery').fileinput({
    showUpload: false,
    showCaption: false,
    overwriteInitial: false,
    maxFileSize: 50000,
    showCancel: true,
    // required: true,
    allowedFileExtensions: ['jpg', 'jpeg', 'png', 'bmp'],
    slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
    },
});
