jQuery(document).ready(function ($) {
    codemirror();
    button_selector();
});
function codemirror() {
    setTimeout(function () {
        if (typeof tinymce !== 'undefined') {
            // Loop through each textarea
            var textareaId = 'wysiwyg-editor-field';
            // TinyMCE settings to mimic classic editor
            tinymce.init({
                selector: '#' + textareaId,  // Use the unique ID
                plugins: 'lists link charmap paste textcolor',
                toolbar: 'formatselect | bold italic | bullist numlist | link | forecolor | charmap | pastetext | removeformat',
                block_formats: 'Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre',
                toolbar_location: 'top',
                menubar: false,
                statusbar: false,
                branding: false,
                height: 300
            });



        } else {
            console.error('TinyMCE is not loaded.');
        }
        var $target;

        jQuery(document).on("click", '.wysiwyg-editor-trigger', function (event) {
            jQuery('#wysiwyg-editor').addClass('active');
            $target = jQuery(this).parent().parent().parent().prev().find('textarea');
            tinymce.get(textareaId).setContent($target.val());
        });

        jQuery(document).on("click", '.close-wysiwyg-trigger', function (event) {
            jQuery('#wysiwyg-editor').removeClass('active');
        });


        jQuery(document).on("click", '.submit-wysiwyg-trigger', function (event) {
            jQuery('#wysiwyg-editor').removeClass('active');
            $target.val(tinymce.get(textareaId).getContent());
        });



    }, 1000);

}

function button_selector() {
    jQuery(document).on("change", '.trigger-selector select', function (event) {
        $value = jQuery(this).val();
        $selector = jQuery(this).parent().parent().parent().find('.page-selector');
        active_link_type($selector, $value)
    });


    jQuery(document).on("change", '.select-page-selector', function (event) {
        $value = jQuery(this).val();
        $input = jQuery(this).parent().parent().parent().parent().parent().find('.field-url-cb input');
        $input.val($value);
    });


    function active_link_type($selector, $value, $input = '') {
        if ($value == 'page') {
            $selector.html(selector.page);
        } else if ($value == 'post') {
            $selector.html(selector.post);
        } else if ($value == 'product') {
            $selector.html(selector.product);
        } else if ($value == 'guides') {
            $selector.html(selector.guides);
        } else if ($value == 'casestudies') {
            $selector.html(selector.casestudies);
        } else if ($value == 'industries') {
            $selector.html(selector.industries);
        } else if ($value == 'popups') {
            $selector.html(selector.popups);
        } else {
            $selector.html('');
        }

        $selector.find('.select-page-selector').val($input);


    }

    setTimeout(function () {
        jQuery('.trigger-selector select').each(function (index, element) {
            $value = jQuery(this).val();
            $selector = jQuery(this).parent().parent().parent().find('.page-selector');
            $input = jQuery(this).parent().parent().parent().find('.field-url-cb input').val();
            active_link_type($selector, $value, $input)
        });
    }, 2000);
}