<?php
require('User.class.php');

$u = new User('joppe', 'joppe@example.com', 'avatar1.jpg');
$twee = new User('vincent', 'vincent@example.com', 'avatar2.jpg');
$drie = new User('mattias', 'mattias@example.com', 'avatar3.jpg');

// $u->setUsername('matti');
// $twee->setUsername('mike');
// $drie->setUsername('joe');
// print $u->getUsername();

print '<pre>';
print_r($u);
print_r($twee);
print_r($drie);
print '</pre>';
