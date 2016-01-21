<?php global $post; ?>
<div id="super-banner-wrapper">
	<div id="super-banner" class="container">
		<h1>
		<?php
		if(is_search()){
			echo 'Search';
		}else if(is_archive()){
			if(is_category()){
				echo 'Category: '.get_category(get_query_var('cat'))->name;
			}else if(is_tag()){
				echo single_tag_title('Tag: ');
			}else{
				//date archive
				echo the_archive_title();
			}
		}else if(is_home()){
			echo 'Blog';
		}else{
			echo $post->post_title;
		}
		?>
		</h1>
	</div>
</div>