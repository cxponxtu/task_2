import mysql.connector
import os
import sys

# Connecting to db
db = mysql.connector.connect(
    host=os.environ.get('MYSQL_HOST'),
    user=os.environ.get('MYSQL_USER'),
    password=os.environ.get('MYSQL_PASSWORD')
)

# Creating cursor object
crr = db.cursor()

# Getting IP of MyPHPAdmin

# SQL Query
sql = "DROP USER '" + sys.argv[1] + "'@'" + sys.argv[2] + "'"
crr.execute(sql)
crr.execute("FLUSH PRIVILEGES")
db.commit()
crr.execute("FLUSH PRIVILEGES")
db.close