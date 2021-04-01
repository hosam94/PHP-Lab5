<?php
require_once("./db.php");
$DB = new DB('localhost', 'root', '', 'users');

$DB->select('users', 'name', 'email');
echo '<br>';
$DB->insert('users', ['name','email','password','room'],['hosam','hosam@mail.com',md5('123456'),'app1']);
echo '<br>';

$DB->select('users', 'name', 'email');
echo '<br>';

$DB->update('users',1,['name'=>'hosam1','email'=>'hosam@mail.com']);
echo '<br>';

$DB->select('users', 'name', 'email');

$DB->delete('users',1);
echo '<br>';

$DB->select('users', 'name', 'email');
echo '<br>';
$DB->deleteDataFromTable('users');

$DB->select('users', 'name', 'email');