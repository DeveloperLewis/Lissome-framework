<?php
putenv("TERM=xterm");
passthru(universalDir("./vendor/bin/phpunit --testdox"));