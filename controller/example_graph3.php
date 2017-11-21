<?php

require_once("phpgraphlib.php");


$amLikes = array("Beach sunrise"=>4, "Night out"=>8, "Homemade cooking"=>34, "Project"=>40, "Passed!" => 56, "Work placement" => 70);
$proLikes = array("Beach sunrise"=>2, "Night out"=>6, "Homemade cooking"=>20, "Project"=>20, "Passed!" => 20, "Work placement" => 35);

$graph=new PHPGraphLib(800,800);
$graph->addData($amLikes, $proLikes);
$graph->setBarColor('blue', 'red');
$graph->setTitle('Number of likes');
$graph->setupYAxis(12, 'blue');
$graph->setupXAxis(20);
$graph->setGrid(false);
$graph->setLegend(true);
$graph->setTitleLocation('left');
$graph->setTitleColor('blue');
$graph->setLegendOutlineColor('white');
$graph->setLegendTitle('Am likes', 'Pro likes');
$graph->setXValuesHorizontal(true);

$graph->createGraph();