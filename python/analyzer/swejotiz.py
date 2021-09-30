'''
swejotiz.py
'''
import swisseph as swe
import datetime
swe.set_ephe_path('/Users/devbhattacharyya/Downloads/nodejs/swisseph2_7/ephe') # set path to ephemeris files
import json

# def
def checkNak(value_to_check, y):
    max_rank = len(y)
    for ii in range(len(y)-1,0,-1):
        if (y[ii] >= value_to_check >= y[ii-1]) or (y[ii] <= value_to_check <= y[ii-1]):
            max_rank = ii
            break
    return max_rank - 1
# undef

# def
def makeDict(dstr, dlong, dret, asc):
    d2 = 13.3333333333
    d1 = 3.33333333333
    kret = 'R'
    if dret < 0:
        kret = 'R'
    else:
        kret = 'D'
    # print ('debug', dstr, dlong, kret)
    gra = {
        #'gr':dstr, 
        'lng': '{:06.2f}'.format(dlong),
        'ret': kret,
        'sign': '{:d}'.format(getSign(dlong)),
        'hse': '{:d}'.format(getHouse(dlong, asc)),
        'nav': '{:d}'.format(getNavamsa(dlong)),
        'n28': '{:d}'.format(checkNak(dlong, nakdegs)),
        'nak28': '{}'.format(naks28[checkNak(dlong, nakdegs)]),
        'n27': '{:d}'.format(int(dlong/d2)),
        'nak27': '{}'.format(naks27[int(dlong/d2)]),
        'npad': '{:1d}'.format(int(dlong / d1) % 4 + 1),
        'nlord': '{}'.format(naklords[int(dlong/d2)])
        }
    return gra
# undef

# def
def getSign(dlong):
    return int(dlong / 30.0) + 1
# undef

# def
def getNavamsa(dlong):
    nvm = int(dlong / 3.333333) % 12 + 1
    if nvm == 0:
        nvm = 12
    return nvm
# undef

# def
def getHouse(dlong, asc):
    sgn = getSign(dlong)
    diff = sgn - asc + 1
    if diff > 12:
        diff = 12 - diff + 1
    elif diff < 0:
        diff = 12 + diff
    elif diff == 0:
        diff = 12
    return diff
# undef


'''
Runtime stuff
'''

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

nakdegs = [0, 13.00, 25.99, 38.99, 58.48, 71.48, 77.98, 97.47, 110.47, 123.47, 136.46, 149.46,
168.95, 181.95, 194.95, 201.44, 220.94, 233.94, 240.43, 253.43, 259.93, 279.42, 282.02,
295.02, 308.01, 314.51, 327.51, 347.00, 360.00]

