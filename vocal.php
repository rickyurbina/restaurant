<?php
$lastname = 'Melendez';
preg_match('/[aeiou]/i', $lastname, $vowels);
echo $vowels[0];
?>
