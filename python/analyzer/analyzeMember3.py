'''
Count of professions
'''
import mysql.connector
import re
import json

cnx = mysql.connector.connect(user='root', password='example', database='research', port=6033)
cursor = cnx.cursor(buffered=True)

sqlex = "SELECT COUNT(id) as count, profession FROM member_info GROUP BY profession ORDER BY COUNT(id) DESC;"
cursor.execute(sqlex)
cntr = 0

for (count, profession) in cursor:
    rcount = count
    rprof = profession
    print ("{:d}, {}".format(rcount, rprof))
# end for

cursor.close()
cnx.close()

