<form action="" method="post">

<table cellpadding="2" cellspacing="2" border="0" width="100%">
<tr>
	<th>Objective</th>
</tr>

<tr>
  <td><input type="text" name="objective" value="<?=@$_POST['objective']?>" /></td>
</tr>
<tr>
  <th>Criteria</th>
</tr>
<tr>
  <td><input type="text" name="criteria[]" value="<?=@$_POST['criteria'][0]?>" />
    &nbsp;
    <input type="text" name="criteria[]" value="<?=@$_POST['criteria'][1]?>" />
    &nbsp;
    <input type="text" name="criteria[]" value="<?=@$_POST['criteria'][2]?>" />
    &nbsp;
    <input type="text" name="criteria[]" value="<?=@$_POST['criteria'][3]?>" />
    &nbsp;
    <input type="text" name="criteria[]" value="<?=@$_POST['criteria'][4]?>" />
    &nbsp;
    <input type="text" name="criteria[]" value="<?=@$_POST['criteria'][5]?>" /></td>
</tr>
<tr>
  <th>Sub Criteria</th>
</tr>
<tr>
  <td><input type="text" name="sub_criteria[resources][]" value="<?=@$_POST['sub_criteria']['resources'][0]?>" />
    &nbsp;
    <input type="text" name="sub_criteria[resources][]" value="<?=@$_POST['sub_criteria']['resources'][1]?>" />
    <input type="text" name="sub_criteria[resources][]" value="<?=@$_POST['sub_criteria']['resources'][2]?>" />
    &nbsp;
    <input type="text" name="sub_criteria[resources][]" value="<?=@$_POST['sub_criteria']['resources'][3]?>" />
    &nbsp;
    <input type="text" name="sub_criteria[resources][]" value="<?=@$_POST['sub_criteria']['resources'][4]?>" />
    &nbsp;
    <input type="text" name="sub_criteria[resources][]" value="<?=@$_POST['sub_criteria']['resources'][5]?>" /></td>
</tr>
<tr>
  <th>Alternative</th>
</tr>
<tr>
  <td><input type="text" name="alternative[]" value="<?=@$_POST['alternative'][0]?>" />
    &nbsp;
    <input type="text" name="alternative[]" value="<?=@$_POST['alternative'][1]?>" />
    &nbsp;
    <input type="text" name="alternative[]" value="<?=@$_POST['alternative'][2]?>" />
    &nbsp;
    <input type="text" name="alternative[]" value="<?=@$_POST['alternative'][3]?>" />
    &nbsp;
    <input type="text" name="alternative[]" value="<?=@$_POST['alternative'][4]?>" />
    &nbsp;
    <input type="text" name="alternative[]" value="<?=@$_POST['alternative'][5]?>" /></td>
</tr>
<tr>
	<td><input type="submit" name="submit" value="Submit" /></td>
</tr>

</table>

</form>

<?php	 	

echo "<pre>";
print_r( $_POST );
echo "</pre>";

?>