import mysql.connector
import sys
import os

# Connecting to db
db = mysql.connector.connect(
    host=os.environ.get('MYSQL_HOST'),
    user=os.environ.get('MYSQL_USER'),
    password=os.environ.get('MYSQL_PASSWORD'),
    database="gemini"
)

# Creating cursor object
crr = db.cursor()

# SQL Query
sql1 = "UPDATE mentees SET " + sys.argv[3] + " = '" + sys.argv[1] + "' WHERE roll = " + sys.argv[2]
crr.execute(sql1)
db.commit()
db.close
