<div class="billto-shipto checkpage">
<ul class="columns-2 checkoutfr clearfix">
	<li class="col2 clearfix">
    <span class="vmicon vm2-billto-icon check-title"></span>
		 <div class="output-billto"><?php echo JText::_('COM_VIRTUEMART_USER_FORM_EDIT_BILLTO_LBL'); ?> 
		<?php
		if(JFactory::getUser()->get('id')>0) {
			?>
			</div> <div class="clr"></div>
			<?php
		}
		if(JFactory::getUser()->get('id')==0 && VmConfig::get('oncheckout_show_register')) {
			?><br />
			<input class="inputbox" type="checkbox" name="register" id="register" value="1" onclick="toggle_register(this.checked);" <?php echo $this->params->get('check_register')?'checked="checked"':''; ?>/>
			<?php echo JText::_('COM_VIRTUEMART_REGISTER'); ?> </div> <div class="clr"></div>
		<?php
		}
		$userFields=array('agreed','name','username','password','password2');
		echo '<div id="div_billto">';
		echo '	<div class="adminform user-details" id="table_user" '.($this->params->get('check_register')?'':'style="display:none"').'>' . "\n";
		foreach($this->helper->BTaddress["fields"] as $_field) {
			if(!in_array($_field['name'],$userFields)) {
				continue;
			}
			if($_field['name']=='agreed') {
				continue;
			}  
		    echo '				<label class="' . $_field['name'] . ' full-input" for="' . $_field['name'] . '_field">' . "\n";
		    echo '					' . $_field['title'] . ($_field['required'] ? ' *' : '') . "\n";
		    echo '				</label>' . "\n";
		    echo '				' . $_field['formcode'] . "\n";
		}
		echo '	</div>' . "\n";
		echo '	<div class="adminform user-details" id="table_billto">' . "\n";
		foreach($this->helper->BTaddress["fields"] as $_field) {
			if(in_array($_field['name'],$userFields)) {
				continue;
			} 
		    echo '				<label class="' . $_field['name'] . ' full-input" for="' . $_field['name'] . '_field">' . "\n";
		    echo '					' . $_field['title'] . ($_field['required'] ? ' *' : '') . "\n";
		    echo '				</label>' . "\n";
		    if($_field['name']=='zip') {
		    	$_field['formcode']=str_replace('input','input onchange="update_form();"',$_field['formcode']);
		    } else if($_field['name']=='virtuemart_country_id') {
		    	$_field['formcode']=str_replace('<select','<select onchange="update_form();"',$_field['formcode']);
		    } else if($_field['name']=='virtuemart_state_id') {
		    	$_field['formcode']=str_replace('<select','<select onchange="update_form();"',$_field['formcode']);
		    }
		    echo '				' . $_field['formcode'] . "\n";
		}
	    echo '	</div>' . "\n";
	    echo '</div>';
		?>
	</li>

	<li class="col2 clearfix" id="div_shipto">
		<span class="vmicon vm2-shipto-icon check-title"></span>
		  <div class="output-shipto">
		<?php
		if(!empty($this->cart->STaddress['fields'])){
			if(!class_exists('VmHtml'))require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'html.php');
				echo JText::_('COM_VIRTUEMART_USER_FORM_ST_SAME_AS_BT');
				?>
				<input class="inputbox" type="checkbox" name="STsameAsBT" id="STsameAsBT" <?php echo $this->params->get('check_shipto_address')==1?'checked="checked"':''; ?> value="1" onclick="set_st(this);"/>
				<?php
		}
 		?>
		
		</div>  <div class="clr"></div>
		<?php if(!isset($this->cart->lists['current_id'])) $this->cart->lists['current_id'] = 0; ?>
		<?php
		echo '	<div class="adminform user-details" id="table_shipto" '.($this->params->get('check_shipto_address')==1?'style="display:none"':'').'>' . "\n";
		foreach($this->helper->STaddress["fields"] as $_field) {
		    echo '				<label class="' . $_field['name'] . '" for="' . $_field['name'] . '_field">' . "\n";
		    echo '					' . $_field['title'] . ($_field['required'] ? ' *' : '') . "\n";
		    echo '				</label>' . "\n";
		    if($_field['name']=='shipto_zip') {
		    	$_field['formcode']=str_replace('input','input onchange="update_form();"',$_field['formcode']);
		    } else if($_field['name']=='shipto_virtuemart_country_id') {
		    	$_field['formcode']=str_replace('<select','<select onchange="update_form();add_countries();"',$_field['formcode']);
		    	$_field['formcode']=str_replace('class="virtuemart_country_id','class="shipto_virtuemart_country_id',$_field['formcode']);
		    } else if($_field['name']=='shipto_virtuemart_state_id') {
		    	$_field['formcode']=str_replace('id="virtuemart_state_id"','id="shipto_virtuemart_state_id"',$_field['formcode']);
		    	$_field['formcode']=str_replace('<select','<select onchange="update_form();"',$_field['formcode']);
		    }
		    echo '				' . $_field['formcode'] . "\n";
		}
	    echo '	</div>' . "\n";
		?>

	</li>
</ul>
</div>
