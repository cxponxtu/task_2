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
sql1 = "INSERT INTO task_submitted (name, roll) VALUES ('" + sys.argv[1] + "', " + sys.argv[2] + ")"
sql2 = "INSERT INTO task_completed (name, roll) VALUES ('" + sys.argv[1] + "', " + sys.argv[2] + ")"
sql3 = "INSERT INTO mentees (name, roll) VALUES ('" + sys.argv[1] + "', " + sys.argv[2] + ")"

crr.execute(sql1)
crr.execute(sql2)
crr.execute(sql3)
db.commit()

db.close()