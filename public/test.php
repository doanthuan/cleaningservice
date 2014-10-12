<?php
preg_match('~<br />(.)+<br />~', '<br />Vladimir<br />Nenov<br />Address: 123 street', $matches, PREG_OFFSET_CAPTURE);
print_r($matches[0][0]);exit;