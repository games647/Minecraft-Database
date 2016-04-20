#!/bin/bash

# Our hoster only allows hourly cronjobs
# Because of Laravel will also run task between these intervals like queued tasks
# We workaround this by running this script every hour which will trigger the artisan schedule
# every minute

for i in {1..60}
do
  now=$(date +%T)
  echo "Tick: $now"
  /usr/local/php7.0/bin/php artisan schedule:run >> /dev/null 2>&1
  sleep 50
done
