<?php
global $NUM_ROWS;
$NUM_ROWS = 25;

define("QS_VAR", "page"); 
define("NUM_ROWS", 10); 
define("STR_FWD", "&gt;&gt;"); 
define("STR_BWD", "&lt;&lt;"); 
define("NUM_LINKS", 5); // the number of links inside the navigation (the default value)

	function set_page($get_var) {
		$page = (isset($_REQUEST[$get_var]) && $_REQUEST[$get_var] != "") ? $_REQUEST[$get_var] : 0;
		return $page;
	}

	// returns the records for the current page
	function get_page_result($get_var, $rows_on_page, $sql) {
		$start = set_page($get_var) * $rows_on_page;
		$page_sql = sprintf("%s  LIMIT %s, %s", $sql, $start, $rows_on_page);
		$result = mysql_query($page_sql);
		return $result;
	}
	
	// get the number of rows on the current page
	function get_page_num_rows($result) {
		$num_rows = mysql_num_rows($result);
		return $num_rows;
	}
		
	// get the totale number of result pages
	function get_num_pages($sql) {
		global $NUM_ROWS;
		//$this->number_pages = ceil(get_total_rows($sql) / $this->rows_on_page);
		$gettotal_rows = get_total_rows($sql);
		$number_pages = ceil($gettotal_rows / $NUM_ROWS);
		return $number_pages;
	}
	// gets the total number of records 
	function get_total_rows($sql) {
		$tmp_result = mysql_query($sql);
		$all_rows = mysql_num_rows($tmp_result);
		mysql_free_result($tmp_result);
		return $all_rows;
	}
	
	// this method will return the navigation links for the conplete recordset
	function navigation($sql, $get_var, $separator = " | ", $css_current = "", $back_forward = false) {
		$max_links = NUM_LINKS;
		$curr_pages = set_page($get_var); 
		$all_pages = get_num_pages($sql) - 1;
		$var = $get_var;
		$navi_string = "";
		if (!$back_forward) {
			$max_links = ($max_links < 2) ? 2 : $max_links;
		}
		if ($curr_pages <= $all_pages && $curr_pages >= 0) {
			if ($curr_pages > ceil($max_links/2)) {
				$start = ($curr_pages - ceil($max_links/2) > 0) ? $curr_pages - ceil($max_links/2) : 1;
				$end = $curr_pages + ceil($max_links/2);
				if ($end >= $all_pages) {
					$end = $all_pages + 1;
					$start = ($all_pages - ($max_links - 1) > 0) ? $all_pages  - ($max_links - 1) : 1;
				}
			} else {
				$start = 0;
				$end = ($all_pages >= $max_links) ? $max_links : $all_pages + 1;
			}
			if($all_pages >= 1) {
				$forward = $curr_pages + 1;
				$backward = $curr_pages - 1;
				$backward0=0;
				//$navi_string = ($curr_pages > 0) ? "<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$backward.rebuild_qs($var)."\">".STR_BWD."</a>&nbsp;" : STR_BWD."&nbsp;";
				$navi_string = ($curr_pages > 0) ? "<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$backward0.rebuild_qs($var)."\">&laquo; First</a><a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$backward.rebuild_qs($var)."\">&laquo; prev</a>&nbsp;" : "<span class=\"disabled\">&laquo; First</span>&nbsp;<span class=\"disabled\">&laquo; prev</span>&nbsp;";
				
				if (!$back_forward) {
					for($a = $start + 1; $a <= $end; $a++){
						$theNext = $a - 1; // because a array start with 0
						if ($theNext != $curr_pages) {
							$navi_string .= "<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$theNext.rebuild_qs($var)."\">";
							$navi_string .= $a."</a>";
							$navi_string .= ($theNext < ($end - 1)) ? $separator : "";
						} else {
							$navi_string .= ($css_current != "") ? "<span class=\"".$css_current."\">".$a."</span>" : $a;
							$navi_string .= ($theNext < ($end - 1)) ? $separator : "";
						}
					}
				}
				$navi_string .= ($curr_pages < $all_pages) ? "&nbsp;<a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$forward.rebuild_qs($var)."\">next &raquo;</a><a href=\"".$_SERVER['PHP_SELF']."?".$var."=".$all_pages.rebuild_qs($var)."\">Last &raquo;</a>" : "<span class=\"disabled\">next &raquo;</span><span class=\"disabled\">Last &raquo;</span>";
			}
		}
		return $navi_string;
	}
	
	
	function rebuild_qs($curr_var) {
		if (!empty($_SERVER['QUERY_STRING'])) {
			$parts = explode("&", $_SERVER['QUERY_STRING']);
			$newParts = array();
			foreach ($parts as $val) {
				if (stristr($val, $curr_var) == false)  {
					array_push($newParts, $val);
				}
			}
			if (count($newParts) != 0) {
				$qs = "&".implode("&", $newParts);
			} else {
				return false;
			}
			return $qs; // this is your new created query string
		} else {
			return false;
		}
	} 
	
	// this info will tell the visitor which number of records are shown on the current page
	function page_info($to = "-", $get_var, $sql) {
		global $NUM_ROWS;
		$first_rec_no = (set_page($get_var) * $NUM_ROWS) + 1;
		$last_rec_no = $first_rec_no + $NUM_ROWS - 1;
		$total_rows = get_total_rows($sql);
		$last_rec_no = ($last_rec_no > $total_rows) ? $total_rows : $last_rec_no;
		$to = trim($to);		
		if($last_rec_no==0)	{ $first_rec_no=0;}		
		$info = $first_rec_no." ".$to." ".$last_rec_no;
		return $info;
	}

?>