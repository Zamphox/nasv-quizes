#!/bin/bash
echo "### Docker Status ###"
./vendor/bin/sail ps
echo "\n### Recent Logs ###"
./vendor/bin/sail logs --tail=20 laravel.test
echo "\n### Disk Usage ###"
df -h
