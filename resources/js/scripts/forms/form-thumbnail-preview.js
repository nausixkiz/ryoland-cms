(function (window, document, $) {
    'use strict';

    const thumbnail = $('#thumbnail');
    if (thumbnail.length) {
        thumbnail.change(function () {
            const files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

            if (/^image/.test(files[0].type)) { // only image file
                const reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function () {
                    $('#thumbnail-text').text(thumbnail.val());
                    $('#thumbnail-preview').attr('src', event.target.result);
                }
            }
        });

    }
})(window, document, jQuery);
