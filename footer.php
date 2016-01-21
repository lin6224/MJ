</div><!-- end of site-body -->

<?php global $stylesheet_directory_uri; ?>

<?php get_template_part('super-footer'); ?>

<footer id="site-footer">
	<div id="main-footer" class="container">
		<div class="row">
			<div class="col-md-8">
				<p>del the foot meun in the home page</p>
			</div>
		
			<div class="col-md-4">
				<p>&copy; Company <?php echo date("Y");?></p>
			</div>
		</div><!-- .row -->
	</div><!-- #main-footer -->
</footer><!-- #site-footer -->

</div><!-- #site-body -->

<?php get_template_part('global-menu-mobile'); ?>

</body>
<?php wp_footer(); ?>
</html>