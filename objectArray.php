<?php
$ao = new ArrayObject();
$ao ->setFlags(ArrayObject::STD_PROP_LIST|ArrayObject::ARRAY_AS_PROPS);

$ao->prop = 'prop data';
$ao['arr'] = 'array data';

print_r($ao);

?>
