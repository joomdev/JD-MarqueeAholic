<?php
/*-------------------------------------------------------------------------------
# JD MarqueeAholic - Marquee module for Joomla 3.x v1.5.0
# -------------------------------------------------------------------------------
# author    JoomDev (Formerly GraphicAholic)
# copyright Copyright (C) 2020 Joomdev, Inc. All rights reserved.
# @license - GNU General Public License version 2 or later
# Websites: https://www.joomdev.com
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
<?php if ($outsideSource == "2"): ?>    
	<div class="marquee-with-options-<?php echo $moduleID; ?> <?php echo $moduleclass_sfx;?>">
		<?php {
			$rss = new DOMDocument();
			$rss->load(''.$externalURL.'');
			$feed = array();
		foreach ($rss->getElementsByTagName('item') as $node)
		{
			$item = array (
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
				'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
				'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
	array_push($feed, $item);
		}
	$descCount = $wordCount;
	$limit = (count($feed) > $feedCount)? $feedCount : count($feed);
	for($x=0;$x<$limit;$x++)
		{
			$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
			$link = $feed[$x]['link'];
			$description = substr($feed[$x]['desc'], 0, $descCount );
			$date = date('l F d, Y', strtotime($feed[$x]['date']));
if ($rssDisplay == "3") {
	echo '<strong>&#187;<a href="'.$link.'" target="_'.$linkWindow.'" title="'.$title.'">'.$title.'</a></strong>&nbsp;'.$oneSpacing.'<span style="font-size: x-small;opacity: 0.5;">[<em>Posted on '.$date.'</em>]</span>&nbsp;'.$oneSpacing.''.$description.'&nbsp;&nbsp;'.$feedSpacing.'';
		}
elseif ($rssDisplay == "2") {
	echo '<strong>&#187;<a href="'.$link.'" target="_'.$linkWindow.'" title="'.$title.'">'.$title.'</a></strong>&nbsp;'.$oneSpacing.'|&nbsp;'.$description.'&nbsp;&nbsp;'.$feedSpacing.'';
		}
elseif ($rssDisplay == "1") {
	echo '<strong>&#187;<a href="'.$link.'" target="_'.$linkWindow.'" title="'.$title.'">'.$title.'</a></strong>&nbsp;'.$oneSpacing.'<span style="font-size: x-small;opacity: 0.5;">[<em>Posted on '.$date.'</em>]</span>&nbsp;&nbsp;'.$feedSpacing.'';
		}
elseif ($rssDisplay == "0") {
	echo '<strong>&#187;<a href="'.$link.'" target="_'.$linkWindow.'" title="'.$title.'">'.$title.'</a></strong>&nbsp;&nbsp;'.$feedSpacing.'';
		}
	}
}
?>
</div>
<?php endif ; ?>
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