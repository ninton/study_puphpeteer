#!/bin/bash -ux

./vendor/bin/phpunit \
  --configuration=phpunit.xml \
  $1
