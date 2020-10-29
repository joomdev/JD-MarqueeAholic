<?php
/*-------------------------------------------------------------------------------
# MarqueeAholic - Marquee module for Joomla 3.x v1.5.0
# -------------------------------------------------------------------------------
# author    GraphicAholic
# copyright Copyright (C) 2011 GraphicAholic.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.graphicaholic.com
--------------------------------------------------------------------------------*/
// No direct access
defined('_JEXEC') or die('Restricted access');  
?>  
<?php if($loadjQuery == "1"):?>	
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<?php endif ?>	
<?php if($loadScripts == "2"):?>	
<script src="<?php echo $modbase ?>js/jquery.marquee.min.js"></script>
<script src="<?php echo $modbase ?>js/jquery.pause.js"></script>
<script src="<?php echo $modbase ?>js/jquery.easing.min.js"></script>
<?php endif ?>	
<script type="text/javascript">
			jQuery(function(){
				var $mwo = jQuery('.marquee-with-options-<?php echo $moduleID; ?>');
				jQuery('.marquee').marquee ();
				jQuery('.marquee-with-options-<?php echo $moduleID; ?>').marquee ({
					speed: <?php echo $params->get('marqueeSpeed') ?>, //speed in milliseconds of the marquee
					gap: <?php echo $params->get('marqueeGap') ?>, //gap in pixels between the tickers
					delayBeforeStart: <?php echo $params->get('marqueeDelay') ?>, //gap in pixels between the tickers
					direction: '<?php echo $params->get('marqueeDirection') ?>', //'left' or 'right'
					duplicated: <?php echo $marqueeDuplication ?>, //true or false - should the marquee be duplicated to show an effect of continues flow
					pauseOnHover: <?php echo $marqueePause ?>, //on hover pause the marquee
					pauseOnCycle: false //on cycle pause the marquee
				});
			});
</script>   
<?php if ($outsideSource == "0" || $outsideSource == "1" || $outsideSource == "2") { ?>
<style type="text/css">
.marquee-with-options-<?php echo $moduleID; ?> {direction: <?php echo $params->get('marqueeForceDirection') ?>; overflow: hidden !important; color: <?php echo $params->get('marqueeFontColor') ?>; font-family:<?php echo $params->get('marqueeFontFamily') ?>; font-size: <?php echo $params->get('marqueeFontSize') ?>; line-height: <?php echo $params->get('marqueeFontlineheight') ?>; height: <?php echo $params->get('marqueeHeight') ?>; width: <?php echo $params->get('marqueeWidth') ?>; background: <?php echo $params->get('marqueeBackground') ?> !important; border: <?php echo $params->get('marqueeBorder') ?> <?php echo $params->get('marqueeBorderStyle') ?> <?php echo $params->get('marqueeBorderColor') ?>; margin-bottom: <?php echo $params->get('marqueeBottomMargin') ?>; text-decoration: none;}
.marquee-with-options-<?php echo $moduleID; ?> a:hover {color: <?php echo $params->get('marqueeFontLinkColor') ?> !important;}
.marquee-with-options-<?php echo $moduleID; ?> a {color: <?php echo $params->get('marqueeFontHoverColor') ?> !important;}
</style>
<?php } ?>  
<?php if ($outsideSource == "0"): ?>
	<?php if ($marqueeURL == "1"): ?>	
		<div class='marquee-with-options-<?php echo $moduleID; ?>'><a href="<?php echo $params->get('hyperLink') ?>" target="_<?php echo $params->get('linkWindow') ?>"> <?php echo $params->get('marqueeText') ?></a><?php echo $feedSpacing;?></div>
<?php endif ; ?>
<?php if ($marqueeURL == "0"): ?>	
	<div class='marquee-with-options-<?php echo $moduleID; ?>'><?php echo $params->get('marqueeText') ?><?php echo $feedSpacing;?></div>	
	<?php endif ; ?>
<?php endif ; ?>	
<?php if ($outsideSource == "1"): ?>	
	<div class='marquee-with-options-<?php echo $moduleID; ?> <?php echo $moduleclass_sfx;?>'><?php echo file_get_contents("$externalURL", NULL, NULL, NULL, $wordCount); ?><?php echo $feedSpacing;?></div>	
<?php endif ; ?>


