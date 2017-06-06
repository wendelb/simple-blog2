(function ($) {
    // OnLoad
    $(function () {
        $('.delete-entry').click(() => {
            if (confirm('Soll der aktuelle Eintrag wirklich gelöscht werden?')) {
                location.href = '/?page=delete&id=' + $('.blog-header').attr('data-id');
            }
        });

        tinymce.init({
            selector: '.tinymce'
        });
    });
})(jQuery);

