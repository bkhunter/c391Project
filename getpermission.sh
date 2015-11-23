#!/bin/bash

chmod 644 *.php
chmod 644 *.css
chmod -R 777 sensor_and_user_mgmt
cd sensor_and_user_mgmt
chmod 644 *.php
chmod 644 *.css
cd ..
chmod -R 777 dc
cd dc
chmod 644 *.php
chmod 644 *.css
cd ..
chmod -R 777 Data_Analysis
cd Data_Analysis
chmod 644 *.php
chmod 644 *.css
cd ..

