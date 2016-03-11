<?php
require_once('classes/Rest.class.php');
require_once('classes/Token.class.php');
require_once('classes/Datasource.class.php');
require_once('classes/Term.class.php');
require_once('classes/Course.class.php');
require_once('classes/User.class.php');
require_once('classes/Membership.class.php');

$rest = new Rest();
$token = new Token();
$datasource = new Datasource();
$term = new Term();
$course = new Course();
$user = new User();
$membership = new Membership();

$token = $rest->authorize();
var_dump($token);

$access_token = $token->access_token;


$datasource = $rest->createDatasource($access_token);
var_dump($datasource);

$dsk_id = $datasource->id;

$datasource = $rest->readDatasource($access_token,$dsk_id);
var_dump($datasource);


$datasource = $rest->updateDatasource($access_token,$dsk_id);
var_dump($datasource);









$result = $rest->deleteDatasource($access_token,$dsk_id);
var_dump($result);
