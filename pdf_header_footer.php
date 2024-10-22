<?php	 	

$keyStyle = 'style="padding:5px; background:#eaeaea; width:80px;"';
$valueStyle = 'style="padding:5px; width:120px;"';

?>
<page_header>
		<table class="page_header" style="width:70%;" align="center">
			<tr>
				<td style="text-align: left; border:1px solid #b6b6b6;">
					<table width="90%" border="0" cellspacing="2" cellpadding="2" align="center">
                    <tr>
                      <td align="center" width="20%" style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:14pt; color:#3e4040;" valign="top">
                      <table width="100%">
                      <tr>
                      	<td align="center" style="font-size:22pt; font-weight:bold; text-align:center;">ADM</td>
                      </tr>
                      <tr>
                      	<td align="center"><strong>Decision</strong> <em>Expert</em></td>
                      </tr>
                      </table>
                      
                      
                      </td>
                      <td valign="top">
                      <table width="100%" cellpadding="5" cellspacing="0" border="1" bordercolor="#bdbdbd">
                      <tr>
                      	<td <?=$keyStyle?> align="right">Project Name</td>
                        <td <?=$valueStyle?> align="left"> <?php	 	 echo $projects->project_name; ?></td>
                        <td <?=$keyStyle?> align="right">Project Version</td>
                        <td <?=$valueStyle?> align="left"> <?php	 	 echo $projects->version; ?></td>
                      </tr>
                      <tr>
                      	<td <?=$keyStyle?> align="right">User Name</td>
                        <td <?=$valueStyle?> align="left"> <?php	 	 echo $projects->user_name; ?></td>
                        <td <?=$keyStyle?> align="right">Date</td>
                        <td <?=$valueStyle?> align="left"> <?php	 	 echo $projects->date_created; ?></td>
                      </tr>
                      </table>
                      </td>
                    </tr>
                  </table>
				</td>
			</tr>
		</table>
	</page_header>
<page_footer>
    <table class="page_footer" align="center" width="90%" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="2"><hr style="background:#b6b6b6; color:#b6b6b6; height:1px;" /></td>
      </tr>
        <tr>
            <td align="center" style="width:95%; color:#3e4040;" valign="middle"><em>Decision Expert</em></td>
            <td style="text-align: right; width:20px;">[[page_cu]]</td>
        </tr>
    </table>
</page_footer>