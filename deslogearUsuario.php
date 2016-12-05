<?php

	if (isset($_COOKIE['nombre'])) 
		{
				setcookie('nombre', '', time()-10000);
		}





?>