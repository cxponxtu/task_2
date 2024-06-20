#!/bin/bash

# Apache and PHP installation
sudo apt install apache2 php php-mysql

# Copying files
sudo cp apache/gemini.club.conf apache/db.gemini.club.conf /etc/apache2/sites-available

# Enabling modules for proxy
sudo a2enmod proxy proxy_http 

# Modifying /etc/hosts for local DNS of gemini.club
sudo bash -c "echo '127.0.0.1        gemini.club db.gemini.club user.gemini.club' >> /etc/hosts"

# Disabling default-site and enabling gemini.club
sudo a2dissite 000-default.conf
sudo a2ensite gemini.club.conf db.gemini.club

# Apache start
sudo service apache2 restart

# Run apache2 on startup
sudo systemctl enable apache2

# Adding cronjob for db_backup
read -p "Enter root password for mysql : " MYSQL_ROOT_PASSWORD 
echo "docker exec mysql bash -c \"mysqldump -p$MYSQL_ROOT_PASSWORD gemini 2>/dev/null\" | cat > `pwd`/backup\`/date +'%d-%m-%y_%H_%M_%S'\`.sql" > backup/backup.sh
new_cron="3 5-8,15 1 1-7 1 `pwd`/backup/backup.sh"
cat <(crontab -l 2>/dev/null) <(echo $new_cron) | crontab -
chmod +x backup/backup.sh

