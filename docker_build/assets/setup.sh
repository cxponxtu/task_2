#!/bin/bash

# Creating user core
sudo useradd -md /home/core core -g sudo -s /bin/bash
echo core:core | sudo chpasswd

# Copying files
sudo cp -r /assets/source /home/core/
sudo mv /home/core/source /home/core/.source 
sudo cp /assets/mentorDetails.txt /assets/menteeDetails.txt /home/core/
sudo mkdir -p /var/www/gemini.club /var/www/user.gemini.club
sudo cp /assets/apache/gemini.club.conf /assets/apache/user.gemini.club.conf /etc/apache2/sites-available/
sudo cp -r /assets/apache/gemini.club /assets/apache/user.gemini.club /var/www/

# Adding cronjob for core
echo -e "10 10 * * * /home/core/.source/displayStatus.sh\n10 10 * 5-7 0,1,3,5 /home/core/.source/removeUsers.sh" | sudo crontab -u core -

# Adding Aliases
tmp=$(echo -e "alias userGen='bash /home/core/.source/1alias.sh'; alias mentorAllocation='bash /home/core/.source/3alias.sh';alias displayStatus='bash /home/core/.source/5alias.sh'; source /home/core/.source/env.sh")
sudo echo $tmp >> /home/core/.bashrc

# Setting permissions for core home directory
sudo setfacl -Rm u:core:rwx,g::--- /home/core/

# Apache Configuration
sudo a2dissite 000-default.conf
sudo a2ensite gemini.club.conf user.gemini.club.conf

# Copying MySQl_connector_Python module to Python library
tar -xf /assets/mysql.tar.xz --directory /usr/lib/python3.11/
