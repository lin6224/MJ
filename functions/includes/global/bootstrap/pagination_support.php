<?php
function get_bootstrap_pagination($page, $page_count, $before_pagination='', $after_pagination=''){
	$pagination_output = '';//page html output
	if($page_count > 1){
	//get previous page
		$previous_page = ($page == 1)?$page_count:($page-1);
		//get next page
		$next_page = ($page == $page_count)?1:($page+1);
		
		$pagination_output .= $before_pagination.'<nav>
  <ul class="pagination">
    <li>
      <a href="#" aria-label="Previous" class="site-pagination-num" site-pagination-num="'.$previous_page.'">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>';
		//check page_to_show to determine if we need to hide middle pagination
		
		$page_dot_pre = '';
		$page_dot_post = '';
		//produce pagination items
		for($i=1;$i<=$page_count;$i+=1){
			//determine presentation by number or dot
			//use dot to skip page number items if it can be skipped
			if($page_count > 7){
				if(($i < $page-1 && $i > 1) || ($i > $page+1 && $i < $page_count)){
					if(($i < $page-1 && $i > 1) && $page_dot_pre == ''){
						$page_dot_pre = '<li><a href="#" class="site-pagination-num" site-pagination-num="0">...</a></li>';
						$pagination_output .= $page_dot_pre;
					}
					if(($i > $page+1 && $i < $page_count) && $page_dot_post == ''){
						$page_dot_post = '<li><a href="#" class="site-pagination-num" site-pagination-num="0">...</a></li>';
						$pagination_output .= $page_dot_post;
					}
				}else{
					if($i == $page){
						$pagination_output .= '<li class="active"><a href="#" class="site-pagination-num" site-pagination-num="0">'.$i.' <span class="sr-only">(current)</span></a></li>';
					}else{
						$pagination_output .= '<li><a href="#" class="site-pagination-num" site-pagination-num="'.$i.'">'.$i.'</a></li>';
					}
				}
			}else{
				//show everything
				if($i == $page){
					$pagination_output .= '<li class="active"><a href="#" class="site-pagination-num" site-pagination-num="0">'.$i.' <span class="sr-only">(current)</span></a></li>';
				}else{
					$pagination_output .= '<li><a href="#" class="site-pagination-num" site-pagination-num="'.$i.'">'.$i.'</a></li>';
				}
			}
		}
		$pagination_output .= '<li>
      <a href="#" aria-label="Next" class="site-pagination-num" site-pagination-num="'.$next_page.'">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>'.$after_pagination;
	}
	return $pagination_output;
}
?>