#!/bin/bash
#author kumikumi
command -v phantomjs >/dev/null 2>&1 || { echo "Asennetaan phantomjs. Hetki"; sudo apt-get update >/dev/null && sudo apt-get install --yes phantomjs; }
phantomjs --webdriver=4444 & vendor/bin/codecept run
killall phantomjs
