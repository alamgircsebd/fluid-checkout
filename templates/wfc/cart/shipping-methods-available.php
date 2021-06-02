<?php
/**
 * Cart shipping methods available
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/wfc/cart/shipping-methods-available.php.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package fluid-checkout
 * @version 1.2.0
 * @wc-version 3.6.0
 * @wc-original cart/cart-shipping.php
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shipping shipping-method__package" data-title="<?php echo esc_attr( $package_name ); ?>" data-package-index="<?php echo esc_attr( $package_index ); ?>">

<?php if ( count( $available_methods ) > 0 ) : ?>

	<?php echo apply_filters( 'wfc_shipping_method_option_start_tag_markup', '<ul id="shipping_method" class="shipping-method__options">' ); ?>

	<?php
	$first = true;
	foreach ( $available_methods as $method ) :
		$checked_method = ! $chosen_method ? $first === true : $method->id == $chosen_method;

		echo apply_filters( 'wfc_shipping_method_option_markup',
			sprintf( '<li class="shipping-method__option"><input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />
				<label for="shipping_method_%1$d_%2$s" class="shipping-method__option-label has-price">%5$s</label>
			</li>',
			$package_index,
			sanitize_title( $method->id ),
			esc_attr( $method->id ),
			checked( $checked_method, true, false ),
			FluidCheckout_Steps::instance()->get_cart_shipping_methods_label( $method )
		), $method, $package_index, $chosen_method, $first );

		do_action( 'woocommerce_after_shipping_rate', $method, $package_index );

		$first = false;
	endforeach; ?>

	<?php echo apply_filters( 'wfc_shipping_method_option_end_tag_markup', '</ul>' ); ?>

	<?php if ( $show_package_details ) : ?>
	<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
	<?php endif; ?>

	<?php if ( ! empty( $show_shipping_calculator ) ) : ?>
	<?php woocommerce_shipping_calculator(); ?>
	<?php endif; ?>

<?php else: ?>

	<div class="woocommerce-error">
		<?php echo apply_filters( 'woocommerce_cart_no_shipping_available_html', wpautop( __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) ); ?>
	</div>

<?php endif; ?>

</div>
