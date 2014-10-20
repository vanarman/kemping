<?php // no direct access
defined('_JEXEC') or die('Restricted access');

//dump ($cart,'mod cart');
// Ajax is displayed in vm_cart_products
// ALL THE DISPLAY IS Done by Ajax using "hiddencontainer" ?>

<!-- Virtuemart 2 Ajax Card -->
<div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?>" id="vmCartModule">
<?php
if ($show_product_list) {
	?>
	<div id="hiddencontainer" style=" display: none; ">
		<div class="container">
			<?php if ($show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) { ?>
			  <div class="prices" style="float: right;"></div>
			<?php } ?>
			<div class="product_row">
				<span class="quantity"></span>&nbsp;x&nbsp;<span class="product_name"></span>
			</div>

			<div class="product_attributes"></div>
		</div>
	</div>
<?php if(empty($data->products)) {?>
	<div class="vm_cart_products empty">
	<?php } else { ?>
	<div class="vm_cart_products full">
	<?php } ?>
		<div class="cart-container">

		<?php
			foreach ($data->products as $product) { ?>
				<div class="cart-product">
					<div class="product_name"> <span class="quantity"><?php echo  $product['quantity'] ?></span>&nbsp;x&nbsp;<?php echo  $product['product_name'] ?></div>
					<?php if (isset($product['product_attributes'])) { ?>
						<div class="product_attributes"><?php echo $product['product_attributes'] ?></div>
					<?php } ?>
					<div class="prices" style="float: right;"><?php echo  $product['prices']; ?></div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<?php if ($data->totalProduct and $show_price and $currencyDisplay->_priceConfig['salesPrice'][0]) { ?>
	<div class="total">
		<?php echo $data->billTotal; ?>
	</div>
<?php } ?>
<div class="show_cart">
	<?php if ($data->totalProduct) echo  $data->cart_show; ?>
</div>
<div style="clear:both;"></div>
	<div class="payments_signin_button" ></div>

<noscript>
<?php echo JText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
</noscript>
</div>

