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
sql1 = "DELETE FROM task_submitted WHERE roll = " + sys.argv[1]
sql2 = "DELETE FROM task_completed WHERE roll = " + sys.argv[1]
sql3 = "DELETE FROM mentees WHERE roll = " + sys.argv[1]

crr.execute(sql1)
crr.execute(sql2)
crr.execute(sql3)
db.commit()
db.close()