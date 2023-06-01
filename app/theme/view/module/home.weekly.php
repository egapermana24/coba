<div class="app-section app-weekly">
<div class="app-heading">
<div class="text"><?php echo $HomeModule['name'];?></div>
<a href="<?php echo APP.'/discovery';?>" class="all"><?php echo __('Trending');?></a>
</div>	
<?php if($ModuleData['mobile_slider'] == '1') { ?>
		<style>
			@media only screen and (max-width: 981px) {
				.mobile_slide_weekly {
    				overflow-x: auto;
    				flex-wrap: nowrap;
				}
			}
		</style>
	<?php } ?>
	<?php if($ModuleData['desktop_slider'] == '1') { ?>
		<style>
			@media only screen and (min-width: 981px) {
				.mobile_slide_weekly {
    				overflow-x: auto;
    				flex-wrap: nowrap;
				}
			}
		</style>
	<?php } ?>
<div class="row row-cols-5 mobile_slide_weekly mobile_slide">
<?php  
if(!$ModuleData['sorting']) {
$OrderBy = 'id DESC';
}else{
$OrderBy = $ModuleData['sorting'];
}
$Newests = $this->db->from(null,'
SELECT
posts.id,
posts.title,
posts.title_sub,
posts.self,
posts.type,
posts.hit_weekly,
posts.image,
posts.create_year,
posts.quality,
posts.imdb,
posts.type,
posts.create_year,
posts.anime,
posts.data,
posts.mpaa,
posts.description,
posts.created,
categories.name
FROM `posts`
LEFT JOIN posts_category ON posts_category.content_id = posts.id
LEFT JOIN categories ON categories.id = posts_category.category_id
GROUP BY posts.id
ORDER BY posts.hit_weekly DESC
LIMIT 0,'.$HomeModule['data_limit'])
->all();
$count = 1;
foreach ($Newests as $Newest) {
?>
<div class="col">
<div class="list-movie">
<a href="<?php if($Newest['type'] == 'serie') { echo APP. '/show/'; } else { echo '/movie/'; } echo $Newest['self'] . '-' . $Newest['create_year'];?>" class="list-media">
<?php if($Newest['quality'] || $Newest['imdb']) { ?>
<div class="list-media-attr">
<?php if($Newest['quality']) { ?><div class="quality"><?php echo $Newest['quality'];?></div><?php } ?>
<?php if($Newest['imdb']) { ?>
<div class="imdb">
<span>
<?php echo round($Newest['imdb'],1);?></span>
<svg x="0px" y="0px" width="36px" height="36px" viewBox="0 0 36 36"><circle fill="none" stroke-width="1" cx="18" cy="18" r="16" stroke-dasharray="<?php echo round($Newest['imdb'] / 10 * 100);?> 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"></circle></svg>
</div>
<?php } ?>
</div>
<?php } ?>
<div class="play-btn"><svg class="icon"><use xlink:href="<?php echo ASSETS.'/img/sprite.svg#play';?>" /></svg></div>
<div class="media media-cover" style="background-image:url('<?php echo $Newest['image'];?>');">
<?php if($Newest['mpaa']) { ?><div class="media-cover mpaa"><?php echo $Newest['mpaa'];?></div><?php } ?>
</div>
</a>
<div class="list-caption">
<a href="<?php echo post($Newest['id'],$Newest['self'],$Newest['type']);?>" class="list-title">
<?php echo $Newest['title'];?></a>

<?php if($Newest['create_year']) { ?><div class="list-year" style="display:inline"><?php echo $Newest['create_year'];?></div><div class="mpaa float-right" style="display:inline;margin-top: 0px;"><?php echo $Newest['type'];?></div><?php } ?>

</div>
</div>
</div>
<?php } ?>
</div>
</div>
