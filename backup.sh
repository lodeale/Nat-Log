#!/bin/bash

while : 
do
	sleep 5
	rm access.log
	tail -100 /var/log/apache2/access.log >> access.log
done

