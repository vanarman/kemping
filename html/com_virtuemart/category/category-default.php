<?php
/**
 *
 * Show the products in a category
 *
 * @package    VirtueMart
 * @subpackage
 * @author RolandD
 * @author Max Milbers
 * @todo add pagination
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: default.php 6556 2012-10-17 18:15:30Z kkmediaproduction $
 */


// Check to ensure this file is included in Joomla!
defined ('_JEXEC') or die('Restricted access');
JHTML::_ ('behavior.modal');
/* javascript for list Slide
  Only here for the order list
  can be changed by the template maker
*/
$js = "
jQuery(document).ready(function () {
	jQuery('.orderlistcontainer').hover(
		function() { jQuery(this).find('.orderlist').stop().show()},
		function() { jQuery(this).find('.orderlist').stop().hide()}
	)
});
";

$document = JFactory::getDocument ();
$document->addScriptDeclaration ($js);

/* Show child categories */

if (VmConfig::get ('showCategory', 1) and empty($this->keyword)) {
	if (!empty($this->category->haschildren)) {

		// Category and Columns Counter
		$iCol = 1;
		$iCategory = 1;

		// Calculating Categories Per Row
		$categories_per_row = VmConfig::get ('categories_per_row', 3);
		$category_cellwidth = ' width' . floor (100 / $categories_per_row);		?>

		<div class="category-view">
		<h1><?php echo $this->category->category_name; ?></h1>
		<?php // Start the Output
		if (!empty($this->category->children)) {

			foreach ($this->category->children as $category) {
				// this is an indicator wether a row needs to be opened or not
				if ($iCol == 1) {
					?>
			<div class="cat-row">
			<?php
				}

				// Show the vertical seperator
				if ($iCategory == $categories_per_row or $iCategory % $categories_per_row == 0) {
					$show_vertical_separator = ' ';
				} else {
					$show_vertical_separator = $verticalseparator;
				}

				// Category Link
				$caturl = JRoute::_ ('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id, FALSE);

				// Show Category
				?>
				<div class="category floatleft<?php echo $category_cellwidth . $show_vertical_separator ?>">
					<div class="spacer">
						<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">
		    		    	<h2>
		    					<?php echo $category->category_name ?>
		    				</h2>
			    			<?php
						    if (!empty($category->images)) {?>
								<img src="<?php echo $category->images[0]->file_url; ?>" alt="Категория <?php echo $category->category_name; ?>" />
							<?php } ?>
		    		    </a>
					</div>
				</div>
				<?php
				$iCategory++;

				// Do we need to close the current row now?
				if ($iCol == $categories_per_row) {
					?>
		</div>
			<?php
					$iCol = 1;
				} else {
					$iCol++;
				}
			}
		}
		// Do we need a final closing row tag?
		if ($iCol != 1) {
			?>
			<div class="clear"></div>
		</div>
	<?php } ?>
	</div>
<div class="clear"></div>
	<?php
	}
}
?>
<div class="browse-view">
<?php

if (!empty($this->keyword)) {
	?>
<h3><?php echo $this->keyword; ?></h3>
	<?php
} ?>
<?php if (!empty($this->keyword)) {

	$category_id  = JRequest::getInt ('virtuemart_category_id', 0); ?>
<form action="<?php echo JRoute::_ ('index.php?option=com_virtuemart&view=category&limitstart=0', FALSE); ?>" method="get">

	<!--BEGIN Search Box -->
	<div class="virtuemart_search">
		<?php echo $this->searchcustom ?>
		<br/>
		<?php echo $this->searchcustomvalues ?>
		<input name="keyword" class="inputbox" type="text" size="20" value="<?php echo $this->keyword ?>"/>
		<input type="submit" value="<?php echo JText::_ ('COM_VIRTUEMART_SEARCH') ?>" class="button" onclick="this.form.keyword.focus();"/>
	</div>
	<input type="hidden" name="search" value="true"/>
	<input type="hidden" name="view" value="category"/>
	<input type="hidden" name="option" value="com_virtuemart"/>
	<input type="hidden" name="virtuemart_category_id" value="<?php echo $category_id; ?>"/>

</form>
<!-- End Search Box -->
	<?php } ?>

<?php // Show child categories ?>

<!-- Description product -->
<?php
if (empty($this->keyword) && !empty($this->category) && !empty($this->category->category_description)) { ?>
	<div class="category-description">
		<?php echo $this->category->category_description; ?>
	</div><?php 
} ?>
<!-- End Description product -->

<?php if (!empty($this->products)) {
	?>
<div class="orderby-displaynumber">
		<?php echo $this->orderByList['orderby']; ?>
		<?php echo $this->orderByList['manufacturer']; ?>
	<div class="display-number"><?php echo $this->vmPagination->getResultsCounter ();?><br/><?php echo $this->vmPagination->getLimitBox ($this->category->limit_list_step); ?></div>
	<div class="clear"></div>
</div> <!-- end of orderby-displaynumber -->

	<?php
	// Category and Columns Counter
	$iBrowseCol = 1;
	$iBrowseProduct = 1;

	// Calculating Products Per Row
	$BrowseProducts_per_row = $this->perRow;
	$Browsecellwidth = ' width' . floor (100 / $BrowseProducts_per_row);

	// Separator
	$verticalseparator = " vertical-separator";

	$BrowseTotalProducts = count($this->products);

	// Start the Output
	foreach ($this->products as $product) {

		// Show the horizontal seperator
		if ($iBrowseCol == 1 && $iBrowseProduct > $BrowseProducts_per_row) {
			?>
		<div class="horizontal-separator"></div>
			<?php
		}

		// this is an indicator wether a row needs to be opened or not
		if ($iBrowseCol == 1) {
			?>
	<div class="cat-row">
	<?php
		}

		// Show the vertical seperator
		if ($iBrowseProduct == $BrowseProducts_per_row or $iBrowseProduct % $BrowseProducts_per_row == 0) {
			$show_vertical_separator = ' ';
		} else {
			$show_vertical_separator = $verticalseparator;
		}

		// Show Products
		?>
		<div class="product floatleft<?php echo $Browsecellwidth . $show_vertical_separator ?>">
			<h2><?php echo JHTML::link ($product->link, $product->product_name); ?></h2>
			<div class="spacer">
				<div class="width70 marginAuto">
				    <a title="<?php echo $product->product_name ?>"  href="<?php echo $product->link; ?>">
				    	<img src="<?php echo $product->images[0]->file_url; ?>" alt="Продукт <?php echo $product->product_name; ?>" />
					</a>
				</div>
				<div>
					<div class="price-area">
						<!-- Display price Start -->
						<div class="product-price" id="productPrice<?php echo $product->virtuemart_product_id ?>">
							<?php
							if ($this->show_prices == '1') {
								if ($product->prices['salesPrice']<=0 and VmConfig::get ('askprice', 1) and  !$product->images[0]->file_is_downloadable) {
									$askquestion_url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id, FALSE);
									//echo $askquestion_url;
									echo '<a class="askprice" href="'.$askquestion_url.'" title="'.JText::_ ('COM_VIRTUEMART_PRODUCT_ASKPRICE').' '.$product->product_name.'"> ' . JText::_ ('COM_VIRTUEMART_PRODUCT_ASKPRICE') . '</a>';
								} else {
									if (!($product->prices['salesPrice'] == $product->prices['costPrice'] || (!isset($product->prices['costPrice'])))){?>
										<div class="discountAndOldPrice"><?php
											echo $this->currency->createPriceDiv ('costPrice', '', $product->prices['costPrice'],false,false,1.0,false,'productdet');
											echo $this->currency->createPriceDiv ('discountAmount', '', $product->prices['discountAmount'],false,false,1.0,false,'productdet');?>
										</div><?php
										echo $this->currency->createPriceDiv ('salesPrice', '', $product->prices['salesPrice'],false,false,1.0,false,'productdet');
									} else {
										echo $this->currency->createPriceDiv ('salesPrice', '', $product->prices['salesPrice'],false,false,1.0,false,'only');
									}
								} 
							}?>
						</div>
						<!-- Display price end -->
						<?php
						if (!($product->prices['salesPrice']<=0 and VmConfig::get ('askprice', 1) and  !$product->images[0]->file_is_downloadable)) { ?>
						<!-- Add to cart start -->
						<form method="post" class="product" action="index.php" id="addtocartproduct<?php echo $product->virtuemart_product_id ?>">
							<div class="addtocartBlock-bar">
								<!-- Add costum filds start -->
								<?php if (isset($product->customfieldsCart[0]->options)){ ?>
								<div class="costumFildsBlock">
									<?php
									foreach($product->customfieldsCart[0]->options as $field) {
										echo "<div class='costumFildTitle'>" . $product->customfieldsCart[0]->custom_title . ":</div>";
										print_r($product->customfieldsCart[0]->display);
									}
									?>
								</div>
								<?php } ?>
								<!-- Add costum filds end -->
								<?php // Display the quantity box ?>
								<div class="addtocartBlock">
									<span class="quantity-box">
										<input  type="text" class="quantity-input" name="quantity[]" value="1" />
									</span>
									<span class="quantity-controls">
										<input type="button" class="quantity-controls quantity-plus"/>
										<input type="button" class="quantity-controls quantity-minus" />
									</span>
									<?php // Display the quantity box END ?>

									<?php // Add the button
									$button_lbl = JText::_('COM_VIRTUEMART_CART_ADD_TO');
									$button_cls = ''; //$button_cls = 'addtocart_button';
									if (VmConfig::get('check_stock') == '1' && !$this->product->product_in_stock) {
										$button_lbl = JText::_('COM_VIRTUEMART_CART_NOTIFY');
										$button_cls = 'notify-button';
									} ?>

									<?php // Display the add to cart button ?>
									<span class="addtocart-button">
										<input type="submit" name="addtocart"  class="addtocart-button" value="<?php echo $button_lbl ?>" title="<?php echo $button_lbl ?>" />
									</span>
								</div>
								<div class="clear"></div>


								<?php // Display the add to cart button END ?>
								<input type="hidden" class="pname" value="<?php echo $product->product_name ?>">
								<input type="hidden" name="option" value="com_virtuemart" />
								<input type="hidden" name="view" value="cart" />
								<noscript><input type="hidden" name="task" value="add" /></noscript>
								<input type="hidden" name="virtuemart_product_id[]" value="<?php echo $product->virtuemart_product_id ?>" />
								<?php /** @todo Handle the manufacturer view */ ?>
								<input type="hidden" name="virtuemart_manufacturer_id" value="<?php echo $product->virtuemart_manufacturer_id ?>" />
								<input type="hidden" name="virtuemart_category_id[]" value="<?php echo $product->virtuemart_category_id ?>" />
							</div>
						</form>
						<!-- Add to cart end -->
						<?php } ?>





					</div>
					<?php // Product Short Description
					if (!empty($product->product_s_desc)) {
					?>
					<p class="product_s_desc">
						<?php echo shopFunctionsF::limitStringByWord ($product->product_s_desc, 500, '...') ?>
					</p>
					<?php } ?>

					<p class="productDetailButton">
						<?php // Product Details Button
						echo JHTML::link ($product->link, JText::_ ('COM_VIRTUEMART_PRODUCT_DETAILS'), array('title' => $product->product_name, 'class' => 'product-details'));
						?>
					</p>

				</div>
				<div class="clear"></div>
			</div>
			<!-- end of spacer -->
		</div> <!-- end of product -->
		<?php

		// Do we need to close the current row now?
		if ($iBrowseCol == $BrowseProducts_per_row || $iBrowseProduct == $BrowseTotalProducts) {
			?>
			<div class="clear"></div>
   </div> <!-- end of row -->
			<?php
			$iBrowseCol = 1;
		} else {
			$iBrowseCol++;
		}

		$iBrowseProduct++;
	} // end of foreach ( $this->products as $product )
	// Do we need a final closing row tag?
	if ($iBrowseCol != 1) {
		?>
	<div class="clear"></div>

		<?php
	}
	?>

<div class="pagination"><?php echo $this->vmPagination->getPagesLinks (); ?><!-- <span><?php //echo $this->vmPagination->getPagesCounter (); ?></span> --></div>

	<?php
} elseif (!empty($this->keyword)) {
	echo JText::_ ('COM_VIRTUEMART_NO_RESULT') . ($this->keyword ? ' : (' . $this->keyword . ')' : '');
}
?>
</div><!-- end browse-view -->