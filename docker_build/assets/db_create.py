import mysql.connector
import os
import socket

# Connecting to db
db = mysql.connector.connect(
    host=os.environ.get('MYSQL_HOST'),
    user=os.environ.get('MYSQL_USER'),
    password=os.environ.get('MYSQL_PASSWORD')
)

# Creating cursor object
crr = db.cursor()

#Getting IP of MyPHPAdmin
ip = socket.gethostbyname('phpmyadmin')

# SQL Query
crr.execute("CREATE DATABASE IF NOT EXISTS gemini")
crr.execute("USE gemini")
crr.execute("CREATE TABLE IF NOT EXISTS task_submitted (name VARCHAR(255), roll INT(255), PRIMARY KEY(roll), web1 BOOL, web2 BOOL, web3 BOOL, app1 BOOL, app2 BOOL ,app3 BOOL, sys1 BOOL, sys2 BOOL, sys3 BOOL)")
crr.execute("CREATE TABLE IF NOT EXISTS task_completed (name VARCHAR(255), roll INT(255), PRIMARY KEY(roll), web1 BOOL, web2 BOOL, web3 BOOL, app1 BOOL, app2 BOOL ,app3 BOOL, sys1 BOOL, sys2 BOOL, sys3 BOOL)")
crr.execute("CREATE TABLE IF NOT EXISTS mentees (name VARCHAR(255), roll INT(255), PRIMARY KEY(roll), password VARCHAR(255), web INT(8), app INT(8), sys INT(8), webmen VARCHAR (255), appmen VARCHAR (255), sysmen VARCHAR (255), permission INT(8) DEFAULT 1 )")
crr.execute("CREATE TABLE IF NOT EXISTS mentors (name VARCHAR(255), PRIMARY KEY(name), domain VARCHAR(255), password VARCHAR(255), cap INT(255), permission INT(8) DEFAULT 2)")
crr.execute("CREATE TABLE IF NOT EXISTS admin (name VARCHAR(255), password VARCHAR(255), permission INT(8) DEFAULT 3)")
crr.execute("DELETE FROM admin WHERE name = 'core'")
sql="INSERT INTO admin (name, password) VALUES ('core', '" + os.environ.get('WEBSITE_PASSWORD') +"')"
sql1 = "CREATE USER '" + os.environ.get('PHPMYADMIN_USER') + "'@'" + ip + "' IDENTIFIED BY '" + os.environ.get('PHPMYADMIN_PASSWORD') + "'"
sql2 = "GRANT SELECT ON gemini.* TO '" + os.environ.get('PHPMYADMIN_USER') + "'@'" + ip + "'"
crr.execute(sql)
crr.execute(sql1)
crr.execute(sql2)
crr.execute("FLUSH PRIVILEGES")
db.commit()
crr.execute("FLUSH PRIVILEGES")
db.close()

file = open("/home/core/.phpmyadmin","w")
file.writelines(os.environ.get('PHPMYADMIN_USER')+"\n"+ip)
file.close()
