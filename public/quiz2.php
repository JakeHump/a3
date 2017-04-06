<?php
$states = [
'MA' => 'Boston',
'NY' => 'Albany',
'PA' => 'Philly',
];

$satesNew =[];
foreach($states as $state => $capital) {
$statesNew[$capital] = $state;
}
var_dump($statesNew);
?>
