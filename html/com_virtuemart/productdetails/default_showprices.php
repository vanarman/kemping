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

	if ($this->product->prices['salesPrice']<=0 and VmConfig::get ('askprice', 1) and isset($this->product->images[0]) and !$this->product->images[0]->file_is_downloadable) {?>
		<a class="ask-a-question askprice" href="<?php echo $this->askquestion_url ?>" rel="nofollow" ><?php echo JText::_ ('COM_VIRTUEMART_PRODUCT_ASKPRICE') ?></a><?php
	} else {
		if (!($this->product->prices['salesPrice'] == $this->product->prices['costPrice'] || (!isset($this->product->prices['costPrice'])))){
			echo $this->currency->createPriceDiv ('costPrice', '', $this->product->prices['costPrice']);
			echo $this->currency->createPriceDiv ('discountAmount', '', $this->product->prices['discountAmount'],false,false,1.0,false,'');
			echo $this->currency->createPriceDiv ('salesPrice', '', $this->product->prices['salesPrice'],false,false,1.0,false,'');
		} else {
			echo $this->currency->createPriceDiv ('salesPrice', '', $this->product->prices['salesPrice'],false,false,1.0,false,'only');
		}
		
	}	?>
</div>
