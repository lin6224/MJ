<?php
/**
 * google analytics and webmaster
 * Author: JR
 * Modified: JF
 * Date: May 29, 2014
 */
//add_action ('wp_head', 'custom_set_google_analytics');
function custom_set_google_analytics(){
	// set analytics values here
	$analytics_id  = '';
	$analytics_uri = '';
	$webmaster_id = '';
	//get analytics code
	$analytics = <<<ANA
<meta name="google-site-verification" content="$webmaster_id" />
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '$analytics_id', '$analytics_uri');
  ga('send', 'pageview');
</script>
ANA;
	echo $analytics;
}
?>