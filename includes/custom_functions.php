<?php
function dd($data=array())
{
	echo '<pre>';
		print_r($data);
	echo '</pre>';
}
function dd_dump($data)
{
	echo '<pre>';
		var_dump($data);
	echo '</pre>';
}