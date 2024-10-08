jQuery(document).ready(function () {
    swiper_sliders();
});

function swiper_sliders() {

    if (jQuery('.post-sliders .post-sliders-post').length > 0) {
        jQuery('.post-sliders .post-sliders-post').each(function (index, element) {
            $id = jQuery(this).attr('id');
            var swiper = new Swiper('#' + $id + ' .swiper-post-slider', {
                spaceBetween: 20,
                pagination: {
                    el: '#' + $id + ' .swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '#' + $id + ' .swiper-button-next',
                    prevEl: '#' + $id + ' .swiper-button-prev',
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1.2,
                    },
                    768: {
                        slidesPerView: 1.95,
                    },
                    992: {
                        slidesPerView: 2.95,
                    },
                    1200: {
                        slidesPerView: 2.95,
                    },
                    1441: {
                        slidesPerView: 3.95,
                    },
                }
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