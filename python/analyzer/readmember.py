'''
Readmember.py is a data conversion / cleansing effort to streamline 
data to run against swiss ephemeris / JPV ephemeris. 
Data I received had many ambiguities and representations.
It took a while to bring everything under one roof - roughly half million records


'''
import sqlite3
from sqlite3 import dbapi2 as sqlite
import datetime
import mysql.connector
import re
import json
from swejotiz import computeAstro
import random

cnx = mysql.connector.connect(user='root', password='example', database='research', port=6033)
cursor = cnx.cursor(buffered=True)
curs2 = cnx.cursor(buffered=True)

sqlex = 'DROP TABLE IF EXISTS member_info'
cursor.execute(sqlex)
sqlex = "CREATE TABLE `member_info` ( \
  `id` bigint UNSIGNED PRIMARY KEY,\
  `first_name` varchar(50) NOT NULL DEFAULT '',\
  `last_name` varchar(50) NOT NULL DEFAULT '', \
  `gender` enum('male','female') NOT NULL DEFAULT 'male', \
  `hour` varchar(2) DEFAULT NULL, \
  `min` varchar(2) DEFAULT NULL, \
  `year` varchar(4) DEFAULT NULL, \
  `mon` varchar(2) DEFAULT NULL, \
  `day` varchar(2) DEFAULT NULL, \
  `city_of_birth` varchar(50) NOT NULL DEFAULT '', \
  `country_of_birth` varchar(50) NOT NULL DEFAULT '', \
  `lat` decimal(10,2) NOT NULL, \
  `lng` decimal(10,2) NOT NULL, \
  `tz` decimal(10,2) NOT NULL, \
  `daylight_save` int NOT NULL, \
  `height` varchar(20) DEFAULT NULL, \
  `profession` varchar(100) NOT NULL DEFAULT '', \
  `religion` varchar(50) NOT NULL DEFAULT '', \
  `city` varchar(60) NOT NULL DEFAULT '', \
  `country` varchar(70) NOT NULL DEFAULT '', \
  `asc` json NOT NULL, \
  `sun` json NOT NULL, \
  `moon` json NOT NULL, \
  `mercury` json NOT NULL, \
  `venus` json NOT NULL, \
  `mars` json NOT NULL, \
  `jupiter` json NOT NULL, \
  `saturn` json NOT NULL, \
  `uranus` json NOT NULL, \
  `neptune` json NOT NULL, \
  `pluto` json NOT NULL, \
  `rahu` json NOT NULL, \
  `ketu` json NOT NULL, \
  `chiron` json NOT NULL, \
  `pholus` json NOT NULL, \
  `ceres` json NOT NULL, \
  `pallas` json NOT NULL, \
  `juno` json NOT NULL, \
  `vesta` json NOT NULL \
)"
cursor.execute(sqlex)

query = "SELECT `id`, `first_name`, `last_name`, `gender`, `hour`, `min`, `year`, `mon`, `day`, \
    `city_of_birth`, `country_of_birth`, `latitude`, `longitude`, `time_zone`, \
    `daylight_save`, `height`, `profession`, `religion`, `city`, \
    `country` FROM `bi_member2`" # LIMIT 100"
cursor.execute(query)

regex = r"\d\d\d[.]\d\d[.]\S"
reg2 = r"\d\d\S\d\d\S\d\d"
cnt = 0

