#!/bin/bash
cd /Users/chengxiaoli/Documents/wcworkspace/miniHabit
pm2 restart pm2_local.json
phpunit /Users/chengxiaoli/Documents/wcworkspace/miniHabit/tests
