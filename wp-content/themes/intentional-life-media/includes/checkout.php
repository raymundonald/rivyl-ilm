<?php

/**
 * @snippet       Item Quantity Inputs @ WooCommerce Checkout
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 7
 * @community     https://businessbloomer.com/club/
 */

// ----------------------------
// Add Quantity Input Beside Product Name

add_filter('woocommerce_checkout_cart_item_quantity', 'bbloomer_checkout_item_quantity_input', 9999, 3);

function bbloomer_checkout_item_quantity_input($product_quantity, $cart_item, $cart_item_key)
{
    $product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
    if (!$product->is_sold_individually()) {
        $product_quantity = '<div class="quantity-parent">';
        $product_quantity .= '<button type="button" class="minus" target="shipping_method_qty_' . $product_id . '">-</button>';
        $product_quantity .= woocommerce_quantity_input(array(
            'input_name'  => 'shipping_method_qty_' . $product_id,
            'input_value' => $cart_item['quantity'],
            'max_value'   => $product->get_max_purchase_quantity(),
            'min_value'   => '0',
        ), $product, false);
        $product_quantity .= '<input type="hidden" name="product_key_' . $product_id . '" value="' . $cart_item_key . '">';
        $product_quantity .= '<button type="button" class="plus" target="shipping_method_qty_' . $product_id . '">+</button>';
        $product_quantity .= '</div>';
    }
    return $product_quantity;
}

// ----------------------------
// Detect Quantity Change and Recalculate Totals

add_action('woocommerce_checkout_update_order_review', 'bbloomer_update_item_quantity_checkout');

function bbloomer_update_item_quantity_checkout($post_data)
{
    parse_str($post_data, $post_data_array);
    $updated_qty = false;
    foreach ($post_data_array as $key => $value) {
        if (substr($key, 0, 20) === 'shipping_method_qty_') {
            $id = substr($key, 20);
            WC()->cart->set_quantity($post_data_array['product_key_' . $id], $post_data_array[$key], false);
            $updated_qty = true;
        }
    }
    if ($updated_qty) WC()->cart->calculate_totals();
}

function theme_wc_setup()
{
    remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
    add_action('custom_woocommerce_checkout_shipping', 'woocommerce_checkout_payment', 20);
}
add_action('after_setup_theme', 'theme_wc_setup');


add_filter('woocommerce_checkout_fields', 'custom_checkout_order_notes');
function custom_checkout_order_notes($fields)
{
    $fields['order']['order_comments']['class'][] = 'off';
    return $fields;
}

add_action('woocommerce_before_order_notes', 'checkout_checkbox_show_hide_order_notes');
function checkout_checkbox_show_hide_order_notes($fields)
{
    $target_id = 'order_comments';
?>
    <style>
        p#<?php echo $target_id; ?>_field.off {
            display: none;
        }
    </style>
    <script type="text/javascript">
        jQuery(function($) {
            var a = 'input#checkbox_trigger',
                b = '#<?php echo $target_id; ?>_field';

            $(b).hide('fast');

            $(a).change(function() {
                if ($(b).hasClass('off')) {
                    $(b).removeClass('off');
                }

                if ($(this).prop('checked')) {
                    $(b).show('fast');
                } else {
                    $(b).hide('fast', function() {
                        $(b + ' input').val('');
                    });
                }
            });
        });
    </script>
<?php

    woocommerce_form_field('checkbox_trigger', array(
        'type'      => 'checkbox',
        'label'     => __('Order notes?', 'woocommerce'),
        'class'     => array('form-row-wide'),
        'clear'     => true,
    ), false);
}

function ajax_apply_coupon_cart()
{
    if (!isset($_POST['coupon_code']) || empty($_POST['coupon_code'])) {
        wp_send_json(['success' => false, 'data' => ['message' => 'No coupon code provided']], 200);
        // return; // <== Not needed as wp_send_json() throws die();
    }
    $coupon_code = sanitize_text_field($_POST['coupon_code']);

    if (!WC()->cart->has_discount($coupon_code)) {
        $coupon_id = wc_get_coupon_id_by_code($coupon_code);

        if (!$coupon_id) {
            wp_send_json(['success' => false, 'data' => ['message' => sprintf(__('Coupon  does not exist!', 'woocommerce'), $coupon_code)]], 200);
            // return; // <== Not needed as wp_send_json() throws die();
        }

        $result = WC()->cart->apply_coupon($coupon_code); // Apply coupon

        if ($result) {
            WC()->cart->calculate_totals(); // <=== Refresh totals (Missing)

            wp_send_json_success(['message' => sprintf(__('Coupon  applied successfully.', 'woocommerce'), $coupon_code)], 200);
        }
    } else {
        wp_send_json_error(['message' => sprintf(__('Coupon  is already applied!', 'woocommerce'), $coupon_code)], 200);
    }
}



add_action('wp_ajax_nopriv_coupon_ajax', 'coupon_ajax'); // for not logged in users
add_action('wp_ajax_coupon_ajax', 'coupon_ajax');
function coupon_ajax()
{
    $coupon_code = $_POST['coupon_code'];
    if ($coupon_code) {
        if (!WC()->cart->has_discount($coupon_code)) {

            if (wc_get_coupon_id_by_code($coupon_code)) {
                WC()->cart->apply_coupon($coupon_code);
                echo 'Coupon code applied successfully.';
            } else {
                echo '<span class="failed">Please enter a valid coupon code.</span>';
            }
        } else {


            echo '<span class="failed">Coupon code is already applied.</span>';
        }
    } else {
        echo '<span class="failed">Please enter a valid coupon code.</span>';
    }

    die();
}


add_filter('wc_stripe_upe_params', function ($stripe_params) {
    $removeFontFamily = function (&$object) use (&$removeFontFamily) {
        foreach ($object as $key => &$value) {
            if ($key === 'fontFamily') {
                unset($object->$key);
            } elseif (is_object($value)) {
                $removeFontFamily($value);
            }
        }
    };

    // Removes all default font families set in appearance rules and sets a global fontFamily variable to `sans-serif`.
    if (isset($stripe_params['appearance']) && is_object($stripe_params['appearance'])) {
        $removeFontFamily($stripe_params['appearance']);
        $stripe_params['appearance']->variables = (object) ['fontFamily' => 'Inter, Helvetica, Arial, sans-serif'];
    }

    if (isset($stripe_params['upeAppearance']) && is_object($stripe_params['upeAppearance'])) {
        $removeFontFamily($stripe_params['upeAppearance']);
        $stripe_params['upeAppearance']->variables = (object) ['fontFamily' => 'Inter, Helvetica, Arial, sans-serif'];
    }

    return $stripe_params;
});