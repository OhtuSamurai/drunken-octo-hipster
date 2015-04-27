#!/bin/bash
#author kumikumi
command -v phantomjs >/dev/null 2>&1 || { echo "Asennetaan phantomjs. Hetki"; sudo apt-get update >/dev/null && sudo apt-get install --yes phantomjs; }
vendor/bin/codecept build
trap 'killall phantomjs' 2
phantomjs --webdriver=4444 & 
if [ "$1" = "--acceptance" ]
then
echo ajetaan vain acceptance testit
vendor/bin/codecept run acceptance
elif [ "$1" = "--unit" ]
then
echo ajetaan vain unit testit
vendor/bin/codecept run unit
elif [ "$1" = "--functional" ]
then
echo ajetaan vain functional testit
vendor/bin/codecept run functional
elif [ "$1" = "--coverage" ]
then
echo ajetaan kaikki testit ja generoidaan kattavuusraportti
vendor/bin/codecept run --coverage --coverage-xml --coverage-html
else
echo ajetaan kaikki testit
vendor/bin/codecept run
fi
killall phantomjs
