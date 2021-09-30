'''
AnalyzeMember4 is a Sign Analysis
If the data is cleansed and correct, notice there are few try except blocks
the predecessor - readmember.py should have cleaned the data
The distribution of 17 grahas - the Sun, Moon, inner planets, outer planets
Rahu, Ketu, 5 asteroids can give an exhaustive analysis on the signs. 
The attempt has been first on Doctors and Medic*s. The * indicates medical, medicine etc.
All data is in Docker. 

Good Luck - Dev B, 9/28/2021
This code is open source. Feel free to optimize, make it better, faster.
No Data is provided. Data remains confidential to its owners.
Released under the MIT Open Source License.
Copyright - Dev B, Devb.com. All Rights Reserved.

'''
import mysql.connector
import re
import json

'''
Declarations, Sums and averages
'''
gr1 = ["Sun", "Moon", "Mercury", "Venus", "Mars", "Rahu", "Ketu", "Jupiter", "Saturn", "Neptune", "Uranus", "Pluto"]
allgrs = ["sun", "moon", "mercury", "venus", "mars", "rahu", "ketu", "jupiter", 
    "saturn", "uranus", "neptune", 
    "pluto", "chiron", "pholus", "ceres", "pallas", "juno"]
sname =['Ari', 'Tau', 'Gem', 'Can', 'Leo', 'Lib', 'Vir', 'Sco', 'Sag', 'Cap', 'Aqu', 'Pis']

ssign = [0,0,0,0,0,0,0,0,0,0,0,0]

rsun, rmoon, rmercury, rvenus, rmars, rrahu, rketu, rjupiter, rsaturn, \
    ruranus, rneptune, rpluto, rchiron, rpholus, rceres, rpallas, rjuno  = \
    {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}

# def
def computeNLord():
    for j in range(12):
        var = 'sign'
        dss = str(j+1)
        if rsun[var] == dss:
            ssign[j] = ssign[j] + 1
        if rmoon[var] == dss: 
            ssign[j] = ssign[j] + 1
        if rmercury[var] == dss:
            ssign[j] = ssign[j] + 1
        if rvenus[var] == dss:
            ssign[j] = ssign[j] + 1
        if rmars[var] == dss:
            ssign[j] = ssign[j] + 1
        if rjupiter[var] == dss:
            ssign[j] = ssign[j] + 1
        if rsaturn[var] == dss: 
            ssign[j] = ssign[j] + 1
        if ruranus[var] == dss:
            ssign[j] = ssign[j] + 1
        if rrahu[var] == dss:
            ssign[j] = ssign[j] + 1
        if rketu[var] == dss: 
            ssign[j] = ssign[j] + 1
        if rneptune[var] == dss:
            ssign[j] = ssign[j] + 1
        if rpluto[var] == dss:
            ssign[j] = ssign[j] + 1
        if rchiron[var] == dss:
            ssign[j] = ssign[j] + 1
        if rpholus[var] == dss:
            ssign[j] = ssign[j] + 1
        if rceres[var] == dss:
            ssign[j] = ssign[j] + 1
        if rpallas[var] == dss: 
            ssign[j] = ssign[j] + 1
        if rjuno[var] == dss:
            ssign[j] = ssign[j] + 1
    return
# end def

cnx = mysql.connector.connect(user='root', password='example', database='research', port=6033)
cursor = cnx.cursor(buffered=True)

sqlex = "SELECT sun, moon, mercury, venus, mars, rahu, ketu, jupiter, saturn, uranus, \
    neptune, pluto, chiron, pholus, ceres, pallas, juno FROM `member_info` \
    WHERE LOWER(`profession`) like '%doctor%' OR LOWER(`profession`) like '%medic%'"
# sqlex = "SELECT sun, moon, mercury, venus, mars, rahu, ketu, jupiter, saturn, uranus, neptune, pluto FROM `member_info` LIMIT 20"
cursor.execute(sqlex)
cntr = 0

for (sun, moon, mercury, venus, mars, rahu, ketu, jupiter, saturn, uranus, neptune, \
    pluto, chiron, pholus, ceres, pallas, juno) in cursor:
    rsun = json.loads(sun)
    rmoon = json.loads(moon)
    rmercury = json.loads(mercury)
    rvenus = json.loads(venus)
    rmars = json.loads(mars)
    rrahu = json.loads(rahu)
    rketu = json.loads(ketu)
    rjupiter = json.loads(jupiter)
    rsaturn = json.loads(saturn)
    ruranus = json.loads(uranus)
    rneptune = json.loads(neptune)
    rpluto = json.loads(pluto)
    rchiron = json.loads(chiron)
    rpholus = json.loads(pholus)
    rceres = json.loads(ceres)
    rpallas = json.loads(pallas)
    rjuno = json.loads(juno)
    #
    computeNLord()
    cntr = cntr + 1
    
    '''
    print ("{}, {}, {},\
        {}, {}, {},\
        {}, {}, {}".format(
        ruranus['nlord'], ruranus['n27'], ruranus['n28'],
        rneptune['nlord'], rneptune['n27'], rneptune['n28'],
        rpluto['nlord'], rpluto['n27'], rpluto['n28']))
    ''' 

    '''
    print ("{}, {}, {}, {}, {}, {}, {}, {}, {}, {}".format(
        rsun["lng"], rmoon["lng"], rmercury["lng"], rvenus["lng"], rmars["lng"], rjupiter["lng"], rsaturn["lng"],
        ruranus["lng"], rneptune["lng"], rpluto["lng"])
    )
    '''
cursor.close()
cnx.close()

print (cntr)
print (sname)
print (ssign)