for (id, first_name, last_name, gender, hour, min, year, mon, day, city_of_birth,  
    country_of_birth, latitude, longitude, time_zone, daylight_save, height, profession, 
    religion, city, country) in cursor:

    cnt += 1
    if (cnt == 50000 or cnt == 100000 or cnt == 200000 or cnt == 300000 or cnt == 400000 or cnt == 500000):
        print (cnt)
    # print("{}, {}, {}, {}, {}, {}, {}".format(
    #    last_name, first_name, city_of_birth, country_of_birth, latitude, longitude, time_zone))
    # one headache
    if re.match(regex, latitude):
        lt = re.split(r"[.]", latitude)
        ln = re.split(r"[.]", longitude)
        newlat = int(lt[0]) + int(lt[1]) / 60
        newlng = int(ln[0]) + int(ln[1]) / 60
        if ln[2] == 'w':
            newlng = -1 * newlng
        if lt[2] == 's':
            newlat = -1 * newlat
    # end if

    # second headache
    if re.match(reg2, latitude):
        if latitude.find("n") > 0: 
            lt = re.split(r"n|'", latitude)
        if latitude.find("s") > 0: 
            lt = re.split(r"s|'", latitude)
        if longitude.find("e") > 0: 
            ln = re.split(r"e|'", longitude)
        if longitude.find("w") > 0: 
            ln = re.split(r"w|'", longitude)
        # print (lt, ln)
        newlat = int(lt[0]) + int(lt[1]) / 60
        newlng = int(ln[0]) + int(ln[1]) / 60
        if longitude.find("w") > 0:
            newlng = -1 * newlng
        if latitude.find("s") > 0: 
            newlat = -1 * newlat
    # end if

    # set the time zone
    newtz = 0.0
    if (time_zone == '-330' or time_zone == '-05:30:00'):
        newtz = 5.5
    else:
        newtz = int(newlng / 15)
    # print ("{:.2f}, {:.2f}, {:.2f}".format(newlat, newlng, newtz))

    hh = int(hour)
    mm = int(min)
    if hh == 0 and mm == 0:
        hh = random.randint(0, 23)
        mm = random.randint(0, 59)

    asc, sun, moon, mercury, venus, mars, jupiter, saturn, uranus = {},{},{},{},{},{},{},{},{}
    neptune, pluto, rahu, ketu, chiron, pholus, ceres, pallas, juno, vesta = {},{},{},{},{},{},{},{},{},{}

    asc, sun, moon, mercury, venus, mars, jupiter, saturn, rahu, ketu, uranus, neptune, pluto, chiron, pholus, ceres, pallas, juno, vesta = \
        computeAstro(int(year), int(mon), int(day), hh, mm, newtz, newlng, newlat)

    sqlex = ("INSERT INTO `member_info`(`id`, `first_name`, `last_name`, `gender`, `hour`, `min`, \
        `year`, `mon`, `day`, `city_of_birth`, `country_of_birth`, \
        `lat`, `lng`, `tz`, \
        `daylight_save`, `height`, `profession`, `religion`, `city`, `country`, \
        `asc`, \
        `sun`, `moon`, `mercury`, `venus`, `mars`, `jupiter`, `saturn`, `uranus`, \
        `neptune`, `pluto`, `rahu`, `ketu`, `chiron`, `pholus`, `ceres`, `pallas`, `juno`, `vesta`) \
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, \
        %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)")


    data = (id, first_name, last_name, gender, 
        "{:2d}".format(hh), "{:2d}".format(mm), 
        year, mon, day, city_of_birth, country_of_birth, 
        "{:.2f}".format(newlat), "{:.2f}".format(newlng), "{:.2f}".format(newtz), 
        daylight_save, height, profession, religion, city, country,
        json.dumps(asc),
        json.dumps(sun), json.dumps(moon), json.dumps(mercury), 
        json.dumps(venus), json.dumps(mars), 
        json.dumps(jupiter), json.dumps(saturn), json.dumps(uranus),
        json.dumps(neptune), json.dumps(pluto), json.dumps(rahu), json.dumps(ketu), 
        json.dumps(chiron), json.dumps(pholus), json.dumps(ceres), 
        json.dumps(pallas), json.dumps(juno), json.dumps(vesta)
    )

    try:
        curs2.execute(sqlex, data)
    except:
        print (cnt, "Error, but continuing")
#end for

cnx.commit()

sqlex = "SELECT sun, moon, mercury FROM `member_info` WHERE LOWER(`profession`) like '%doctor%'  LIMIT 5"
cursor.execute(sqlex)
for (sun, moon, mercury) in cursor:
    print ("{} {} {}".format(sun, moon, mercury))

curs2.close()
cursor.close()
cnx.close()

'''

con = sqlite3.connect('atlas.db')
cur = con.cursor()
iso = request.form.get('iso')
ctr = '%' + request.form.get('place') + '%'
rst = []
res = {}

xsql = "SELECT A._idx, A.name, A.asciiname, A.alternatenames, B.iso, A.latitude, A.longitude, A.elevation, C.timezoneid, C.gmtoffset, C.dstoffset, C.rawoffset FROM GeoNames as A, CountryInfo AS B, Timezones AS C WHERE B.iso = (?) AND B._idx = A.country AND (A.name LIKE (?)) AND A.timezone = C._idx ORDER BY A.name"
for row in cur.execute(xsql, (iso, ctr)):
    res['id'] = row[0]
    res['name'] = str(row[1]) + "|Alt:" + str(row[3]) +"|Lat: "+ str(row[5]) + "|Lng: " + str(row[6]) + "|TZ:"+ str(row[8])
    rst.append(res.copy())
'''