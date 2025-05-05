<?php
session_start();
require_once '../src/Session.php';

$session = new Session();
$session->forgetSession();
