jQuery(document).ready(function () {
    swiper_sliders();
    modals();
    header_menu();
    ajax_trigger();
    story();
});

function story() {

    jQuery('.video-player').each(function (index, element) {
        var video = jQuery(this).find('video').get(0);
        jQuery(this).hover(
            function () {
                video.play();

            },
            function () {
                video.pause();
            }
        );

    });
}
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

    jQuery('.dropdown-menu').each(function (index, element) {
        $height = jQuery(this).outerHeight();
        jQuery(this).parent().css('--height', $height + 'px');
        jQuery(this).addClass('activate-styling');
    });

    if (window.innerWidth > 991) {
        jQuery('.dropdown').hover(function () {
            jQuery(this).addClass('show');
            jQuery(this).find('.dropdown-menu').addClass('show');
        }, function () {
            jQuery(this).removeClass('show');
            jQuery(this).find('.dropdown-menu').removeClass('show');
        });
    }

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

    if (jQuery('.swiper-post-slider-style-2').length > 0) {
        jQuery('.swiper-post-slider-style-2').each(function (index, element) {
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

    if (jQuery('.swiper-stories-single').length > 0) {
        jQuery('.swiper-stories-single .swiper-wrapper').each(function (index, element) {
            $height = jQuery(this).outerHeight();
            jQuery(this).css('--height', $height + 'px');
        });
    }
    setTimeout(function () {
        var swiper_single_stories = new Swiper(".swiper-stories-single", {
            direction: "vertical",
            autoHeight: true,
            spaceBetween: 30,
            mousewheel: true, 
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    }, 100);

}

function post_ajax() {
    $archive_section = jQuery('.ajax-loading');
    $result_holder = jQuery('#results .row');
    $archive_section.addClass('loading-post');

    $post_type = jQuery('input[name="post_type"]').val();
    $posts_per_page = jQuery('input[name="posts_per_page"]').val();
    $current_post = jQuery('input[name="current_post"]').val();

    var $excludes_ids = { 0: $current_post };
    jQuery('#results .post-item').each(function (index, element) {
        $post_id = jQuery(this).attr('post_id');
        $excludes_ids[index + 1] = $post_id;
    });


    jQuery.ajax({
        type: "POST",
        url: ajax_object.ajax_url,

        data: {
            action: 'post_ajax',
            post_type: $post_type,
            posts_per_page: $posts_per_page,
            excludes_ids: $excludes_ids
        },

        success: function (response) {
            jQuery(response).appendTo($result_holder);
            setTimeout(function () {
                jQuery('.post-hidden').removeClass('post-hidden');
            }, 10);

            $archive_section.removeClass('loading-post');
        },
        error: function (e) {
            console.log(e);
        }
    });

}

function ajax_trigger() {
    jQuery('#load-more-team').click(function (e) {
        post_ajax();
        e.preventDefault();
    });
}