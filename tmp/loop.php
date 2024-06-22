<?php

function dbConnect()
{

}

function dropTable()
{

}

function createTable()
{

}


$variable = array(
	['PHP', '.php'],
	['JavaScript', '.js'],
	['Python', '.py']
);
foreach ($variable as $key => $value) {
	echo '<p>'.$key.':'.$value[0].' '.$value[1].' '.$value[2].'</p>';
}
/*$currencies = [
   'japan'=> 'yen',
   'us' => 'doller',
   'england' => 'pound',

];

foreach ($currencies as $country => $currency) {
    echo $country . ':' . $currency . PHP_EOL;
}/*
