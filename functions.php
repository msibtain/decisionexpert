<?php

function sendEmail($to, $subject, $body)
{
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: Decision Expert <no-reply@decisionexpert.co.uk>' . "\r\n";
#$headers .= 'Cc: myboss@example.com' . "\r\n";
mail($to, $subject, $body, $headers);
}
function getGlobalPriorities($project_id)
{
global $db;
$global_priorities = $db->select("projects_matrix", "*", "project_id = " . $project_id . " AND pair_comparison_matrix = 'objective'");
$global_priorities = $global_priorities[0];
$global_priorities = unserialize($global_priorities->priorities);
return $global_priorities;
}
function getMatrixValuesForCriteria($project_id, $key)
{
global $db;
# Sub criteria is there, so get priority matrix (LOCAL PRIORITIES) of its sub category,
$projects_matrix = $db->select("projects_matrix", "*", "project_id = " . $project_id . " AND pair_comparison_matrix = 'criteria_" . $key . "'");
$projects_matrix = $projects_matrix[0];
$matrix_values = unserialize($projects_matrix->priorities);
return $matrix_values;
}
function get_Consistency_For_Pair_Comparison_Matrix($project_id, $pair_comparison_matrix)
{
global $db;
# Sub criteria is there, so get priority matrix (LOCAL PRIORITIES) of its sub category,
$consistency = $db->select("projects_matrix", "consistency", "project_id = " . $project_id . " AND pair_comparison_matrix = '" . $pair_comparison_matrix . "'");
$consistency = $consistency[0];
return $consistency;
}
function getPriorityMatrixOf($project_id = 0, $pair_comparison_matrix)
{
if (!$project_id) $project_id = @$_SESSION['project_id'];
global $db;
$n = $db->select("projects_matrix", "priorities", "project_id = " . $project_id . " AND pair_comparison_matrix = '".$pair_comparison_matrix."'");
$n = $n[0];
$nPriorities = unserialize($n->priorities);
return $nPriorities;
}
function writeSectionHeading($objPHPExcel, $section_heading, $row = 1)
{
$objPHPExcel->getActiveSheet()->mergeCells('B'.$row.':G'.$row);
$objRichText = new PHPExcel_RichText();
$objPayable = $objRichText->createTextRun($section_heading);
$objPayable->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getCell('B'.$row)->setValue($objRichText);
}
function p_r( $s )
{
echo "<pre>";
print_r( $s );
echo "</pre>";
}

function is_bot($gcaptcha_token)
{
    $secretKey = GOOGLE_SECRET_KEY;
    $ip = $_SERVER['REMOTE_ADDR'];

    // post request to server
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array('secret' => $secretKey, 'response' => $gcaptcha_token);    
    
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $responseKeys = json_decode($response,true);
    
    return (!$responseKeys['success']);
}


function redirect($url){
if (!headers_sent()){
header('Location: '.$url); exit;
}else{
echo '<script type="text/javascript">';
echo 'window.location.href="'.$url.'";';
echo '</script>';
echo '<noscript>';
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
echo '</noscript>';
exit;
}
}
?>