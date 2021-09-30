import mysql.connector
import re
import json

'''
Declarations, Sums and averages
'''
gr1 = ["Sun", "Moon", "Mercury", "Venus", "Mars", "Rahu", "Ketu", "Jupiter", "Saturn", "Neptune", "Uranus", "Pluto"]
gr2 = ["Ketu", "Venus","Sun", "Moon", "Mars", "Rahu", "Jupiter", "Saturn","Mercury"]
naks28 = ['Ashwini', 'Bharani', 'Krittika', 'Rohini', 'Mrigashira', 'Ardra', 'Punarvasu',
'Pushya', 'Aslesha', 'Magha', 'Purva Phalguni', 'Uttara Phalguni', 'Hasta', 'Chitra',
'Svati', 'Visakha', 'Anuradha', 'Jyestha', 'Mula', 'Purva Ashada', 'Uttara Ashada',
'Abhijit', 'Sravana', 'Dhanista', 'Sata Bhisag', 'Purva Bhadrapada', 'Uttara Bhadrapada', 'Revati']
naks27 = ['Ashwini', 'Bharani', 'Krittika', 'Rohini', 'Mrigashira', 'Ardra', 'Punarvasu',
'Pushya', 'Aslesha', 'Magha', 'Purva Phalguni', 'Uttara Phalguni', 'Hasta', 'Chitra',
'Svati', 'Visakha', 'Anuradha', 'Jyestha', 'Mula', 'Purva Ashada', 'Uttara Ashada',
'Sravana', 'Dhanista', 'Sata Bhisag', 'Purva Bhadrapada', 'Uttara Bhadrapada', 'Revati']
naklords = ["Ketu", "Venus",
            "Sun", "Moon", "Mars", "Rahu", "Jupiter", "Saturn",
            "Mercury", "Ketu", "Venus", "Sun", "Moon",
            "Mars", "Rahu", "Jupiter", "Saturn", "Mercury", "Ketu",
            "Venus", "Sun", "Moon", "Mars",
            "Rahu", "Jupiter", "Saturn", "Mercury"]
allgrs = ["sun", "moon", "mercury", "venus", "mars", "rahu", "ketu", "jupiter", 
    "saturn", "uranus", "neptune", 
    "pluto", "chiron", "pholus", "ceres", "pallas", "juno"]

sgraha = [0,0,0,0,0,0,0,0,0]
sn27 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
sn28 = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
sign = [0,0,0,0,0,0,0,0,0,0,0,0]

rsun, rmoon, rmercury, rvenus, rmars, rrahu, rketu, rjupiter, rsaturn, \
    ruranus, rneptune, rpluto, rchiron, rpholus, rceres, rpallas, rjuno  = \
    {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}, {}

# def
def computeNLord():
    for j in range(9):
        var = 'nlord'
        dss = gr2[j]
        if rsun[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rmoon[var] == dss: 
            sgraha[j] = sgraha[j] + 1
        if rmercury[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rvenus[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rmars[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rjupiter[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rsaturn[var] == dss: 
            sgraha[j] = sgraha[j] + 1
        if ruranus[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rrahu[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rketu[var] == dss: 
            sgraha[j] = sgraha[j] + 1
        if rneptune[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rpluto[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rchiron[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rpholus[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rceres[var] == dss:
            sgraha[j] = sgraha[j] + 1
        if rpallas[var] == dss: 
            sgraha[j] = sgraha[j] + 1
        if rjuno[var] == dss:
            sgraha[j] = sgraha[j] + 1
    return
# end def

# def
def computeN27():
    var = 'n27'
    j = int(rsun[var])
    sn27[j] = sn27[j] + 1
    j = int(rmoon[var])
    sn27[j] = sn27[j] + 1
    j = int(rmercury[var])
    sn27[j] = sn27[j] + 1
    j = int(rvenus[var])
    sn27[j] = sn27[j] + 1
    j = int(rmars[var])
    sn27[j] = sn27[j] + 1
    j = int(rrahu[var])
    sn27[j] = sn27[j] + 1
    j = int(rketu[var])
    sn27[j] = sn27[j] + 1
    j = int(rjupiter[var])
    sn27[j] = sn27[j] + 1
    j = int(rsaturn[var])
    sn27[j] = sn27[j] + 1
    j = int(ruranus[var])
    sn27[j] = sn27[j] + 1
    j = int(rneptune[var])
    sn27[j] = sn27[j] + 1
    j = int(rpluto[var])
    sn27[j] = sn27[j] + 1
    j = int(rchiron[var])
    sn27[j] = sn27[j] + 1
    j = int(rpholus[var])
    sn27[j] = sn27[j] + 1
    j = int(rceres[var]) 
    sn27[j] = sn27[j] + 1
    j = int(rpallas[var]) 
    sn27[j] = sn27[j] + 1
    j = int(rjuno[var])
    sn27[j] = sn27[j] + 1
    return                
# end def

# def
def computeN28():
    var = 'n28'
    j = int(rsun[var])
    sn28[j] = sn28[j] + 1
    j = int(rmoon[var])
    sn28[j] = sn28[j] + 1
    j = int(rmercury[var])
    sn28[j] = sn28[j] + 1
    j = int(rvenus[var])
    sn28[j] = sn28[j] + 1
    j = int(rmars[var])
    sn28[j] = sn28[j] + 1
    j = int(rrahu[var])
    sn28[j] = sn28[j] + 1
    j = int(rketu[var])
    sn28[j] = sn28[j] + 1
    j = int(rjupiter[var])
    sn28[j] = sn28[j] + 1
    j = int(rsaturn[var])
    sn28[j] = sn28[j] + 1
    j = int(ruranus[var])
    sn28[j] = sn28[j] + 1
    j = int(rneptune[var])
    sn28[j] = sn28[j] + 1
    j = int(rpluto[var])
    sn28[j] = sn28[j] + 1
    j = int(rchiron[var])
    sn28[j] = sn28[j] + 1
    j = int(rpholus[var])
    sn28[j] = sn28[j] + 1
    j = int(rceres[var]) 
    sn28[j] = sn28[j] + 1
    j = int(rpallas[var]) 
    sn28[j] = sn28[j] + 1
    j = int(rjuno[var])
    sn28[j] = sn28[j] + 1
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
    computeN27()
    computeN28()
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
print (allgrs)
print (gr2)
print (sgraha)
print (naklords)
print (naks27)
print (sn27)
print (naks28)
print (sn28)
