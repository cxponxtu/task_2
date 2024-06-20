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
sql1 = "INSERT INTO mentors (name, domain, cap) VALUES ('" + sys.argv[1] + "', '" + sys.argv[2] + "', " + sys.argv[3] + " )"

crr.execute(sql1)
db.commit()

db.close()