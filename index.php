<?php defined('_JEXEC') or die; ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="google-site-verification" content="CUK2QtHZRaJlapDP-o5sQUDCqOEsfEkuQLSwESzCGTw" />
	<meta name='yandex-verification' content='502f4172ae86dfeb' />
	<link rel="shortcut icon" href="images/favicon.ico"/>
	<jdoc:include type="head" />
	<?php
		//JHtml::_('bootstrap.framework');
		//JHtmlBootstrap::loadCss(false);
		$doc = JFactory::getDocument();
		$user = JFactory::getUser();
		//$config =& JFactory::getConfig();
		$app        = JFactory::getApplication();
		$template   = $app->getTemplate(true);
		$params     = $template->params;

		$doc->addStyleSheet('/templates/kemping/css/default.css');
		$doc->addStyleSheet('/templates/kemping/css/bootstrap.css');


		$doc->addScript('/templates/kemping/js/jquery.js');
	?>
	<script type="text/javascript">
		function html_head() {
		   document.html.removeAttribute('style');
		   }
		window.onload = function () {
		        html_head();
		   }
		jQuery.noConflict();
			jQuery(document).ready(function($) {
			jQuery(".product-f").each(function(index,value){
				jQuery(this).submit(function(e){
				    e.preventDefault();
				    var m_id = jQuery(this).attr('id');

				    var m_method = jQuery(this).attr('method');
				    var m_action = jQuery(this).attr('action');
				    var m_data = jQuery(this).serialize();

				    jQuery.ajax({
						method: m_method,
						url: m_action,
						data: m_data,
						dataType: 'json',
						success: function(result){
							//console.log(result);
						}
				    });
				});
			});
		});
	</script>
</head>
<body>
	<header class="row"> 
    	<?php if ($this->countModules('mainmenu')) : ?>
			<nav class="span10" id="menu">
					<jdoc:include type="modules" name="mainmenu" style="default"/>
			</nav>
		<?php endif; ?>
		<?php if ($this->countModules('search')) : ?>
			<div class="span2" id="search">
					<jdoc:include type="modules" name="search" style="default"/>
			</div>
		<?php endif; ?>
    </header>
    <div id="wrapper" class="container">
	    <!--#######################################################################-->
		<!--Start######################### Logo ###################################-->
		<!--#######################################################################-->
		<div class="row span12 logo-image">
			<img class="logo" src="templates/kemping/images/header.jpg" alt="" title=""/>
		</div>
		<!--#######################################################################-->
		<!--End########################### Logo ###################################-->
		<!--#######################################################################-->
		<div class="row span12"  id="wrapper-content">
		<!--#######################################################################-->
		<!--Start########################### Left side ############################-->
		<!--#######################################################################-->
		        <?php if ($this->countModules('left')) : ?>
				<aside role="complementary" id="left" class="span3">
						<jdoc:include type="modules" name="left" style="default"/>
		    	</aside>
				<?php endif; ?>
		<!--#######################################################################-->
		<!--End########################### Left side ##############################-->
		<!--#######################################################################-->
		<!--Start########################### Main #################################-->
		<!--#######################################################################-->
			    <div role="main" id="main" class="span8">
			    	<!--#######################################################################-->
					<!--Start########################### Top baner ############################-->
					<!--#######################################################################-->
					<?php if ($this->countModules('topbaner')) : ?>
					<div class="row" id="topbaner">
							<jdoc:include type="modules" name="topbaner" style="default"/>
					</div>
					<?php endif; ?>
					<!--#######################################################################-->
					<!--End############################# Top baner ############################-->
					<!--#######################################################################-->
			        <?php if ($this->countModules('breadcrumbs')) : ?>
					<div class="row" id="breadcrumbs">
							<!-- jot breadcrumbs s style="default" -->
							<jdoc:include type="modules" name="breadcrumbs" style="default"/>
							<!-- jot breadcrumbs e -->
					</div>
					<?php endif; ?>
					<section id="content" class="row">
						<jdoc:include type="component" />
					</section>
			    </div>
		<!--#######################################################################-->
		<!--End########################### Main ###################################-->
		<!--#######################################################################-->
		<!--Start######################### Right ##################################-->
		<!--#######################################################################-->
				<?php if ($this->countModules('right')) : ?>
				<div id="right" class="span2">
						<jdoc:include type="modules" name="right" style="default"/>
				</div>
				<?php endif; ?>
		<!--#######################################################################-->
		<!--End############################ Right #################################-->
		<!--#######################################################################-->
		</div>
	</div>
<!--#######################################################################-->
<!--Start######################### Footer #################################-->
<!--#######################################################################-->
    <?php if ($this->countModules('footer')) : ?>
    <footer class="row span12">
			<jdoc:include type="modules" name="footer" style="default"/>
    </footer>
	<p class="manufactured-by">Manufactured by Dmytro Sytnik (VanArman)</p>
	<?php endif; ?>
<!--#######################################################################-->
<!--End############################ Footer ################################-->
<!--#######################################################################-->
<!-- hit.ua -->
<a href='http://hit.ua/?x=20620' target='_blank'>
<script language="javascript" type="text/javascript"><!--
Cd=document;Cr="&"+Math.random();Cp="&s=1";
Cd.cookie="b=b";if(Cd.cookie)Cp+="&c=1";
Cp+="&t="+(new Date()).getTimezoneOffset();
if(self!=top)Cp+="&f=1";
//--></script>
<script language="javascript1.1" type="text/javascript"><!--
if(navigator.javaEnabled())Cp+="&j=1";
//--></script>
<script language="javascript1.2" type="text/javascript"><!--
if(typeof(screen)!='undefined')Cp+="&w="+screen.width+"&h="+
screen.height+"&d="+(screen.colorDepth?screen.colorDepth:screen.pixelDepth);
//--></script>
<script language="javascript" type="text/javascript"><!--
Cd.write("<img src='http://c.hit.ua/hit?i=20620&g=0&x=2"+Cp+Cr+
"&r="+escape(Cd.referrer)+"&u="+escape(window.location.href)+
"' border='0' wi"+"dth='1' he"+"ight='1'/>");
//--></script>
<noscript>
<img src='http://c.hit.ua/hit?i=20620&amp;g=0&amp;x=2' border='0'/>
</noscript></a>
<!-- / hit.ua -->
</body>
</html>