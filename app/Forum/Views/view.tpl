<div width="100%">
	<?php foreach($Posts as $number => $post) {?>
		<div class="post" id="<?php if($number++ % 2 == 0) echo "left"; else echo "right"; ?>">
			<div class="avatar">
				<img src="public/images/<?php echo $post->user;?>.gif"/>
			</div>
				<div class="info">
					<a href="user/<?php echo $post->user;?>"><?php echo $post->user;?></a> 325 posts
				</div>
			<div class="text">
				<?php echo $post->content;?>
			</div>
		</div>
	<?php } ?>
</div>