<?php if ($outsideSource == "2") { ?>    
	<div class="marquee-with-options-<?php echo $moduleID; ?> <?php echo $moduleclass_sfx;?>">
        
<?php
if (!empty($feed) && is_string($feed))
{
	echo $feed;
}
else
{
	$lang      = JFactory::getLanguage();
	$myrtl     = $params->get('rssrtl', 0);
	$direction = ' ';

	$isRtl = $lang->isRtl();

	if ($isRtl && $myrtl == 0)
	{
		$direction = ' redirect-rtl';
	}

	// Feed description
	elseif ($isRtl && $myrtl == 1)
	{
		$direction = ' redirect-ltr';
	}

	elseif ($isRtl && $myrtl == 2)
	{
		$direction = ' redirect-rtl';
	}

	elseif ($myrtl == 0)
	{
		$direction = ' redirect-ltr';
	}
	elseif ($myrtl == 1)
	{
		$direction = ' redirect-ltr';
	}
	elseif ($myrtl == 2)
	{
		$direction = ' redirect-rtl';
	}

	if ($feed !== false)
	{
		// Image handling
		$iUrl   = isset($feed->image) ? $feed->image : null;
		$iTitle = isset($feed->imagetitle) ? $feed->imagetitle : null;
		?>
		<div style="direction: <?php echo $rssrtl ? 'rtl' :'ltr'; ?>; text-align: <?php echo $rssrtl ? 'right' :'left'; ?> !important" class="feed<?php echo $moduleclass_sfx; ?>">
		<?php
		// Feed description
		if ($feed->title !== null && $params->get('rsstitle', 1))
		{
			?>
					<span class="<?php echo $direction; ?>">
						<a href="<?php echo htmlspecialchars($rssurl, ENT_COMPAT, 'UTF-8'); ?>" target="_blank">
						<?php echo $feed->title; ?></a>
					</span>
			<?php
		}
		// Feed date
		if ($params->get('rssdate', 1)) : ?>
			
			<?php echo JHtml::_('date', $feed->publishedDate, JText::_('DATE_FORMAT_LC3')); ?>
			
		<?php endif;
		// Feed description
		if ($params->get('rssdesc', 1))
		{
		?>
			<?php echo $feed->description; ?>
			<?php
		}
		// Feed image
		if ($iUrl && $params->get('rssimage', 1)) :
		?>
			<img src="<?php echo $iUrl; ?>" alt="<?php echo @$iTitle; ?>"/>
		<?php endif; ?>


	<!-- Show items -->
	<?php if (!empty($feed))
	{ ?>
		
		<?php for ($i = 0, $max = min(count($feed), $params->get('rssitems', 3)); $i < $max; $i++) { ?>
			<?php
				$uri  = $feed[$i]->uri || !$feed[$i]->isPermaLink ? trim($feed[$i]->uri) : trim($feed[$i]->guid);
				$uri  = !$uri || stripos($uri, 'http') !== 0 ? $rssurl : $uri;
				$text = $feed[$i]->content !== '' ? trim($feed[$i]->content) : '';
			?>
				
					<?php if (!empty($uri)) : ?>
						<span class="feed-link">
						<a href="<?php echo htmlspecialchars($uri, ENT_COMPAT, 'UTF-8'); ?>" target="_blank">
                            <?php echo trim($feed[$i]->title); ?></a></span>
					<?php else : ?>
						<span class="feed-link"><?php echo trim($feed[$i]->title); ?></span>
					<?php endif; ?>
					<?php if ($params->get('rssitemdate', 0)) : ?>
            
						<span class="feed-item-date">
							<?php echo JHtml::_('date', $feed[$i]->publishedDate, JText::_('DATE_FORMAT_LC3')); ?>
						</span>
            
					<?php endif; ?>
					<?php if ($params->get('rssitemdesc', 1) && $text !== '') : ?>
            
						<span class="feed-item-description">
						<?php
							// Strip the images.
							$text = JFilterOutput::stripImages($text);
							$text = JHtml::_('string.truncate', $text, $params->get('word_count', 0));
							echo str_replace('&apos;', "'", $text);
						?>
						</span>
            
					<?php endif; ?>
				
		<?php } ?>
		
	<?php } ?>
	</div>
	<?php } ?>

<?php } ?>
</div>
<?php } ?>


<?php if ($outsideSource == "3"): ?>    
<style type="text/css">
.marquee-with-options-<?php echo $moduleID; ?> {direction: <?php echo $params->get('marqueeForceDirection') ?>; overflow: hidden !important; color: <?php echo $params->get('marqueeFontColor') ?>; font-size: <?php echo $params->get('marqueeFontSize') ?>; line-height: <?php echo $params->get('marqueeFontlineheight') ?>; height: <?php echo $params->get('marqueeHeight') ?>; width: <?php echo $params->get('marqueeWidth') ?>; background: <?php echo $params->get('marqueeBackground') ?> !important; border: <?php echo $params->get('marqueeBorder') ?> <?php echo $params->get('marqueeBorderStyle') ?> <?php echo $params->get('marqueeBorderColor') ?>; margin-bottom: <?php echo $params->get('marqueeBottomMargin') ?>;}
</style>    
    <div class="marquee-with-options-<?php echo $moduleID; ?> <?php echo $moduleclass_sfx;?>">
	   <?php foreach ($list as $item) : ?>
            <?php if ($item->link !== '' && $params->get('link_titles')) : ?>
		      <a href="<?php echo $item->link; ?>">
			     <?php echo $item->title; ?>
		      </a>
	   <?php else : ?>
		      <?php if ($hyperlinkMarquee == "0" || $hyperlinkMarquee == "2") { ?><a href="<?php echo $item->link; ?>"><?php } ?>
                <?php if ($params->get('item_title', '1')) : ?><strong><<?php echo $params->get('titlePosition') ?>><span style="font-size: <?php echo $titleSize ?>;"><?php echo $item->title; ?></span></<?php echo $params->get('titlePosition') ?>></strong></a>&nbsp;&nbsp;<?php endif; ?>    
		      <?php if ($hyperlinkMarquee == "1" || $hyperlinkMarquee == "2") { ?><a href="<?php echo $item->link; ?>"><?php } ?>
                <?php if ($params->get('show_introtext', '1')) : ?><?php echo JHtmlString::truncate(strip_tags($item->introtext, $supportingTags), $wordCount); ?><?php endif; ?>&nbsp;&nbsp;<?php echo $feedSpacing;?> 
		      <?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
                <?php echo '<a class="readmore" href="' . $item->link . '">' . $item->linkText . '</a>'; ?><?php endif; ?>
	       <?php endif; ?>
	   <?php endforeach; ?>
    </div>	
<?php endif ; ?>