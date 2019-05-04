<?php

	define("ENVIRONMENT", "development");

	if(ENVIRONMENT == "development"){
		define("DB_NAME", "Downrling");
		define("DB_HOST", "127.0.0.1");
		define("DB_USER", "root");
		define("DB_PASS", "");
	}
	else{
		define("DB_NAME", "teste");
		define("DB_HOST", "teste");
		define("DB_USER", "teste");
		define("DB_PASS", "teste");
	}