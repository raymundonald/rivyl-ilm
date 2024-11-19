jQuery(document).ready(function () {
    swiper_sliders();
    modals();
    header_menu();
});
function modals() {
    jQuery('.listen-modal').click(function (e) {
        jQuery('#listenModal').modal('show');
    });
}

function header_menu() {
    var offCanvasMenu = document.getElementById('sideOutMenu')
    offCanvasMenu.addEventListener('show.bs.offcanvas', function () {
        jQuery('body').addClass('mobile-menu-active');
    });

    offCanvasMenu.addEventListener('hide.bs.offcanvas', function () {
        jQuery('body').removeClass('mobile-menu-active');
    });
    jQuery('.dropdown').hover(function () {
        jQuery(this).addClass('show');
        jQuery(this).find('.dropdown-menu').addClass('show');
    }, function () {
        jQuery(this).removeClass('show');
        jQuery(this).find('.dropdown-menu').removeClass('show');
    });
}
function swiper_sliders() {

    if (jQuery('.post-sliders .post-sliders-post').length > 0) {
        jQuery('.post-sliders .post-sliders-post').each(function (index, element) {
            $id = jQuery(this).attr('id');
            var swiper = new Swiper('#' + $id + ' .swiper-post-slider', {
                spaceBetween: 20,
                slidesPerView: 'auto',
                pagination: {
                    el: '#' + $id + ' .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '#' + $id + ' .swiper-button-next',
                    prevEl: '#' + $id + ' .swiper-button-prev',
                },

            });

        });
    }

    setTimeout(function () {

        jQuery('.post-post .swiper-post-slider').each(function (index, element) {
            var height = 0;
            image_height = jQuery(this).find('.swiper-slide .image-box img').outerHeight(false);


            jQuery(this).find('.swiper-slide .post-content').each(function (index, element) {
                el_height = jQuery(this).outerHeight();
                if (el_height > height) {
                    height = el_height;
                }
            });

            bottom = height - image_height;

            jQuery(this).css('--height', height + 'px');
            jQuery(this).css('--image-height', image_height + 'px');
            jQuery(this).css('--bottom', '-' + bottom + 'px');

        });



        jQuery('.post-podcasts .swiper-post-slider').each(function (index, element) {
            height = jQuery(this).find('.swiper-wrapper').outerHeight();
            jQuery(this).css('--height', height + 'px');
            jQuery(this).addClass('fixed-height');

        });

    }, 100);




}