# def
def computeAstro(yy, mm, dd, hr, mi, tz, lng, lat):

    swe.set_topo(lng, lat, 0)
    dob = datetime.datetime(yy, mm, dd)
    u = swe.utc_time_zone(yy, mm, dd, hr, mi, 0, tz) # minu
    weekday = dob.strftime("%w")
    jdt = swe.utc_to_jd(u[0], u[1], u[2], u[3], u[4], u[5], swe.GREG_CAL)

    jd = jdt[1]

    # --- set lahiri ayanamsa
    swe.set_sid_mode(swe.SIDM_LAHIRI, 0, 0)
    houses = swe.houses_ex(jd, lat, lng, b'I', swe.FLG_SIDEREAL)
    lag = houses[0]

    # get the computed results
    aya = swe.get_ayanamsa(jd)
    sun = swe.calc_ut(jd, swe.SUN, flag)
    moo = swe.calc_ut(jd, swe.MOON, flag)
    mer = swe.calc_ut(jd, swe.MERCURY, flag)
    ven = swe.calc_ut(jd, swe.VENUS, flag)
    mar = swe.calc_ut(jd, swe.MARS, flag)
    jup = swe.calc_ut(jd, swe.JUPITER, flag)
    sat = swe.calc_ut(jd, swe.SATURN, flag)
    rah = swe.calc_ut(jd, swe.MEAN_NODE, flag)
    # ketu is calculated from rahu
    kl = rah[0][0] + 180.0
    if kl > 360: 
        kl -= 360
    ket = kl
    # remaining grahas
    ura = swe.calc_ut(jd, swe.URANUS, flag)
    nep = swe.calc_ut(jd, swe.NEPTUNE, flag)
    plu = swe.calc_ut(jd, swe.PLUTO, flag)
    # asteroids
    chi = swe.calc_ut(jd, swe.CHIRON, flag)
    pho = swe.calc_ut(jd, swe.PHOLUS, flag)
    cer = swe.calc_ut(jd, swe.CERES, flag)
    pal = swe.calc_ut(jd, swe.PALLAS, flag)
    jun = swe.calc_ut(jd, swe.JUNO, flag)
    ves = swe.calc_ut(jd, swe.VESTA, flag)

    asc = getSign(lag[0])
    # print (getSign(sun[0][0]))
    lagd = swe.split_deg(houses[0][0], flag)
    sund = swe.split_deg(sun[0][0], flag)
        
    # print (json.dumps(houses))
    # print ('sun', sun[0][0], sun[0][3])
    # print ('rah', rah[0][0], rah[0][3])
    # print (lagd)
    # print (sund)
    
    dlag = makeDict ('lag', lag[0], 1, asc)
    dsun = makeDict ('sun', sun[0][0], 1, asc)
    dmoo = makeDict ('moo', moo[0][0], 1, asc)
    dmar = makeDict ('mar', mar[0][0], mar[0][3], asc)
    dven = makeDict ('ven', ven[0][0], ven[0][3], asc)
    dmer = makeDict ('mer', mer[0][0], mer[0][3], asc)
    djup = makeDict ('jup', jup[0][0], jup[0][3], asc)
    dsat = makeDict ('sat', sat[0][0], sat[0][3], asc)
    drah = makeDict ('rah', rah[0][0], rah[0][3], asc)
    dket = makeDict ('ket', ket, rah[0][3], asc)

    dura = makeDict ('ura', ura[0][0], ura[0][3], asc)
    dnep = makeDict ('nep', nep[0][0], nep[0][3], asc)
    dplu = makeDict ('plu', plu[0][0], plu[0][3], asc)

    dchi = makeDict ('chi', chi[0][0], chi[0][3], asc)
    dpho = makeDict ('pho', pho[0][0], pho[0][3], asc)
    dcer = makeDict ('cer', cer[0][0], cer[0][3], asc)
    dpal = makeDict ('pal', pal[0][0], pal[0][3], asc)
    djun = makeDict ('jun', jun[0][0], jun[0][3], asc)
    dves = makeDict ('ves', ves[0][0], ves[0][3], asc)

    return dlag, dsun, dmoo, dmer, dmar, dven, djup, dsat, drah, dket, \
        dura, dnep, dplu, \
        dchi, dpho, dcer, dpal, djun, dves
# undef

'''
Main Program
'''

flag = swe.FLG_SPEED + swe.FLG_SWIEPH + swe.FLG_SIDEREAL # + swe.FLG_TOPOCTR

# computeAstro(1959, 11, 12, 13, 30, +5.5, 88.3639, 22.5726, False)

'''
# native longitude, latitude
lng = 88.3639 # kolkata
lat = 22.5726 # kolkata

# transit longitude, latitude
lngt = -73.98661 # nyc
latt = 40.73065

# lng = 77.20227 # new delhi
# lat = 28.61418

# lat = 39.9500 # philly
# lng = -75.1667 # philly

# lng = 80.26726 # sripuram
# lat = 13.04520 # sripuram

# lng = 87.66016 # ramakrishna
# lat = 22.89546

# lng = 77.81250 # satya sai baba
# lat = 14.16368

# lng = -73.98661 # donald trump
# lat = 40.73065

# u = swe.utc_time_zone(1959, 11, 12, 13, 30, 0, 5.5) # minu
# u = swe.utc_time_zone(1962, 11, 11, 7, 20, 0, 5.5) # mithoo
# u = swe.utc_time_zone(1988, 10, 3, 21, 35, 0, 5.5) # dea
# u = swe.utc_time_zone(2008, 2, 14, 21, 6, 0, -5.0) # kam
# u = swe.utc_time_zone(1990, 6, 24, 16, 30, 0, 5.5) # sonne
# u = swe.utc_time_zone(1976, 1, 3, 8, 0, 0, 5.5) # amma
# u = swe.utc_time_zone(1960, 7, 15, 12, 40, 0, 5.5) # p talwar
# u = swe.utc_time_zone(1863, 1, 12, 6, 20, 0, 5.5) # vivekananda
# u = swe.utc_time_zone(1836, 2, 13, 22, 20, 0, 5.5) # ramakrishna
# u = swe.utc_time_zone(1926, 11, 23, 11, 0, 0, 5.5) # satya sai baba
# u = swe.utc_time_zone(1946, 6, 14, 10, 54, 0, -5.0) # donald trump

# --- debug ---
# print('u', u) 
'''

# help(swe)