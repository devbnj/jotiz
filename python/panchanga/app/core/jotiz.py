'''
 * Copyright 1997-2017 Dev Bhattacharyya / Emryn.com / Devb.com.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License")
 * you may not use self file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *      http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law 
 * or agreed to in writing, software
 * distributed under the License is distributed on an 
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS 
 * OF ANY KIND, either express or implied.
 * See the License for the specific language 
 * governing permissions and
 * limitations under the License.
 * Created on Jan 31, 2017
 *
@author: devbhattacharyya
'''

import math
from core.jconstant import JConstant

# Class Jotiz
class Jotiz(object):
    # DEF constructor
    def __init__(self):   
        '''
        Constructor
        '''
        self.staticrj = 0
        self.globTithi = ""
        self.globPaksha = ""
        self.globLunarDay = 0
        self.globLunarDate = ""
        self.globNakshatra = ""
        self.globNakshatra_No = 0
        self.globNakshatra_Pada = 0
        self.globNakshatra_Lord = ""
        self.globDasaBorn = ""
        self.globYoga = ""
        self.globRashi = ""
        self.globRashiLord = ""
        self.globLagna = ""
        self.globLagnaLord = ""
        self.globAyanamsa = ""
        self.globObliquity = ""
        self.globSiderealTime = ""
        self.globCrudeDegrees = [[0]*13]*13 #13x13 Fill zeros in 13x13
        self.globPlanetPos = [[""]*14]*14 #14x14
        self.globRashiGeneral = [[""]*3]*14 #14x3
        self.globBhimsottari = [""]*9 # 9 
        self.globchalit = [[0]*15]*3 #3x15
        
        # [Placidus]
        self.globhstart = [[0]*12]*2 #2x12

        self.globashtak = [[0]*5]*12 #12x15
        self.globBhavaChalit = [[""]*3]*15 #15x3
        self.globvarga = [[0]*17]*14 #14x17

        self.globLagnaNum = 0
        self.globLagnaDeg = 0.0
        self.globBhimFinal = 0
        self.globHouseBhava = [0]*12   # 12
        self.globSignStart = [[0]*12]*12  # 12 x 12
        self.globBalDasa = ""
        self.cname = ""
        self.d = 0
        self.m = 0
        self.y = 0
        self.jul = 0
        self.h = 0
        self.mt = 0
        self.corr = 0

        self.maind = 0
        self.mainm = 0
        self.mainy = 0
        self.ret = 0
        self.ashtakr3 = [0]*13 # 13
        self.s3 = [0]*14 #13

        self.plnt = [0]*26 #26
        self.jupc = [0]*4 #4
        self.satc = [0]*4
        self.tt = [0]*4
        self.genHouse = [0]*13
        self.placidus = [0]*13
        self.ps = 0.0
        self.pt = 0.0
        self.julianCent = 0.0
        self.jpi = 0.0
        self.jpi_180 = 0.0
        self.s1 = 0.0
        self.lat = 0.0
        self.longt = 0.0
        self.aya = 0.0
        self.obliq = 0.0
        self.sidtime = 0.0
        self.h6 = 0.0
        self.tzone = 0.0
        self.jc = JConstant()
        return
    # UNDEF constructor    
        
    # DEF setValues  
    def setvalues(self, z_year, z_month, z_day, 
            z_hour, z_min, z_lat, 
            z_long, z_tz, z_corr):
        self.d = z_day
        self.m = z_month
        self.y = z_year
        self.mainm = z_month
        self.maind = z_day
        self.mainy = z_year
        self.h = z_hour
        self.mt = z_min
        self.lat = z_lat
        self.longt = z_long
        self.tzone = z_tz + z_corr
        return
    # UNDEF setValues     
        
    # DEF runCalculations
    def runCalculations (self, whType, ayanVal):
        # Pre-initialize 
        self.preInitialize()
        # Initialize the system
        self.initialize()

        # Determine the Ayanamsa
        # For western whType = 9
        if whType == 0: self.calcAyanamsa()
        if whType == 1: self.findRaman()
        if whType == 2: self.findLahiriCorr()
        if whType == 3: self.findKP()
        if whType == 4: self.plnt[0] = ayanVal
        if whType == 9: self.plnt[0] = 0

        # Determine the longitudes
        self.computeSun()
        self.computeMercury()
        self.computeVenus()
        self.computeMars()
        self.computeJupiter()
        self.computeSaturn()
        self.computeMoon()
        # Repeat increasing
        # by one hour
        self.ret = 1
        self.julianCent = self.julianCent \
            + (1.0 / 24 / 36525)
        self.computeSun()
        self.computeMercury()
        self.computeVenus()
        self.computeMars()
        self.computeJupiter()
        self.computeSaturn()
        self.computeMoon()
        # set the time back to original
        jcc = self.julianCent - (1.0 / 24 / 36525)
        self.julianCent = jcc
        # compute others
        self.doGeneral()
        self.perturbGrahas()

        self.findHouses()
        self.calcSaptaVarga()
        for m in range(6): self.calculateVargas(m)
        # self.findAshtakVarga()
        
        return
    # UNDEF runCalculations     

    # DEF preInitialize        
    def preInitialize(self):
        self.ps = 0.0
        self.pt = 0.0
        self.jpi = 3.14159265359
        self.jpi_180 = self.jpi / 180.0
        self.s1 = 99.99826

        self.jul = self.julianDay (self.d, self.m, self.y)
        newhcorr = self.longt / 15
        newhcorr = newhcorr - self.tzone

        self.tzone = -12 - self.tzone
        self.h6 = ((self.h 
                + self.tzone + self.corr) 
                + (self.mt / 60.0)) / 24.0 
        self.julianCent = (self.jul 
                - 694025.0 + self.h6) / 36525.0
        self.jul = (self.jul + 4) % 7
        return
    # UNDEF preInitialize
         
    # DEF julianDay        
    def julianDay(self, d, m, y) :
        if m < 3 :
            m = m + 12
            y = y - 1
        # endif
        a = math.floor (y / 100)
        b = 30.6 * (m + 1.0)
        l = math.floor(b)
        jd = (int) (365 * y + math.floor(y / 4) 
            + l + 2 - a + math.floor(a / 4) + d)
        return jd
    # UNDEF julianDay        

    
    # DEF findPlanet
    def findPlanet(self, meanLong, 
            longPerihelion, 
            longAscNode, 
            eccentri, 
            inclination, 
            meanDistance, pno) :
        pc = 0.0
        pd = 0.0
        self.jpi = math.pi
        self.jpi_180 = self.jpi / 180.0

        geocenLong = meanLong - longPerihelion 
        # Convert into radians
        if (geocenLong < 0): geocenLong = geocenLong + 360.0
        meanAnomaly = geocenLong * self.jpi_180
        # first estimate of E
        pf = meanAnomaly + eccentri * math.sin(meanAnomaly)

        # WHILE
        while True:
            pc = pf - eccentri * math.sin(pf) - meanAnomaly
            pd = 1 - eccentri * math.cos(pf)
            pf = pf - pc / pd
            if (abs(pc / pd) <= 0.01): break
        # End While 

        pr = meanDistance * (1 - eccentri * math.cos(pf))
        # ---- figure the acos value ---

        e1 = math.atan(eccentri / \
            math.sqrt(1 - eccentri * eccentri))
        e2 = self.jpi / 4 - e1 / 2
        e3 = math.sin(e2) / math.cos(e2)
        e4 = math.sin(pf / 2) / math.cos(pf / 2)
        v1 = math.atan(e4 / e3)
        if (v1 < 0.0): v1 = v1 + self.jpi
        pv = 2 * v1

        pc = longPerihelion * self.jpi_180
        pd = longAscNode * self.jpi_180
        meanAnomaly = inclination * self.jpi_180
        pj = pv + pc
        pk = pj - pd
        pl = 1.0 - math.cos(meanAnomaly)
        # px and py - coordinates
        px = (math.cos(pj) + math.sin(pk) \
              * math.sin(pd) * pl) * pr
        py = (math.sin(pj) - math.sin(pk) \
              * math.cos(pd) * pl) * pr

        # DEF IF
        if (pno == 1):
            self.ps = px
            self.pt = py
        # ENDIF
        
        pc = self.ps + px
        pd = self.pt + py
        # Geocentric Longitude -- pm 
        geocenLong = math.atan(pd / pc) / self.jpi_180
        if (pc < 0.0) : geocenLong = geocenLong + 180.0
        elif (pd < 0.0) : geocenLong = geocenLong + 360.0
        return geocenLong
    # UNDEF findPlanet

    # DEF fractionReal
    def fractionReal(self, x):
        return x - (int) (x)
    # UNDEF fractionReal
    
    #DEF computeSun
    def computeSun(self) :
        tmp0 = 22.460148 + 1.396042 * self.julianCent \
        + 3.08e-4 * self.julianCent * self.julianCent

        meanLngtd = 360 * self.fractionReal(0.71455 \
                    + 99.99826 * self.julianCent)
        lngPer = 258.76 + 0.323 * self.julianCent
        lngAscNd = 0.0
        eCC = 0.016751 - 0.000042 * self.julianCent
        inclntn = 0.0
        mnDist = 1.0
        pno = 1
        
        # if (self)
        if (self.ret == 0) :
            self.plnt[pno] = self.findPlanet(meanLngtd, lngPer, \
                            lngAscNd, eCC, inclntn, mnDist, pno)
            if (self.plnt[pno] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno] = self.plnt[pno] + tmp0 - self.plnt[0]
            else :
                self.plnt[pno] = -360 + self.plnt[pno] \
                + tmp0 - self.plnt[0]
        else :
            self.plnt[pno + 13] = self.findPlanet(meanLngtd, 
                    lngPer, lngAscNd, eCC, inclntn,
                    mnDist, pno)
            if (self.plnt[pno + 13] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno + 13] = self.plnt[pno + 13] \
                + tmp0 - self.plnt[0] 
            else :
                self.plnt[pno + 13] = -360 + self.plnt[pno + 13] \
                + tmp0 - self.plnt[0]
        # endif self
        return
    # UNDEF computeSun

    # DEF computeMercury
    def computeMercury(self) :
        meanLngtd = 360 * self.fractionReal(0.43255 \
                    + 415.20187 * self.julianCent)
        lngPer = 53.44 + 0.159 * self.julianCent
        lngAscNd = 24.69 - 0.211 * self.julianCent
        eCC = 0.205614 + 0.00002 * self.julianCent
        inclntn = 7.00288 + 0.001861 * self.julianCent
        mnDist = 0.3871
        pno = 2
        
        tmp0 = 22.460148 + 1.396042 * self.julianCent \
        + 3.08e-4 * self.julianCent * self.julianCent
        # if self.ret
        if (self.ret == 0) :
            self.plnt[pno] = self.findPlanet(meanLngtd, lngPer, 
                    lngAscNd, eCC, inclntn,
                    mnDist, pno)
            if (self.plnt[pno]  + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno] = self.plnt[pno] \
                + tmp0 - self.plnt[0]
            else :
                self.plnt[pno] = -360 + self.plnt[pno] \
                + tmp0 - self.plnt[0]
        else :
            self.plnt[pno + 13] = self.findPlanet(meanLngtd, 
                    lngPer, lngAscNd, eCC, inclntn,
                    mnDist, pno)
            if (self.plnt[pno + 13] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno + 13] = self.plnt[pno + 13] \
                + tmp0 - self.plnt[0]
            else :  
                self.plnt[pno + 13] = -360 + self.plnt[pno + 13] 
                + tmp0 - self.plnt[0]
        # endif self.rit
        return
    # UNDEF computeMercury

    # DEF computeVenus
    def computeVenus(self) :
        tmp0 = 22.460148 + 1.396042 * self.julianCent\
         + 3.08e-4 * self.julianCent * self.julianCent

        meanLngtd = 360 * self.fractionReal(0.88974 \
                    + 162.54949 * self.julianCent)
        lngPer = 107.70 + 0.012 * self.julianCent
        lngAscNd = 53.22 - 0.496 * self.julianCent
        eCC = 0.006820 - 0.000048 * self.julianCent
        inclntn = 3.39363 + 0.001 * self.julianCent
        mnDist = 0.72333
        pno = 3
        # if self.ret
        if (self.ret == 0) :
            self.plnt[pno] = self.findPlanet(meanLngtd, lngPer, 
                lngAscNd, eCC, inclntn,
                mnDist, pno)
            if (self.plnt[pno] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno] = self.plnt[pno] \
                + tmp0 - self.plnt[0]
            else : 
                self.plnt[pno] = -360 + self.plnt[pno] \
                + tmp0 - self.plnt[0]
        else :
            self.plnt[pno + 13] = self.findPlanet (meanLngtd, 
                lngPer, lngAscNd, eCC, inclntn,
                mnDist, pno)
            if (self.plnt[pno + 13] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno + 13] = self.plnt[pno + 13] \
                + tmp0 - self.plnt[0]
            else : 
                self.plnt[pno + 13] =  -360 + self.plnt[pno + 13] \
                + tmp0 - self.plnt[0]
        # end if self.ret
        return
    # UNDEF computeVenus

    # DEF computeMars
    def computeMars(self) :
        tmp0 = 22.460148 + 1.396042 * self.julianCent \
        + 3.08e-4 * self.julianCent * self.julianCent

        meanLngtd = 360 * self.fractionReal (0.75358 \
                    + 53.16751 * self.julianCent)
        lngPer = 311.76 + 0.445 * self.julianCent
        lngAscNd = 26.33 - 0.625 * self.julianCent
        eCC = 0.093313 - 0.000092 * self.julianCent
        inclntn = 1.850333 - 0.000675 * self.julianCent
        mnDist = 1.5237
        pno = 4
        # if self.ret
        if (self.ret == 0) :
            self.plnt[pno] = self.findPlanet (meanLngtd, 
                lngPer, lngAscNd, eCC, inclntn,
                mnDist, pno)
            if (self.plnt[pno] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno] = self.plnt[pno] \
                + tmp0 - self.plnt[0] 
            else : 
                self.plnt[pno] = -360 + self.plnt[pno] \
                + tmp0 - self.plnt[0]
        else :
            self.plnt[pno + 13] = self.findPlanet (meanLngtd, 
                lngPer, lngAscNd, eCC, inclntn,
                mnDist, pno)
            if (self.plnt[pno + 13] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno + 13] = self.plnt[pno + 13] \
                + tmp0 - self.plnt[0]
            else :  
                self.plnt[pno + 13] = -360 + self.plnt[pno + 13] \
                + tmp0 - self.plnt[0]
        # end if self.rit
        return
    # UNDEF computeMars

    # DEF computeJupiter
    def computeJupiter(self) :
        tmp0 = 22.460148 + 1.396042 * self.julianCent \
        + 3.08e-4 * self.julianCent * self.julianCent

        meanLngtd = 360 * self.fractionReal(0.59886 + 8.43029 \
                    * self.julianCent) + self.jupc[0]
        eCC = 0.048335 - 0.000164 * self.julianCent + self.jupc[2]
        lngPer = 350.26 + 0.214 * self.julianCent \
            + self.jupc[1] / eCC
        lngAscNd = 76.98 - 0.386 * self.julianCent
        inclntn = 1.308376 - 0.005696 * self.julianCent
        mnDist = 5.2026 + self.jupc[3]
        pno = 5
        # if self.ret
        if (self.ret == 0) :
            self.plnt[pno] = self.findPlanet(meanLngtd, 
                lngPer, lngAscNd, eCC, inclntn,
                mnDist, pno)
            if (self.plnt[pno] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno] = self.plnt[pno] \
                    + tmp0 - self.plnt[0]
            else :
                self.plnt[pno] =  -360 + self.plnt[pno] \
                    + tmp0 - self.plnt[0]
        else :
            self.plnt[pno + 13] = self.findPlanet(meanLngtd, 
                                lngPer, lngAscNd, eCC, inclntn,
                                mnDist, pno)
            if (self.plnt[pno + 13] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno + 13] = self.plnt[pno + 13] \
                    + tmp0 - self.plnt[0]
            else : 
                self.plnt[pno + 13] =  -360 + self.plnt[pno + 13] \
                    + tmp0 - self.plnt[0]
        # endif self.ret
        return
    # UNDEF computeJupiter

    # DEF computeSaturn
    def computeSaturn(self) :
        tmp0 = 22.460148 + 1.396042 * self.julianCent \
            + 3.08e-4 * self.julianCent * self.julianCent

        meanLngtd = 360 * self.fractionReal(0.67807 + 3.39476 \
                    * self.julianCent) + self.satc[0]
        eCC = 0.055892 - 0.000346 * self.julianCent + self.satc[2]
        lngPer = 68.64 + 0.562 * self.julianCent + self.satc[1] / eCC
        lngAscNd = 90.33 - 0.523 * self.julianCent
        inclntn = 2.492520 - 0.003920 * self.julianCent
        mnDist = 9.5547 + self.satc[3]
        pno = 6
        # if self.ret
        if (self.ret == 0) :
            self.plnt[pno] = self.findPlanet(meanLngtd, 
                lngPer, lngAscNd, eCC, inclntn,
                mnDist, pno)
            if (self.plnt[pno] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno] = self.plnt[pno] \
                + tmp0 - self.plnt[0] 
            else: 
                self.plnt[pno] = -360 + self.plnt[pno] \
                + tmp0 - self.plnt[0]
        else :
            self.plnt[pno + 13] = self.findPlanet(meanLngtd, 
                lngPer, lngAscNd, eCC, inclntn,
                mnDist, pno)
            if (self.plnt[pno + 13] + tmp0 - self.plnt[0] < 360) :
                self.plnt[pno + 13] = self.plnt[pno + 13] \
                    + tmp0 - self.plnt[0] 
            else :
                self.plnt[pno + 13] = -360 + self.plnt[pno + 13] \
                    + tmp0 - self.plnt[0]
        # end if self.ret
        return
    # UNDEF computeSaturn

    # DEF computeMoon
    def computeMoon(self) :
        tmp0 = 22.460148 + 1.396042 * self.julianCent \
            + 3.08e-4 * self.julianCent * self.julianCent

        g1 = 360 * self.fractionReal(0.71455 \
                + 99.99826 * self.julianCent)
        h1 = 258.76 + 0.323 * self.julianCent
        mnDist = 360 * self.fractionReal(0.68882 \
                    + 1336.851353 * self.julianCent)
        b0 = 360 * self.fractionReal(0.8663 \
                    + 11.298994 * self.julianCent - 3.0e-5 \
                    * self.julianCent * self.julianCent)
        c0 = 360 * self.fractionReal(0.65756 - 5.376495 \
                    * self.julianCent)
        if (c0 < 0.0) : c0 = c0 + 360.0
        meanLngtd = self.jpi_180 * (mnDist - b0)
        eCC = self.jpi_180 * (g1 - h1)
        d0 = self.jpi_180 * (mnDist - g1)
        f0 = self.jpi_180 * (mnDist - c0)
        l0 = mnDist + 6.2888 * math.sin(meanLngtd) \
            + 0.2136 * math.sin(2 * meanLngtd) \
            + 0.01 * math.sin(3 * meanLngtd) + 1.274 \
            * math.sin(2 * d0 - meanLngtd)+ 0.0085 \
            * math.sin(4 * d0 - 2 * meanLngtd)
        l0 = l0 - 0.0347 * math.sin(d0) + 0.6583 \
            * math.sin(2 * d0) + 0.0039 * math.sin(4 * d0)\
            - 0.1856 * math.sin(eCC) - 0.0021 \
            * math.sin(2 * eCC)+ 0.0052 \
            * math.sin(meanLngtd - d0)
        l0 = l0 - 0.0588 * math.sin(2 * meanLngtd - 2 * d0) \
            + 0.0572 * math.sin(2 * d0 - meanLngtd - eCC) \
            + 0.0533 * math.sin(meanLngtd + 2 * d0) \
            + 0.0458 * math.sin(2 * d0 - eCC)+ 0.041 \
            * math.sin(meanLngtd - eCC) - 0.0305 \
            * math.sin(meanLngtd + eCC)
        l0 = l0 - 0.0237 * math.sin(2 * f0 - meanLngtd) \
            - 0.0153 * math.sin(2 * f0 - 2 * d0) + 0.0107 \
            * math.sin(4 * d0 - meanLngtd)  - 0.0079 \
            * math.sin(-meanLngtd + eCC + 2 * d0) \
            - 0.0068 * math.sin(eCC + 2 * d0)  + 0.005 \
            * math.sin(eCC + d0)
        l0 = l0 - 0.0023 * math.sin(meanLngtd + d0)  + 0.004  \
            * math.sin(2 * meanLngtd + 2 * d0) + 0.004  \
            * math.sin(meanLngtd - eCC + 2 * d0) - 0.0037  \
            * math.sin(3 * meanLngtd - 2 * d0) - 0.0026  \
            * math.sin(meanLngtd - 2 * d0 + 2 * f0)  \
            + 0.0027  * math.sin(2 * meanLngtd - eCC)
        l0 = l0 - 0.0024  * math.sin(2 * meanLngtd \
            + eCC - 2 * d0) + 0.0022  * math.sin(2 * d0 - 2 * eCC) \
            - 0.0021 * math.sin(2 * meanLngtd + eCC)  + 0.0021  \
            * math.sin(c0 * self.jpi_180)  + 0.0021  \
            * math.sin(2 * d0 - meanLngtd - 2 * eCC)
        l0 = l0 - 0.0018  * math.sin(meanLngtd + 2 * d0 - 2 * f0) \
            + 0.0012  * math.sin(4 * d0 - meanLngtd - eCC) \
             - 0.0008  * math.sin(3 * d0 - meanLngtd)
        r0 = self.jpi_180 * 2 * (l0 - c0)
        dMoon3 = l0 - 0.1143 * math.sin(r0) + 0.004
        # Moon position
        if (dMoon3 >= 360.0) :  dMoon3 = dMoon3 - 360.0
        if (dMoon3 < 0.0) : dMoon3 = dMoon3 + 360.0
        # if self.ret
        if (self.ret == 0) :
            self.plnt[7] = dMoon3
            if (self.plnt[7] + tmp0 - self.plnt[0] < 360) :
                self.plnt[7] = self.plnt[7] \
                        + tmp0 - self.plnt[0]
            else :
                self.plnt[7] = (self.plnt[7] \
                        + tmp0 - self.plnt[0]) - 360
        else :
            self.plnt[20] = dMoon3
            if (self.plnt[20] + tmp0 - self.plnt[0] < 360) :
                self.plnt[20] = self.plnt[20] \
                    + tmp0 - self.plnt[0]
            else : 
                self.plnt[20] = (self.plnt[20] \
                    + tmp0 - self.plnt[0]) - 360
        # end if self.ret
        # Rahu Calculation
        dRahu4 = c0
        if (self.ret == 0) :
            self.plnt[8] = dRahu4
            if (self.plnt[8] + tmp0 - self.plnt[0] < 360) :
                self.plnt[8] = self.plnt[8] \
                    + tmp0 - self.plnt[0]
            else :
                self.plnt[8] = (self.plnt[8] \
                    + tmp0 - self.plnt[0]) - 360
        else :
            self.plnt[21] = dRahu4
            if (self.plnt[21] + tmp0 - self.plnt[0] < 360) : 
                self.plnt[21] = self.plnt[21] \
                    + tmp0 - self.plnt[0]
            else :
                self.plnt[21] = (self.plnt[21] \
                    + tmp0 - self.plnt[0]) - 360
        # Rahu endIf
        # Ketu calculation
        dKetu5 = c0 + 180.0
        if (dKetu5 >= 360.0) : dKetu5 = dKetu5 - 360.0
        if (self.ret == 0) :
            self.plnt[9] = dKetu5
            if (self.plnt[9] + tmp0 - self.plnt[0] < 360) :
                self.plnt[9] = self.plnt[9] \
                    + tmp0 - self.plnt[0]
            else :
                self.plnt[9] = (self.plnt[9]  \
                    + tmp0 - self.plnt[0]) - 360
        else :
            self.plnt[22] = dKetu5
            if (self.plnt[22] + tmp0 - self.plnt[0] < 360) :
                self.plnt[22] = self.plnt[22] \
                    + tmp0 - self.plnt[0]
            else :
                self.plnt[22] = (self.plnt[22] \
                    + tmp0 - self.plnt[0]) - 360
        # endif ketu
        return
    # UNDEF computeMoon

    # DEF initialize
    def initialize(self) :
        v0 = self.julianCent / 5 + 0.1
        lngAscNd = 2 * self.jpi \
            * self.fractionReal(0.65965  \
                + 8.43029 * self.julianCent)
        inclntn = 2 * self.jpi  \
            * self.fractionReal(0.73866  \
                + 3.39476 * self.julianCent)
        s0 = 2 * self.jpi * self.fractionReal(0.67644  
                    + 1.19019 * self.julianCent)
        v1 = 5 * inclntn - 2 * lngAscNd
        c0 = s0 - inclntn
        z0 = inclntn - lngAscNd
        v2 = math.sin(v1)
        v3 = math.sin(2 * v1)
        v4 = math.cos(v1)
        v5 = math.cos(2 * v1)
        y1 = math.sin(z0)
        y2 = math.sin(2 * z0)
        y3 = math.sin(3 * z0)
        y4 = math.cos(z0)
        y5 = math.cos(2 * z0)
        y6 = math.cos(3 * z0)
        q1 = math.sin(inclntn)
        q2 = math.sin(2 * inclntn)
        q3 = math.sin(3 * inclntn)
        q4 = math.cos(inclntn)
        q5 = math.cos(2 * inclntn)
        q6 = math.cos(3 * inclntn)
        w2 = math.sin(3 * c0)
        r1 = (0.331 - 0.01 * v0) \
            * v2 - 0.064 * v0 \
            * v4 + 0.014 * y1
        r1 = r1 + 0.018 * y2 - 0.034 * y4 \
            * q1 - 0.036 * y1 * q4
        r2 = 0.007 * v2 - 0.02 * v4 + q1 \
            * (0.007 * y1 + 0.034 \
            * y4 + 0.006 * y5)
        r2 = r2 + q4 * (0.038 * y1 \
            + 0.006 * y2 - 0.007 * y4)
        r2 = r2 + q2 * (-0.005 * y1 + 0.004 * y4) + q5 \
            * (0.004 * y1 + 0.006 * y4)
        r3 = 3606 * v2 + (1289 - 580 * v0) * v4 \
            + q1 * (-6764 * y1 - 1110 * y2 - 204 + 1284 * y4)
        r3 = r3 + q4 * (1460  * y1 - 817 + 6074 \
            * y4 + 992 * y5 + 508 * y6)
        r3 = r3 + q2 * (-956 * y1 - 997 * y4 + 480 * y5)
        r3 = r3 + q5 * (-956 * y1 + 490 * y2 + 179 \
            + 1024 * y4 - 437 * y5)
        r3 = r3 * 1e-7
        r4 = -263 * v4 + 205 * y4 + 693 * y5 + 312 * y6
        r4 = r4 + q1 * (299 * y1  + 181 * y5) + q4 \
            * (204 * y2 + 111 * y3 - \
            337 * y4 - 111 * y5)
        r4 = r4 * 1e-6
        s1 = (-0.814 + 0.018 * v0 - 0.017 * v0 * v0) * v2
        s1 = s1 + (-0.01 + 0.161 * v0) * v4 - 0.149 \
            * y1 - 0.041 * y2 - 0.015 * y3
        s1 = s1 + q1 * (-0.006 - 0.017 * y2 \
            + 0.081 * y4 + 0.015 * y5)
        s1 = s1 + q4 * (0.086 * y1 + 0.025 \
            * y4 + 0.014 * y5 + 0.006 * y6)
        s2 = (0.077 + 0.007 * v0) * v2 \
            + (0.046 - 0.015 * v0) * v4 - 0.007 * y1
        s2 = s2 - q1 * (0.076 * y1 + 0.025 \
            * y2 + 0.009 * y3)
        s2 = s2 + q4 * (-0.073 - 0.15 * y4 \
            + 0.027 * y5 + 0.01 * y6)
        s2 = s2 + q6 * (-0.014 * y1 - 0.008 * y4 + 0.014 * y5)
        s2 = s2 + q5 * (-0.014 * y1 + 0.012 \
            * y2 + 0.015 * y4 - 0.013 * y5)
        s3 = (-7927 + 2548 * v0) * v2 + (13381 + 1226 * v0) * v4
        s3 = s3 + 248 * v3 - 305 * v5 + 412 * y2
        s3 = s3 + q1 * (12415 + (390 - 617 * v0) * y1 + 26599 * y4 
            - 4687 * y5 - 1870 * y6 - 821 * math.cos(4 * z0))
        s3 = s3 + q4 * (163 - 611 * v0 - 12696 * y1 \
            - 4200 * y2 - 1503 * y3 - 619 
            * math.sin(4 * z0) - (282 + 1306 * v0) * y4)
        s3 = s3 + q2 * (-350 + 2211 * y1 - 2208 * y2 - 568 \
            * y3 - 2780 * y4 + 2022 * y5)
        s3 = s3 + q5 * (-490 - 2842 * y1 - 1594 * y4 + 2162 \
            * y5 + 561 * y6 + 469 * w2)
        s3 = s3 * 1e-7
        s4 = 572 * v2 + 2933 * v4 + 33629 * y4 - 3081 \
            * y5 - 1423 * y6 - 671 \
            * math.cos(4 * z0)
        s4 = s4 + q1 * (1098 - 2812 * y1 + 688 * y2 - \
            393 * y3 + 2138 * y4 - 995 \
            * y5 - 642 * y6)
        s4 = s4 + q4 * (-890 + 2206 * y1 - 1590 * y2 \
            - 647 * y3 + 2285 * y4 + 2172 
            * y5 + 296 * y6)
        s4 = s4 + q2 * (-267 * y2 - 778 * y4 \
            + 495 * y5 + 250 * y6)
        s4 = s4 + q5 * (-856 * y1 + 441 * y2 + 296 
            * y5 + 211 * y6)
        s4 = s4 + q3 * (-427 * y1 + 398 * y3) + q6 * (344 
            * y4 - 427 * y6)
        s4 = s4 * 1e-6
        self.jupc[0] = r1
        self.jupc[1] = r2
        self.jupc[2] = r3
        self.jupc[3] = r4
        self.satc[0] = s1
        self.satc[1] = s2
        self.satc[2] = s3
        self.satc[3] = s4
        return
    # UNDEF initialize

    # DEF findSpecialHouses
    def findSpecialHouses(self, sidtm, c10) :
        r0 = self.aya
        w0 = self.obliq * self.jpi_180
        b0 = sidtm * 15.0 + 90.0
        if (b0 >= 360.0): b0 = b0 - 360.0
        sidtm = sidtm * self.jpi / 12.0
        c10 = c10 * self.jpi_180
        if ((sidtm == 0.0) and (c10 == 0.0)) : return 90.0

        meanLngtd = math.atan(-math.cos(sidtm) / \
                (math.sin(c10) * math.sin(w0) / 
                math.cos(c10) + math.sin(sidtm)  * math.cos(w0)))
        meanLngtd = meanLngtd / self.jpi_180
        if (meanLngtd < 0.00):  meanLngtd = meanLngtd + 180.0
        if (b0 - meanLngtd > 75.0): meanLngtd = meanLngtd + 180.0
        meanLngtd = meanLngtd - r0
        if (meanLngtd < 0.0) : meanLngtd = meanLngtd + 360.0
        if (meanLngtd > 360.0) : meanLngtd = meanLngtd - 360.0
        return meanLngtd
    #UNDEF findSpecialHouses

    # DEF findinGeneralHouses
    def findinGeneralHouses(self, j0, k0, u) :
        # start for
        for l in range(0, 2) :
            m0 = j0 + k0 * l
            if (m0 >= 360.0) : m0 = m0 - 360.0
            v = u + l - 1
            self.genHouse[v] = m0
        # end for
        return
    # UNDEF findinGeneralHouses

    # DEF findHouses
    def findHouses(self) :
        # StringBuilder sb = new StringBuilder()
        # Formatter formatter = new Formatter(sb, Locale.US)
        degrees = 0.0
        mins = 0.0
        secs = 0.0
        bEnd = 0.0

        self.aya = self.plnt[0]
        self.obliq = 23.452294 - 0.0130125 * self.julianCent
        mnDist = 24.0  * self.fractionReal(0.2769 \
                + 100.00214 * self.julianCent)
        b0 = self.h6 * 24.0 + 12.0
        c0 = self.longt / 15.0
        self.sidtime = 24.0 \
            * self.fractionReal((mnDist + b0 + c0) / 24.0)
        if (self.sidtime < 0) : self.sidtime = self.sidtime + 24.0
        mnDist = self.findSpecialHouses(self.sidtime, self.lat)
        b0 = self.findSpecialHouses(self.sidtime - 6.0, 0.0)
        c0 = (180.0 + b0 - mnDist) / 3.0
        if (b0 > mnDist):  c0 = c0 - 120.0
        d0 = 60.0 - c0

        self.findinGeneralHouses(mnDist, c0, 1)
        self.findinGeneralHouses(b0 + 180.0, d0, 4)
        self.findinGeneralHouses(mnDist + 180.0, c0, 7)
        self.findinGeneralHouses(b0, d0, 10)

        self.placidus[0] = (self.genHouse[11] + self.genHouse[0]) / 2.0
        if (self.genHouse[0] < self.genHouse[11]) : 
            self.placidus[0] = self.placidus[0] + 180.0
        if (self.placidus[0] >= 360.0) : 
            self.placidus[0] = self.placidus[0] - 360.0
        
        # for i 
        for i in range(1, 11) :
            self.placidus[i] = \
            (self.genHouse[i - 1] + self.genHouse[i]) / 2.0
            if (self.genHouse[i] < self.genHouse[i - 1]) :
                self.placidus[i] = self.placidus[i] + 180.0
            if (self.placidus[i] > 360.0) :
                self.placidus[i] = self.placidus[i] - 360.0
        # end for i

        # Other details 01 
        degrees = self.plnt[0]
        mins = (degrees - (int) (degrees)) * 60
        secs = (mins - (int) (mins)) * 60
        self.globAyanamsa = '%2d %2d %2d' % \
        (math.floor(degrees), math.floor(mins), math.floor(secs))
        degrees = self.obliq
        mins = (degrees - (int) (degrees)) * 60
        secs = (mins - (int) (mins)) * 60
        
        self.globObliquity = '%2d %2d %2d' % \
        (math.floor(degrees), math.floor(mins), math.floor(secs))
        self.globSiderealTime = '%7.2f' % (self.sidtime)

        # Placidus
        for i in range(0, 12) :
            for j in range(0, 11) :
                bStart = self.placidus[j]
                bMid = self.genHouse[j]
                if (j == 11) : bEnd = self.genHouse[0]
                else : bEnd = self.genHouse[j + 1]
                
                a1 = math.floor((self.placidus[j] / 30) + 1)
                a2 = math.floor((self.genHouse[j] / 30) + 1)
                a3 = math.floor((self.placidus[j + 1] / 30) + 1)
                degrees = self.genHouse[j] - ((a2 - 1) * 30)
                mins = (degrees - (int) (degrees)) * 60
                secs = (mins - (int) (mins)) * 60
                self.globSignStart[j][0] = bStart
                self.globSignStart[j][1] = bMid
                self.globSignStart[j][2] = bEnd
                self.globHouseBhava[j] = '%2d %2d %2d %s' % \
                (math.floor(degrees), math.floor(mins), \
                 math.floor(secs),self.jc.zsigns[int(a2 - 1)])
                self.globhstart[0][j] = self.genHouse[j]
                self.globhstart[1][j] = bEnd

                if ((self.globchalit[1][i] >= bMid) 
                    and (self.globchalit[1][i] < bEnd)) :
                    self.globchalit[2][i] = a2
                    self.globBhavaChalit[i + 1][1] = self.jc.graha[\
                                int(math.floor(self.globchalit[0][i]))]
                    self.globBhavaChalit[i + 1][2] = '%7d' % (a2)
                # endif

                if ((self.globchalit[1][i] < bEnd) and (bMid > bEnd)) :
                    self.globchalit[2][i] = a2
                    self.globBhavaChalit[i + 1][1] = self.jc.graha[\
                                int(math.floor(self.globchalit[0][i]))]
                    self.globBhavaChalit[i + 1][2] = '%7d' % (a2)
                # endif
                if ((self.globchalit[1][i] >= bMid) and (bMid > bEnd)) :
                    self.globchalit[2][i] = a2
                    self.globBhavaChalit[i + 1][1]  = self.jc.graha[\
                                int(math.floor(self.globchalit[0][i]))]
                    self.globBhavaChalit[i + 1][2] = '%7d' % (a2)
                # endif

            # end for j
        # end for i
        return
    # UNDEF findHouses

    # DEF computeDivisionalVargas
    def computeDivisionalVargas(self, y1, x0, t) :
        q = 0
        jvarga = [0]*20
        r0 = 0.0
        ARIES = 0
        TAURUS = 1
        GEMINI = 2
        CANCER = 3
        LEO = 4
        VIRGO = 5
        LIBRA = 6
        SCORPIO = 7
        SAGITTARIUS = 8
        CAPRICORNUS = 9
        AQUARIUS = 10
        PISCES = 11

        q = math.floor(x0 / 30)
        z = q + 1
        # ******************************
        # *** Div 1 - D1 
        # ******************************
        jvarga[1] = z - 12 * (int) (z / 12) 
        r0 = 30 * self.fractionReal(x0 / 30)
        m = 0
        if ((r0 >= 0) and (r0 < 10)) : m = 1
        elif ((r0 >= 10) and (r0 < 20)) : m = 5
        else: m = 9
        z = q + m
        # ******************************
        # *** Div 3 - D3 Drekkana 
        # ******************************
        jvarga[2] = z - 12 * (int) (z / 12) 
        z = math.floor((x0 * 7.0 / 30) + 1)
        # ******************************
        # *** Div 7 Saptamsa 
        # ******************************
        jvarga[3] = z - 12 * (int) (z / 12) 
        z = math.floor((x0 * 9.0 / 30) + 1)
        # ******************************
        # *** Div 9 - D9 Navamsa 
        # ******************************
        jvarga[4] = z - 12 * (int) (z / 12) 
        r = math.floor(10 * self.fractionReal(x0 / 30))
        if (q % 2 == 0): m = 1
        else: m = 9
        z = q + r + m
        # ******************************
        # *** Div 10 Dasamsa 
        # ******************************
        jvarga[5] = z - 12 * (int) (z / 12) 
        r = math.floor(12 * self.fractionReal(x0 / 30))
        z = q + r + 1
        # ******************************
        # *** Div 12  
        # ******************************
        jvarga[6] = z - 12 * (int) (z / 12) 
        z = math.floor(x0 * 16.0 / 30 + 1)
        # ******************************
        # *** Div 16 
        # ******************************
        jvarga[7] = z - 12 * (int) (z / 12) 
        z = math.floor(x0 * 6.0 / 30 + 1)
        # ******************************
        # *** Div 6 
        # ******************************
        jvarga[8] = z - 12 * (int) (z / 12) 
        z = math.floor(x0 * 8.0 / 30 + 1)
        # ******************************
        # *** Div 8 
        # ******************************
        jvarga[9] = z - 12 * (int) (z / 12) 
        r = (math.floor(self.measureRasi(x0) / 7.5) * 90 \
             + self.getRasi(x0) * 30 + \
             self.measureRasi(4 * x0))
        z = math.floor(r / 30 + 1)
        # ******************************
        # *** Div 4 
        # ******************************
        jvarga[10] = z - 12 * (int) (z / 12) 
        z = math.floor(x0 * 20.0 / 30 + 1)
        # ******************************
        # *** Div 20 
        # ******************************
        jvarga[11] = z - 12 * (int) (z / 12) 
        r = math.floor(x0 * 24.0 / 30 + 1)
        if (q % 2 == 0) :  m = 4
        else: m = 3
        z = r + m
        # ******************************
        # *** Div 24 
        # ******************************
        jvarga[12] = z - 12 * (int) (z / 12) 
        z = math.floor(x0 * 27.0 / 30 + 1)
        # ******************************
        # *** Div 27 
        # ******************************
        jvarga[13] = z - 12 * (int) (z / 12) 
        basepos = self.measureRasi(x0) * 40
        if (self.isOddRasi(x0) == 1): self.ret = basepos
        else:  self.ret = basepos + 180
        z = math.floor(self.ret / 30 + 1)
        # ******************************
        # *** Div 40 
        # ******************************
        jvarga[14] = z - 12 * (int) (z / 12) 
        basepos = self.measureRasi(x0) * 45
        if (self.inMovableSign(x0)) : self.ret = basepos
        elif (self.inFixedSign(x0)) : self.ret = basepos + 120
        else : self.ret = basepos + 240
        z = math.floor(self.ret / 30 + 1)
        # ******************************
        # *** Div 45 
        # ******************************
        jvarga[15] = z - 12 * (int) (z / 12) 
        rs = self.measureRasi(x0)
        if (self.isOddRasi(x0) == 1) :
            # Ar, Aq, Sa, Ge, Li
            if (rs < 5) : self.ret = 30 * ARIES + rs * 6
            elif ((rs >= 5) and (rs <= 10)) : 
                self.ret = 30 * AQUARIUS + (rs - 5) * 6
            elif ((rs >= 10) and (rs <= 18)) : 
                self.ret = 30 * SAGITTARIUS + (rs - 10) / 4 * 15
            elif ((rs >= 18) and (rs <= 25)) : 
                self.ret = 30 * GEMINI + (rs - 18) / 7 * 30
            elif (rs > 25) : self.ret = 30 * LIBRA + (rs - 25) * 6
        else :
            # Ta, Vi, Pi, Cp, Sc
            if (rs < 5) : self.ret = 30 * TAURUS + (5 - rs) * 6
            elif ((rs >= 5) and (rs <= 10)) : 
                self.ret = 30 * VIRGO + (10 - rs) * 6
            elif ((rs >= 10) and (rs <= 18)) : 
                self.ret = 30 * PISCES + (18 - rs) / 4 * 15
            elif ((rs >= 18) and (rs <= 25)) : 
                self.ret = 30 * CAPRICORNUS + (25 - rs) / 7 * 30
            elif (rs > 25) : self.ret = 30 * SCORPIO + (30 - rs) * 6
        # end if
        z = math.floor(self.ret / 30 + 1)
        # ******************************
        # *** Div 30 Trimsamsa 
        # ******************************
        jvarga[16] = z - 12 * (int) (z / 12) 

        self.ret = math.floor(60 * self.fractionReal(x0 / 30))
        z = q + self.ret
        # ******************************
        # *** Div 60 Sastiamsa 
        # ******************************
        jvarga[17] = z - 12 * (int) (z / 12) 
        for i in range(1, 17) :
            if (jvarga[i] == 0) : jvarga[i] = 12
        # end for

        for i in range(1, 17) :
            self.globvarga[t][i - 1] = jvarga[i]
        # end for
        return
    # UNDEF computeDivisionalVargas

    # DEF measureRasi
    def measureRasi(self, degs) :
        return (float) (self.reduceDegrees(degs, 30))
    # UNDEF measureRasi

    # DEF IsOddRasi
    def isOddRasi(self, len) :
        return (int) (self.getRasi(len + 30) % 2)
    # UNDEF IsOddRasi

    # DEF reduce Degrees
    def reduceDegrees(self, x, a) :
        return (float) (x - math.floor(x / a) * a)
    # UNDEF reduce Degrees

    # DEF get Rasi
    def getRasi(self, degs) :
        return ((int) (self.reduceToManageableDegs(degs) / 30))
    # UNDEF get Rasi

    # DEF reduceToManageableDegs
    def reduceToManageableDegs(self, degs) :
        return (float) (self.reduceDegrees(degs, 360))
    # UNDEF reduceToManageableDegs

    # DEF inMovableSign
    def inMovableSign(self, degs) :
        return (self.getRasi(degs) % 3) == 0
    # DEF inMovableSign

    # DEF inFixedSign
    def inFixedSign(self, degs) :
        return (self.getRasi(degs) % 3) == 1
    # DEF inFixedSign

    # DEF degreeDifference
    def degreeDifference(self, degree1, degree2) :
        diff = 0.0
        if (degree2 >= degree1) :
            diff = degree2 - degree1
            if (diff > 180) : diff = 360 + degree1 - degree2
        else :
            diff = degree1 - degree2
            if (diff > 180) : diff = 360 + degree2 - degree1
        # end if
        return diff
    # UNDEF degreeDifference

    # DEF calcSaptaVarga
    def calcSaptaVarga(self) :
        self.globLagnaDeg = self.genHouse[0]
        self.computeDivisionalVargas('Lagna', self.genHouse[0], 0)
        self.computeDivisionalVargas('Sun', self.plnt[1], 1)
        self.computeDivisionalVargas('Mercury', self.plnt[2], 2)
        self.computeDivisionalVargas('Venus', self.plnt[3], 3)
        self.computeDivisionalVargas('Mars', self.plnt[4], 4)
        self.computeDivisionalVargas('Jupiter', self.plnt[5], 5)
        self.computeDivisionalVargas('Saturn', self.plnt[6], 6)
        self.computeDivisionalVargas('Moon', self.plnt[7], 7)
        self.computeDivisionalVargas('Rahu', self.plnt[8], 8)
        self.computeDivisionalVargas('Ketu', self.plnt[9], 9)
        self.computeDivisionalVargas('Uranus', self.plnt[10], 10)
        self.computeDivisionalVargas('Neptune', self.plnt[11], 11)
        self.computeDivisionalVargas('Pluto', self.plnt[12], 12)

        self.globCrudeDegrees[0][0] = self.genHouse[0] # Ascendant
        for i in range(1, 12) :
            self.globCrudeDegrees[i][0] = self.plnt[i]

        for i in range(0, 12) :
            for j in range(1, 12) :
                self.globCrudeDegrees[i][j] = \
                self.degreeDifference(self.globCrudeDegrees[i][0],  \
                                      self.globCrudeDegrees[j][0])
            # end for
        # end for
        return
    # UNDEF calcSaptaVarga

    # DEF void ashtakCompute
    def ashtakCompute(self, a, b, c, d, e, f, 
            g, h, i, j, k, l, n) :
        p = 0
        q = 0
        k2 = [0.0]*13

        k2[1] = a ; k2[2] = b ; k2[3] = c ; k2[4] = d ; k2[5] = e ; k2[6] = f
        k2[7] = g ; k2[8] = h ; k2[9] = i ; k2[10] = j ; k2[11] = k ; k2[12] = l
        for q in range (1, 12) :
            p = n + q - 1
            if (p > 12) : p = p - 12
            self.ashtakr3[int(p)] = self.ashtakr3[int(p)] + k2[q]
        # end for
        return
    # UNDEF ashtakCompute

    # DEF ashtakSet
    def ashtakSet(self) :
        for i in range(1, 12) :
            self.globashtak[i - 1][self.staticrj] = self.ashtakr3[i]
        # end for
        self.staticrj = self.staticrj + 1
        return
    # UNDEF ashtakSet

    # DEF ashtakAccumulate
    def ashtakAccumulate(self) :
        for q in range (1, 12) :
            self.s3[q] = self.s3[q] + self.ashtakr3[q]
            self.ashtakr3[q] = 0
        # end for
        return
    # UNDEF ashtakAccumulate

    # DEF findAshtakVarga
    def findAshtakVarga(self) :
        csun = math.floor(self.plnt[1] / 30 + 1)
        dmoon = math.floor(self.plnt[7] / 30 + 1)
        emars = math.floor(self.plnt[4] / 30 + 1)
        fmercury = math.floor(self.plnt[2] / 30 + 1)
        gjupiter = math.floor(self.plnt[5] / 30 + 1)
        hvenus = math.floor(self.plnt[3] / 30 + 1)
        isaturn = math.floor(self.plnt[6] / 30 + 1)
        jlagna = math.floor(self.genHouse[0] / 30 + 1)
        for q in range(1, 12) : self.s3[q] = 0 # end for

        # Rules for Bindu / Rekha for Sun / Surya
        self.ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,csun)
        self.ashtakCompute(0,0,1,0,0,1,0,0,0,1,1,0,dmoon)
        self.ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,emars)
        self.ashtakCompute(0,0,1,0,1,1,0,0,1,1,1,1,fmercury)
        self.ashtakCompute(0,0,0,0,1,1,0,0,1,0,1,0,gjupiter)
        self.ashtakCompute(0,0,0,0,0,1,1,0,0,0,0,1,hvenus)
        self.ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,isaturn)
        self.ashtakCompute(0,0,1,1,0,1,0,0,0,1,1,1,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()

        # Next is Moon or Chandra
        self.ashtakCompute(0,0,1,0,0,1,1,1,0,1,1,0,csun)
        self.ashtakCompute(1,0,1,0,0,1,1,0,0,1,1,0,dmoon)
        self.ashtakCompute(0,1,1,0,1,1,0,0,1,1,1,0,emars)
        self.ashtakCompute(1,0,1,1,1,0,1,1,0,1,1,0,fmercury)
        self.ashtakCompute(1,0,0,1,0,0,1,1,0,1,1,1,gjupiter)
        self.ashtakCompute(0,0,1,1,1,0,1,0,1,1,1,0,hvenus)
        self.ashtakCompute(0,0,1,0,1,1,0,0,0,0,1,0,isaturn)
        self.ashtakCompute(0,0,1,0,0,1,0,0,0,1,1,0,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()

        # Mars
        self.ashtakCompute(0,0,1,0,1,1,0,0,0,1,1,0,csun)
        self.ashtakCompute(0,0,1,0,0,1,0,0,0,0,1,0,dmoon)
        self.ashtakCompute(1,1,0,1,0,0,1,1,0,1,1,0,emars)
        self.ashtakCompute(0,0,1,0,1,1,0,0,0,0,1,0,fmercury)
        self.ashtakCompute(0,0,0,0,0,1,0,0,0,1,1,1,gjupiter)
        self.ashtakCompute(0,0,0,0,0,1,0,1,0,0,1,1,hvenus)
        self.ashtakCompute(1,0,0,1,0,0,1,1,1,1,1,0,isaturn)
        self.ashtakCompute(1,0,1,0,0,1,0,0,0,1,1,0,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()

        # Mercury
        self.ashtakCompute(0,0,0,0,1,1,0,0,1,0,1,1,csun)
        self.ashtakCompute(0,1,0,1,0,1,0,1,0,1,1,0,dmoon)
        self.ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,emars)
        self.ashtakCompute(1,0,1,0,1,1,0,0,1,1,1,1,fmercury)
        self.ashtakCompute(0,0,0,0,0,1,0,1,0,0,1,1,gjupiter)
        self.ashtakCompute(1,1,1,1,1,0,0,1,1,0,1,0,hvenus)
        self.ashtakCompute(1,1,0,1,0,0,1,1,1,1,1,0,isaturn)
        self.ashtakCompute(1,1,0,1,0,1,0,1,0,1,1,0,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()

        # Jupiter
        self.ashtakCompute(1,1,1,1,0,0,1,1,1,1,1,0,csun)
        self.ashtakCompute(0,1,0,0,1,0,1,0,1,0,1,0,dmoon)
        self.ashtakCompute(1,1,0,1,0,0,1,1,0,1,1,0,emars)
        self.ashtakCompute(1,1,0,1,1,1,0,0,1,1,1,0,fmercury)
        self.ashtakCompute(1,1,1,1,0,0,1,1,0,1,1,0,gjupiter)
        self.ashtakCompute(0,1,0,0,1,1,0,0,1,1,1,0,hvenus)
        self.ashtakCompute(0,0,1,0,1,1,0,0,0,0,0,1,isaturn)
        self.ashtakCompute(1,1,0,1,1,1,1,0,1,1,1,0,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()

        # Venus
        self.ashtakCompute(0,0,0,0,0,0,0,1,0,0,1,1,csun)
        self.ashtakCompute(1,1,1,1,1,0,0,1,1,0,1,1,dmoon)
        self.ashtakCompute(0,0,1,0,1,1,0,0,1,0,1,1,emars)
        self.ashtakCompute(0,0,1,0,1,1,0,0,1,0,1,0,fmercury)
        self.ashtakCompute(0,0,0,0,1,0,0,1,1,1,1,0,gjupiter)
        self.ashtakCompute(1,1,1,1,1,0,0,1,1,1,1,0,hvenus)
        self.ashtakCompute(0,0,1,1,1,0,0,1,1,1,1,0,isaturn)
        self.ashtakCompute(1,1,1,1,1,0,0,1,1,0,1,0,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()

        # Saturn
        self.ashtakCompute(1,1,0,1,0,0,1,1,0,1,1,0,csun)
        self.ashtakCompute(0,0,1,0,0,1,0,0,0,0,1,0,dmoon)
        self.ashtakCompute(0,0,1,0,1,1,0,0,0,1,1,1,emars)
        self.ashtakCompute(0,0,0,0,0,1,0,1,1,1,1,1,fmercury)
        self.ashtakCompute(0,0,0,0,1,1,0,0,0,0,1,1,gjupiter)
        self.ashtakCompute(0,0,0,0,0,1,0,0,0,0,1,1,hvenus)
        self.ashtakCompute(0,0,1,0,1,1,0,0,0,0,1,0,isaturn)
        self.ashtakCompute(1,0,1,1,0,1,0,0,0,1,1,0,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()

        # Extending the Ashtak Varga
        # to include Ascendant
        # and Dragons Head - Rahu
        # ========================
        # Ascendant / Lagna
        self.ashtakCompute(0,0,1,1,0,1,0,0,0,1,1,1,csun)
        self.ashtakCompute(0,0,1,0,0,1,0,0,0,1,1,1,dmoon)
        self.ashtakCompute(1,0,1,0,1,0,0,0,0,1,1,0,emars)
        self.ashtakCompute(1,1,0,1,0,1,0,1,0,1,1,0,fmercury)
        self.ashtakCompute(1,1,0,1,1,1,1,0,1,1,1,0,gjupiter)
        self.ashtakCompute(1,1,1,1,1,0,0,1,1,0,0,0,hvenus)
        self.ashtakCompute(1,0,1,1,0,1,0,0,0,1,1,0,isaturn)
        self.ashtakCompute(0,0,1,0,0,1,0,0,0,1,1,0,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()

        # Dragons Head - Rahu
        self.ashtakCompute(1,1,1,1,0,0,1,1,0,1,0,0,csun)
        self.ashtakCompute(1,0,1,0,1,0,1,1,1,1,0,0,dmoon)
        self.ashtakCompute(0,1,1,0,1,0,0,0,0,0,0,1,emars)
        self.ashtakCompute(0,1,0,1,0,0,1,1,0,0,0,1,fmercury)
        self.ashtakCompute(1,0,1,1,0,1,0,1,0,0,0,0,gjupiter)
        self.ashtakCompute(0,0,0,0,0,1,1,0,0,0,1,1,hvenus)
        self.ashtakCompute(0,0,1,0,1,0,1,0,0,1,1,1,isaturn)
        self.ashtakCompute(0,0,1,1,1,0,0,0,1,0,0,1,jlagna)
        self.ashtakSet()
        self.ashtakAccumulate()
        return
    # UNDEF findAshtakVarga

    # DEF doGeneral
    def doGeneral(self) :
        tithi = (self.plnt[7] - self.plnt[1]) / 12
        if (tithi < 0.00) : tithi = tithi + 30.0
        self.tt[0] = tithi
        nakshatra = self.plnt[7] * 3 / 40
        self.tt[1] = nakshatra
        part = math.floor(4 * self.fractionReal(self.tt[1]) + 1)
        yoga = (self.plnt[7] + self.plnt[1]) * 3 / 40
        if (yoga > 27.0) : yoga = yoga - 27
        self.tt[2] = yoga

        ti = math.floor(self.tt[0]) + 1
        if (ti == 30) : ti = 15
        else : ti = (ti % 15) - 1
        if (ti == -1) : ti = 14
        na = math.floor(self.tt[1])
        yo = math.floor(self.tt[2])
        rasi = self.plnt[7] / 30
        ra = math.floor(rasi)
        self.tt[3] = rasi

        # setting some of the return values
        self.globTithi = self.jc.tit[int(math.floor(tithi))]
        self.globLunarDate = self.jc.moonPhase[int(math.floor(tithi))]
        if (tithi < 15) : 
            self.globPaksha = 'Sukla Waxing' + '%2d' \
            % (math.floor(tithi) + 1.0)
        else : 
            self.globPaksha = 'Krishna Waning'+'%2d' \
            % (math.floor(tithi) + 1.0)

        self.globLunarDay = (int) (math.floor(tithi) + 1.0)

        self.globNakshatra = self.jc.nak[int(na)]
        self.globNakshatra_No = na
        self.globNakshatra_Pada = part
        self.globNakshatra_Lord = self.jc.naklords[int(na)]
        self.globDasaBorn = self.jc.naklords[int(na)]
        self.globYoga = self.jc.yog[int(yo)]
        self.globRashi = self.jc.zsigns[int(ra)]
        return
    # UNDEF doGeneral

    # DEF perturbGrahas
    def perturbGrahas(self) :
        strRetro = ''
        # for i
        for i in range(1,12) :
            aa = self.plnt[i]
            a = math.floor(aa / 30 + 1)
            b = math.floor(aa * 3 / 40)
            c = math.floor(4 * self.fractionReal(aa * 3.0 / 40) + 1)
            bb = self.plnt[i + 13]
            # Direct or 
            # Retrograde
            if (bb < aa) : strRetro = 'Ret'
            else : strRetro = 'Dir'
            # DIGNITY
            # IOWNHOUSE, IEXALT, IMT, IDETRI, IFALL
            zwhtype = 0 

            # Break raw degrees into
            # degs, mins and secs
            degrees = aa - ((a - 1) * 30)
            mins = (degrees - (int) (degrees)) * 60
            secs = (mins - (int) (mins)) * 60

            self.globPlanetPos[i][9] = 'Unk'
            self.globPlanetPos[i][10] = 'Unk'
            self.globPlanetPos[i][11] = 'Unk'

            # Placidus - House Start
            self.globchalit[0][i - 1] = i
            self.globchalit[1][i - 1] = aa

            # Imp string return
            self.globPlanetPos[i][1] = self.jc.graha[i]
            # Longitude
            self.globPlanetPos[i][2] = '{:6.2f}'.format(degrees) 
            # Rasi
            self.globPlanetPos[i][3] = self.jc.ras[int(a - 1)]
            # Sign No
            self.globPlanetPos[i][4] = '{:2d}'.format(int(a)) 
            # Zodiac Sign
            self.globPlanetPos[i][5] = self.jc.zsigns[int(a - 1)] 
            # Dignity
            self.globPlanetPos[i][6] = '{:2d}'.format(zwhtype) 
            # Nakshatra
            self.globPlanetPos[i][7] = self.jc.nak[int(b)] 
            # Direct or retrograde
            self.globPlanetPos[i][8] = strRetro 
            # Nakshatra No
            self.globPlanetPos[i][12] = '{:2d}'.format(int(b)) 
            # Nakshatra pada
            self.globPlanetPos[i][13] = '{:1d}'.format(int(c)) 
        # end for i
        return
    # UNDEF perturbGrahas

    # DEF calculateVargas
    def calculateVargas(self, m) :
        self.globLagna = \
            self.jc.zsigns[int(self.globvarga[0][0] - 1)]
        self.globLagnaNum = self.globvarga[0][0]
        if self.globvarga[0][0] - 1 ==  0: # : Mesha / Aries 
            self.globLagnaLord = 'Mars'
        elif self.globvarga[0][0] - 1 == 1: # : Vrishaba 
            self.globLagnaLord = 'Venus'
        elif self.globvarga[0][0] - 1 ==  2: # : Mithuna 
            self.globLagnaLord = 'Mercury'
        elif self.globvarga[0][0] - 1 == 3: # : Karkata 
            self.globLagnaLord = 'Moon'
        elif self.globvarga[0][0] - 1 == 4: # : Simha 
            self.globLagnaLord = 'Sun'
        elif self.globvarga[0][0] - 1 == 5: # : Kanya 
            self.globLagnaLord = 'Mercury'
        elif self.globvarga[0][0] - 1 == 6: # : Tula 
            self.globLagnaLord = 'Venus'
        elif self.globvarga[0][0] - 1 == 7: # : Vrischika 
            self.globLagnaLord = 'Mars'
        elif self.globvarga[0][0] - 1 == 8: # : Dhanu 
            self.globLagnaLord = 'Jupiter'
        elif self.globvarga[0][0] - 1 == 9: # : Makara 
            self.globLagnaLord = 'Saturn'
        elif self.globvarga[0][0] - 1 == 10: # : Kumbha 
            self.globLagnaLord = 'Saturn'
        else : # : Meena 
            self.globLagnaLord = 'Jupiter'

        for i in range(0, 12) :
            s = self.globvarga[i][m]
            r = 0
            if (s < 4) : r = s + 1
            elif (s < 7) : r = (s - 2) * 4
            elif (s < 10) : r = 22 - s
            else : r = (12 - s) * 4 + 1
            p = math.floor((r - 1) / 4 + 1)
            q = r - (p - 1) * 4
            u = math.floor((p - 1) * 8 + 2 + i / 2)
            v = (q - 1) * 2 + i % 2
        # end for

        for i in range(0, 12) :
            s = self.globvarga[i][m]
            r = 0
            if (s < 4) : r = s + 1
            elif (s < 7) : r = (s - 2) * 4
            elif (s < 10) : r = 22 - s
            else : r = (12 - s) * 4 + 1
            p = math.floor((r - 1) / 4 + 1)
            q = r - (p - 1) * 4
            u = math.floor((p - 1) * 8 + 2 + i / 2)
            v = (q - 1) * 2 + i % 2
            if (i < 13) :
                if m == 0 :
                    self.globRashiGeneral[i + 1][1] = self.jc.graha[i]
                    self.globRashiGeneral[i + 1][2] = '%-2d' % (s)
                # end if
            # end if
        # end for
        return
    # UNDEF calculateVargas

    # DEF Ayanamsa Calculation
    def calcAyanamsa(self) :
        # Universal Ayanamsa
        self.plnt[0] = 22.460148 + 1.396042 * self.julianCent \
            + 3.08e-4 * self.julianCent * self.julianCent
        return
    # UNDEF Ayanamsa Calculation

    # DEF Krishnamurty Ayanamsa
    def findKP(self) :
        n_aya = 23 + ((self.y - 1938) \
                * 50.289999999999999) / 3600
        self.plnt[0] = n_aya
        return
    # UNDEF Krishnamurty Ayanamsa
    
    # DEF Lahiri Ayanamsa
    def findLahiriCorr(self) :
        # Correction for N.C. Lahiri 
        # instead of 285 / 291 days.
        n_aya = ((self.y - 291) * 50.2388475) / 3600
        self.plnt[0] = n_aya
        return
    # UNDEF Lahiri Ayanamsa

    # DEF Raman Ayanamsa
    # B.V. Ramans method
    def findRaman(self) :
        ramaya = 21.013972 + 1.398191 * self.julianCent
        self.plnt[0] = ramaya
        return
    # UNDEF Raman Ayanamsa

   
# UnClass Jotiz        