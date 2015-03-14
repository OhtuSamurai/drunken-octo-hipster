#!/bin/bash
#author kumikumi
command -v phantomjs >/dev/null 2>&1 || { echo "Asennetaan phantomjs. Hetki"; sudo apt-get update >/dev/null && sudo apt-get install --yes phantomjs; }
trap 'killall phantomjs' 2
phantomjs --webdriver=4444 & 
if [ "$1" = "--acceptance" ]
then
echo ajetaan vain acceptance testit
vendor/bin/codecept run acceptance --coverage --coverage-xml --coverage-html
elif [ "$1" = "--unit" ]
then
echo ajetaan vain unit testit
vendor/bin/codecept run unit --coverage --coverage-xml --coverage-html
else
echo ajetaan kaikki testit
vendor/bin/codecept run --coverage --coverage-xml --coverage-html
fi
killall phantomjs
