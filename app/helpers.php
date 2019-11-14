<?php
function setActive($nombreURL)
{
	return request()->routeIs($nombreURL) ? 'active' : '';
	// return request()->path() == $nombreURL ? 'active' : '';
}
 ?>