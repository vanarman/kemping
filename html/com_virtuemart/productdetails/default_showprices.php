<?php
/**
 *
 * Show the product details page
 *
 * @package    VirtueMart
 * @subpackage
 * @author Max Milbers, Valerie Isaksen
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default_showprices.php 6556 2012-10-17 18:15:30Z kkmediaproduction $
 */
// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
?>
<div class="price-area" id="productPrice<?php echo $this->product->virtuemart_product_id ?>">
	<?php

	if ($this->product->prices['salesPrice']<=0 and VmConfig::get ('askprice', 1) and isset($this->product->images[0]) and !$this->product->images[0]->file_is_downloadable) {
		?>
		<a class="ask-a-question askprice" href="<?php echo $this->askquestion_url ?>" rel="nofollow" ><?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_ASKPRICE') ?></a>
		<?php
	} else {
	if ($this->showBasePrice) {
		echo $this->currency->createPriceDiv ('basePrice', 'COM_VIRTUEMART_PRODUCT_BASEPRICE', $this->product->prices);
		if (round($this->product->prices['basePrice'],$this->currency->_priceConfig['basePriceVariant'][1]) != $this->product->prices['basePriceVariant']) {
			echo $this->currency->createPriceDiv ('basePriceVariant', 'COM_VIRTUEMART_PRODUCT_BASEPRICE_VARIANT', $this->product->prices);
		}

	}
	echo $this->currency->createPriceDiv ('variantModification', 'COM_VIRTUEMART_PRODUCT_VARIANT_MOD', $this->product->prices);
	if (round($this->product->prices['basePriceWithTax'],$this->currency->_priceConfig['salesPrice'][1]) != $this->product->prices['salesPrice']) {
		echo '<span class="price-crossed" >' . $this->currency->createPriceDiv ('basePriceWithTax', 'COM_VIRTUEMART_PRODUCT_BASEPRICE_WITHTAX', $this->product->prices) . "</span>";
	}
	if (round($this->product->prices['salesPriceWithDiscount'],$this->currency->_priceConfig['salesPrice'][1]) != $this->product->prices['salesPrice']) {
		echo $this->currency->createPriceDiv ('salesPriceWithDiscount', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITH_DISCOUNT', $this->product->prices);
	}
	echo $this->currency->createPriceDiv ('salesPrice', 'COM_VIRTUEMART_PRODUCT_SALESPRICE', $this->product->prices);
	if ($this->product->prices['discountedPriceWithoutTax'] != $this->product->prices['priceWithoutTax']) {
		echo $this->currency->createPriceDiv ('discountedPriceWithoutTax', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITHOUT_TAX', $this->product->prices);
	} else {
		echo $this->currency->createPriceDiv ('priceWithoutTax', 'COM_VIRTUEMART_PRODUCT_SALESPRICE_WITHOUT_TAX', $this->product->prices);
	}
	//echo $this->currency->createPriceDiv ('discountAmount', 'COM_VIRTUEMART_PRODUCT_DISCOUNT_AMOUNT', $this->product->prices);
	//print_r($this->product);
	$discountAmountCalc = $this->product->product_price - $this->product->product_override_price;
		//echo get_type($this->product->prices->discountAmount);
	//$discountAmount = (int) $this->product->prices->discountAmount;
	if ($discountAmountCalc > 0 ) {

	?>
	<div class="PricediscountAmount productdet" style="display : block;">
		<span class="PricediscountAmount productdet"><?php echo $discountAmountCalc; ?></span>
	</div>
	<?php } ?>

	<?php
	echo $this->currency->createPriceDiv ('taxAmount', 'COM_VIRTUEMART_PRODUCT_TAX_AMOUNT', $this->product->prices);
	$unitPriceDescription = JText::sprintf ('COM_VIRTUEMART_PRODUCT_UNITPRICE', JText::_('COM_VIRTUEMART_UNIT_SYMBOL_'.$this->product->product_unit));
	echo $this->currency->createPriceDiv ('unitPrice', $unitPriceDescription, $this->product->prices);
	}
	?>
</div>
