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
sql1 = "UPDATE task_submitted SET " + sys.argv[2] + " = 0 WHERE roll = " + sys.argv[1]
sql2 = "UPDATE task_submitted SET " + sys.argv[3] + " = 0 WHERE roll = " + sys.argv[1]
sql3 = "UPDATE task_submitted SET " + sys.argv[4] + " = 0 WHERE roll = " + sys.argv[1]
sql4 = "UPDATE task_completed SET " + sys.argv[2] + " = -1 WHERE roll = " + sys.argv[1]
sql5 = "UPDATE task_completed SET " + sys.argv[3] + " = -1 WHERE roll = " + sys.argv[1]
sql6 = "UPDATE task_completed SET " + sys.argv[4] + " = -1 WHERE roll = " + sys.argv[1]
sql7 = "UPDATE mentees SET " + sys.argv[5] + " = " + sys.argv[6] + " WHERE roll = " + sys.argv[1]
sql8 = "UPDATE mentees SET " + sys.argv[5] + "men = -1 WHERE roll = " + sys.argv[1]
crr.execute(sql1)
crr.execute(sql2)
crr.execute(sql3)
crr.execute(sql4)
crr.execute(sql5)
crr.execute(sql6)
crr.execute(sql7)
crr.execute(sql8)
db.commit()
db.close
