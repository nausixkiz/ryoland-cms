$('.select2-icon').each(function () {
    const $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
        dropdownAutoWidth: true,
        width: '100%',
        minimumResultsForSearch: Infinity,
        dropdownParent: $this.parent(),
        templateResult: iconFormat,
        templateSelection: iconFormat,
        escapeMarkup: function (es) {
            return es;
        },
        allowHtml: true
    });
});

function iconFormat(icon) {
    const originalOption = icon.element;
    return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '</span>');
}
