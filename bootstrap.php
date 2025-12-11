<?php
define("__DIR_ROOT__", __DIR__); 
require_once('./configs/path.php');  // config resource path; 
require_once("./configs/routes.php");// configs routes; 
require_once("./configs/database.php");  // config database; 
require_once('./core/Database.php');  // Database class;
require_once('./core/Connection.php');
require_once("./core/Route.php");  // load Route class; 
require_once("./app/app.php"); // load app; 
require_once('./configs/helper.php'); 
require_once('./core/Controller.php');  // load Controller; 
require_once('./core/Model.php');
