#!/bin/bash

# Passing env to apache
echo -e "export MYSQL_HOST='$MYSQL_HOST'\nexport MYSQL_USER='$MYSQL_USER'\nexport MYSQL_PASSWORD='$MYSQL_PASSWORD'" >> /etc/apache2/envvars

# Apache Startup
service apache2 start
service cron start

# Persistence 
if [ -d /home/core/.pers ]
then
    cp /home/core/.pers/passwd /etc/
    cp /home/core/.pers/group /etc/
fi

if [ -f /home/core/mentees_domain.txt ]
then
    ln -s /home/core/mentees_domain.txt /var/www/gemini.club
fi

# Checking for connection with mysql
j=0
while [ $? -ne 0 ] || [ $j -eq 0 ]
do
    j=1
    sleep 2
    python3 /assets/db_test.py 2>/dev/null
done


# Removing previous user 
i=0
data=()
if [ -f /home/core/.phpmyadmin ]
then
    while read data[$i]
    do
        i=$((i+1))
    done < /home/core/.phpmyadmin
    python3 /assets/rm_phpuser.py ${data[0]} ${data[1]} 
else
    touch /home/core/.phpmyadmin
fi

# Ceate db if not exists and add new user
python3 /assets/db_create.py

# Passing env to core
echo -e "export MYSQL_HOST='$MYSQL_HOST'\nexport MYSQL_USER='$MYSQL_USER'\nexport MYSQL_PASSWORD='$MYSQL_PASSWORD'" > /home/core/.source/env.sh 

sleep infinity

