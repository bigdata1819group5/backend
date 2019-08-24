#!/usr/bin/env bash
echo "Project by Aryan Sadeghi :) "
cd /code/
composer update
echo "Running web server on port 9050"
/usr/bin/php -S 0.0.0.0:9050 -t /code/root