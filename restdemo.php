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

$term = $rest->createTerm($access_token, $dsk_id);
var_dump($term);

$term_id = $term->id;

$term = $rest->readTerm($access_token, $term_id);
var_dump($term);


$term = $rest->updateTerm($access_token, $dsk_id, $term_id);
var_dump($term);

$course = $rest->createCourse($access_token, $dsk_id, $term_id);
var_dump($course);

$course_id = $course->id;

$course = $rest->readCourse($access_token, $course_id);
var_dump($course);


$course = $rest->updateCourse($access_token, $dsk_id, $course_id, $course->uuid, $course->created);
var_dump($course);

$user = $rest->createUser($access_token, $dsk_id);
var_dump($user);

$user_id = $user->id;

$user = $rest->readUser($access_token, $user_id);
var_dump($user);

$user = $rest->updateUser($access_token, $dsk_id, $user_id, $user->uuid, $user->created);
var_dump($user);

$membership = $rest->createMembership($access_token, $dsk_id, $course_id, $user_id);
var_dump($membership);

$membership = $rest->readMembership($access_token, $course_id, $user_id);
var_dump($membership);

$membership = $rest->updateMembership($access_token, $dsk_id, $course_id, $user_id, $membership->created);
var_dump($membership);

$result = $rest->deleteMembership($access_token, $course_id, $user_id);
var_dump($result);

$result = $rest->deleteUser($access_token, $user_id);
var_dump($result);

$result = $rest->deleteCourse($access_token, $course_id);
var_dump($result);

$result = $rest->deleteTerm($access_token, $term_id);
var_dump($result);

$result = $rest->deleteDatasource($access_token,$dsk_id);
var_dump($result);