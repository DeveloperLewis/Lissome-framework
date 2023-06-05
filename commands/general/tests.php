<?php
//Run phpunit tests
putenv("TERM=xterm");
passthru(universalDir("./vendor/bin/phpunit --testdox"));