'''
Created on Feb 3, 2017

@author: devbhattacharyya
'''
from core.jotiz import Jotiz
from core.jconstant import JConstant
import math

j = Jotiz()
jc = JConstant()
b_year = 1959
b_month = 11
b_day = 12
b_hour = 13
b_min = 30
b_latitude = 22.57
b_longitude = 88.36
b_timezone = 5.5
b_dst = 0
j.setvalues(b_year, b_month, b_day, b_hour, b_min, 
            b_latitude, b_longitude, b_timezone, b_dst)
b_ayantype = 0
b_ayanvalue = 0
j.runCalculations(b_ayantype, b_ayanvalue)

# divisors
d2 = 13.33333333333333;
d1 = 3.333333333333333;

print ('%20s' % 'Ayanamsa:' + '%8.3f' % j.plnt[0])
ascdegs = j.globLagnaDeg
ascSign = int(ascdegs / 30.0)
ascnak = int(ascdegs / d2);
ascpada = int(ascdegs / d1) % 4 + 1
print ('%11s' % 'Ascendant:'\
+ '%12s' % jc.zsigns[ascSign] \
+ '%8.3f' % j.globLagnaDeg \
+ '   %3.3f' % (j.globLagnaDeg - (math.floor(j.globLagnaDeg / 30)*30)) \
+ '%12s' % jc.nak[ascnak])

# print plnt values
for i in range (1, 10):
    plntSign = int(j.plnt[i] / 30.0)
    plntnak = int(j.plnt[i] / d2)
    print ('%10s:' % jc.planet[i] + '%12s' % jc.zsigns[plntSign] \
        + '%8.3f' % j.plnt[i] \
        + '   %3.3f' % (j.plnt[i] - (math.floor(j.plnt[i] / 30)*30)) \
        + '%12s' % jc.nak[plntnak])
    
print ('** Moon factors **')
print ('Tithi Born: '+j.globTithi)
print ('Tithi: ' + j.globPaksha)
print ('Lunar Day: %d' % j.globLunarDay)
print ('Lunar Date: ' + j.globLunarDate)
print ('Nakshatra: ' + j.globNakshatra)
inak = int(j.globNakshatra_No)
print ('Nakshatra No: %d' % (inak + 1))
print ('Nakshatra Pada: %d' % j.globNakshatra_Pada)
print ('Nakshatra Lord: ' + j.globNakshatra_Lord)
moonSign = int(j.plnt[7] / 30.0)
print ('Sign: ' + jc.zsigns[moonSign])
print ('Dasa Born: ' + j.globDasaBorn)
print ('Yoga: ' + j.globYoga)
print ('Yoni: ' + jc.yoniA[inak])
print ('Gana: ' + jc.ganaA[inak])
print ('Nadi: ' + jc.nadiA[inak])
print ('Rajju: ' + jc.rajjuA[inak])
print ('Varna: ' + jc.varnaA[moonSign])
print ('Mahantarey: ' + jc.mahantareyA[moonSign])


print ('** Ascendant factors **')
print ('Ascendant Nakshatra: ' + jc.nak[ascnak])
print ('Ascendant Nakshatra No: %d' % ascnak)
print ('Asc Nakshatra Pada: %d' % ascpada)
print ('Asc Nakshatra Lord: ' + jc.naklords[ascnak])
print ('Asc Sign: ' + jc.zsigns[ascSign])
print ('Yoni: ' + jc.yoniA[ascnak])
print ('Gana: ' + jc.ganaA[ascnak])
print ('Nadi: ' + jc.nadiA[ascnak])
print ('Rajju: ' + jc.rajjuA[ascnak])
print ('Varna: ' + jc.varnaA[ascSign])
print ('Mahantarey: ' + jc.mahantareyA[ascSign])

print ('** Sun factors **')
sundegs = j.plnt[1]
sunnak = int(sundegs / d2)
sunpada = int(sundegs / d1) % 4 + 1
print ('Ascendant Nakshatra: ' + jc.nak[sunnak])
print ('Ascendant Nakshatra No: %d' % sunnak)
print ('Asc Nakshatra Pada: %d' % sunpada)
print ('Asc Nakshatra Lord: ' + jc.naklords[sunnak])
sunSign = int(sundegs / 30.0)
print ('Asc Sign: ' + jc.zsigns[sunSign])
print ('Yoni: ' + jc.yoniA[sunnak])
print ('Gana: ' + jc.ganaA[sunnak])
print ('Nadi: ' + jc.nadiA[sunnak])
print ('Rajju: ' + jc.rajjuA[sunnak])
print ('Varna: ' + jc.varnaA[sunSign])
print ('Mahantarey: ' + jc.mahantareyA[sunSign])


