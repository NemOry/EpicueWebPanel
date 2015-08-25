<?php

require_once("../../includes/initialize.php");

global $session;

if(!$session->is_logged_in())
{
    redirect_to("../../index.php");
}

$page = $_GET['page'];
$limit = $_GET['rows'];
$sidx = $_GET['sidx'];
$sord = $_GET['sord'];

$object = Review::get_by_id($session->userid);

$objects_count = Review::get_by_sql("SELECT * FROM ".T_REVIEWS);

$count = count($objects_count);

if( $count > 0 && $limit > 0) 
{ 
	$total_pages = ceil($count / $limit); 
} 
else 
{ 
	$total_pages = 0; 
} 
 
if ($page > $total_pages) $page = $total_pages;
 
$start = $limit * $page - $limit;
 
if($start <0) $start = 0; 
if(!$sidx) $sidx = 1;

$ops = array(
        'eq'=>'=', 
        'ne'=>'<>',
        'lt'=>'<', 
        'le'=>'<=',
        'gt'=>'>', 
        'ge'=>'>=',
        'bw'=>'LIKE',
        'bn'=>'NOT LIKE',
        'in'=>'LIKE', 
        'ni'=>'NOT LIKE', 
        'ew'=>'LIKE', 
        'en'=>'NOT LIKE', 
        'cn'=>'LIKE', 
        'nc'=>'NOT LIKE' 
    );

if(isset($_GET['searchString']) && isset($_GET['searchField']) && isset($_GET['searchOper']))
{
    $searchString = $_GET['searchString'];
    $searchField = $_GET['searchField'];
    $searchOper = $_GET['searchOper'];

    foreach ($ops as $key=>$value)
    {
        if ($searchOper==$key)
        {
            $ops = $value;
        }
    }

    if($searchOper == 'eq' ) $searchString = $searchString;
    if($searchOper == 'bw' || $searchOper == 'bn') $searchString .= '%';
    if($searchOper == 'ew' || $searchOper == 'en' ) $searchString = '%'.$searchString;
    if($searchOper == 'cn' || $searchOper == 'nc' || $searchOper == 'in' || $searchOper == 'ni') $searchString = '%'.$searchString.'%';

    $where = "$searchField $ops '$searchString'"; 

    $objects = Review::get_by_sql("SELECT * FROM ".T_REVIEWS." WHERE ".$where." ORDER BY $sidx $sord LIMIT $start , $limit");
}
else
{
    $objects = Review::get_by_sql("SELECT * FROM ".T_REVIEWS." ORDER BY $sidx $sord LIMIT $start , $limit");
}

header("Content-type: text/xml;charset=utf-8");
 
$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .=  "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";

foreach($objects as $object) 
{
    $s .= "<row id='". $object->id."'>";
    $s .= "<cell></cell>";        
    $s .= "<cell>". $object->id."</cell>";   
    $s .= "<cell>". $object->userid."</cell>";
    $s .= "<cell>". $object->itemid."</cell>";
    $s .= "<cell>". $object->itemtype."</cell>";
    $s .= "<cell>". $object->review."</cell>";
    $s .= "<cell>". $object->rating."</cell>";
    $s .= "<cell>". $object->pending."</cell>";
    $s .= "<cell>". $object->enabled."</cell>";
    $s .= "<cell>". $object->datetime."</cell>";
    $s .= "<cell></cell>";
    $s .= "</row>";
}

$s .= "</rows>"; 
 
echo $s;
?>
