<?php	 	 
include('header.php'); 

global $db;
$projects = $db->select("projects", "*", "id = " . $_GET['id']);
$projects = $projects[0];
$projects_ahp = $db->select("projects_ahp", "*", "project_id = " . $_GET['id']);
$projects_ahp = $projects_ahp[0];



$criterias = unserialize($projects_ahp->criterias);
$sub_criterias  = unserialize($projects_ahp->sub_criterias );
$alternatives = unserialize($projects_ahp->alternatives);
//$matrix_values = unserialize($projects_matrix->matrix_values);


?>

<!--left-->
<?php	 	 include('left.php'); ?>  

<script language="javascript">
var criteria_result = Array();
var alternative_result = Array();
var cri_sub_result = Array();
</script>              
<!--center-->
<div id="container" class="equal">
	<?php	 	 if (!$_SESSION['user']) { ?>
	<div class="row-banner clear">
    	<div class="moduletable">
			<p><img src="includes/shop-ad-books.jpg" border="0"></p>		
        </div>
	</div>
    <?php	 	 } else { include('user_menu.php'); } ?>
    
	<div class="clear">
	
    <?php	 	 include('charts_html.php'); ?>
    
    <script language="javascript">
	function printAlternative()
	{
		
                
		for(var i in alternative_result)
		{
			var ar = 0;
			for(var c in criteria_result)
			{
				//first_number = criteria_result[c];
				first_number = parseFloat(jQuery('#span_'+c).html());
				second_number = cri_sub_result[i+'_'+c];
				ar += parseFloat(first_number) * parseFloat(second_number);
			}
			
                        
			jQuery('#alt_span_'+i).html(roundNumber(ar, 3));
			jQuery('#alt_bar_'+i).css('width',roundNumber(ar, 3)+'%');
		}
	}
	
	function roundNumber(num, dec) 
	{
		var result = num.toFixed(dec);
		//var result = (num*Math.pow(10,dec))/Math.pow(10,dec);
		return result;
	}
	
	function resetCriteria()
	{
		for(var i in criteria_result)
		{
			var input_obj = '#span_'+i;
			var bar_obj = '#bar_'+i;
			jQuery(input_obj).html(roundNumber(criteria_result[i], 3));
			jQuery(bar_obj).css('width',roundNumber(criteria_result[i], 3)+'%');
		}
		
		for(var i in alternative_result)
		{
			var input_obj = '#alt_span_'+i;
			var bar_obj = '#alt_bar_'+i;
			jQuery(input_obj).html(roundNumber(alternative_result[i], 3));
			jQuery(bar_obj).css('width',roundNumber(alternative_result[i], 3)+'%');
		}
	}
	
	function IncreaseCriteria(index)
	{
		var input_obj = '#span_'+index;
		var bar_obj = '#bar_'+index;
		var current_value = parseFloat(jQuery(input_obj).html());
		if (current_value < 100)
		{
			current_value += 2;
			if (current_value > 100) return;
			
			jQuery(input_obj).html(roundNumber(current_value,3));
			
			//jQuery(bar_obj).css('width', current_value+'%');
			jQuery(bar_obj).animate({
				width: current_value+'%'
				},
				200,
				function(){
					for(var i in criteria_result)
					{
						if (i != index)
						{
							var input_obj = '#span_'+i;
							var bar_obj = '#bar_'+i;
							var current_value = parseFloat(jQuery(input_obj).html());
							var new_value = (100/102)*current_value;
							jQuery(input_obj).html(roundNumber(new_value, 3));
							jQuery(bar_obj).css('width',new_value+'%');
						}
					}
				});
		}
		//alert(index);
		printAlternative();
	}
	
	function DecreaseCriteria(index)
	{
		var input_obj = '#span_'+index;
		var bar_obj = '#bar_'+index;
		var current_value = parseFloat(jQuery(input_obj).html());
		if (current_value > 0)
		{
			current_value -= 2;
			if (current_value < 0) return;
			
			jQuery(input_obj).html(roundNumber(current_value,3));
			
			//jQuery(bar_obj).css('width', current_value+'%');
			jQuery(bar_obj).animate({
				width: current_value+'%'
				},
				200,
				function(){
					for(var i in criteria_result)
					{
						if (i != index)
						{
							var input_obj = '#span_'+i;
							var bar_obj = '#bar_'+i;
							var current_value = parseFloat(jQuery(input_obj).html());
							var new_value = (100/102)*current_value;
							jQuery(input_obj).html(roundNumber(new_value, 3));
							jQuery(bar_obj).css('width',new_value+'%');
						}
					}
				});
		}
		//alert(index);
		printAlternative();
	}
	
	//printAlternative();
	</script>
	</div>
</div>
<?php	 	 include('footer.php'); ?>