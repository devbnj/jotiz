'''
Created on Feb 2, 2017

@author: devbhattacharyya
'''

class JConstant(object):
    '''
    classdocs
    '''


    def __init__(self):
        '''
        Constructor
        '''
        self.lordship = [-1, 4, 3, 2, 7, 1, 2, 3, 4, 5, 6, 6, 5]
        self.exalt = [-1, 1, 7, 8, 5, 11, 2, 6, 10, 9, 4, 12, 3]
        self.debil = [-1, 6, 0, 0, 4, 0, 3, 1, 7, 0, 5, 0, 2]
        self.moolTrik = [4, 7, -1, -1, 1, 2, 3, -1, 5, -1, 6, -1]

        self._LAG = 0
        self._SUN = 1
        self._MER = 2
        self._VEN = 3
        self._MAR = 4
        self._JUP = 5
        self._SAT = 6
        self._MON = 7
        self._RAH = 8
        self._KET = 9
        self._URA = 10
    
        self._SEXTILE = 60
        self._OPPOSITE = 180
        self._SQUARE = 90
        self._CONJUNCT = 0
    
        self.grahas =[self._LAG, self._SUN, self._MER, self._VEN, self._MAR, \
                      self._JUP, self._SAT, self._MON, self._RAH, self._KET]
        self.ritus = ['', 'Greeshma', 'Sarad', 'Vasanta', 'Greeshma', 'Hemanta',\
                       'Sisir', 'Varsha']
        self.ritMonths = ['', 'June-July', 'Oct-Nov', 'Apr-May', 'June-July', \
                          'Dec-Jan', 'Feb-Mar', 'Aug-Sep']
        self.malegrahas = [self._SUN, self._MAR, self._JUP]
        self.femalegrahas = [self._VEN, self._MON]
        
        self._HOUSE0 = 0
        self._HOUSE1 = 1
        self._HOUSE2 = 2
        self._HOUSE3 = 3
        self._HOUSE4 = 4
        self._HOUSE5 = 5
        self._HOUSE6 = 6
        self._HOUSE7 = 7
        self._HOUSE8 = 8
        self._HOUSE9 = 9
        self._HOUSE10 = 10
        self._HOUSE11 = 11
        self._HOUSE12 = 12

        self.houses = [self._HOUSE0, self._HOUSE1, self._HOUSE2, self._HOUSE3,\
                       self._HOUSE4, self._HOUSE5,self._HOUSE6, self._HOUSE7, \
                       self._HOUSE8, self._HOUSE9, self._HOUSE10, \
                       self._HOUSE11, self._HOUSE12]
        
     
        # 0-6 odd, 24-30 even
        self._BALA_AVASTHA = 1 
        # 6-12 odd, 18-24 even
        self._KUMAR_AVASTHA = 2 
        # 12-18 both
        self._YUVA_AVASTHA = 3 
        # 18-24 odd, 6-12 even
        self._VRIDDHA_AVASTHA = 4 
        # 24-30 odd, 0-6 even
        self._MRITYA_AVASTHA = 5 
    
        # constants
        self.graha = [
        "Lagna", "Surya", "Budha", "Shukra", 
        "Mangala", "Guru", "Sani", "Chandra", 
        "Rahu","Ketu", "Uranus", "Neptune", 
        "Pluto"]
        self.planet = [
        "Ascendant", "Sun", "Mercury", "Venus", 
        "Mars", "Jupiter", "Saturn", "Moon", 
        "U-Node","L-Node", "Uranus", "Neptune", 
        "Pluto"]
        # Jyotish Rasi Names
        self.ras = [ 
        "Mesha", "Vrishabha", "Mithuna", "Karkata", 
        "Simha", "Kanya", "Tula", "Vrischika",
        "Dhanu", "Makara", "Kumbha", "Meena" ]
        # Western Signs
        self.zsigns = [ 
        "Aries", "Taurus", "Gemini", "Cancer", 
        "Leo", "Virgo", "Libra", "Scorpio",
        "Sagittarius", "Capricorn", "Aquarius", 
        "Pisces" ]
        # Nakshatra lord sequence repeated three times
        # Yogas
        self.yog = [ 
        "Viskumbha", "Priti", "Ayusman", 
        "Saubhagya", "Sobhana", "Atiganda", 
        "Sukarma", "Dhriti", "Sula", "Ganda", 
        "Vriddhi", "Dhruva", "Vyaghata", 
        "Harshana", "Vajra", "Siddhi", 
        "Vyatipata", "Variyan", "Parigha", 
        "Siva", "Siddha", "Sadhya", "Subha", 
        "Sukla", "Brahma", "Indra", "Vaidhriti" ]
        # Moon Phases
        # Q = Quarter (q1 and q3)
        # Cr = Cresecent
        # Gb = Gibbeous
        self.moonPhase = [ 
        "Waxing 1", "Waxing 2", "Waxing 3", 
        "Waxing 4 (Cr)", "Waxing 5", "Waxing 6", 
        "Waxing 7 (Q1)", "Waxing 8 (Q1)", "Waxing 9", 
        "Waxing 10", "Waxing 11 (Gb)", "Waxing 12", 
        "Waxing 13", "Waxing 14", "Full Moon",
        "Waning 1", "Waning 2", "Waning 3", 
        "Waning 4 (Gb)", "Waning 5", "Waning 6", 
        "Waning 7 (Q3)", "Waning 8 (Q3)", "Waning 9",
        "Waning 10", "Waning 11 (Cr)", "Waning 12", 
        "Waning 13", "Waning 14", "New Moon" ]
        # Jyotish Moon Phases or Tithies
        self.tit = [ 
        "Pratipad", "Dvitiya", "Tritiya", 
        "Chaturthi", "Panchami", "Sashti", "Saptami",
        "Ashtami", "Navami", "Dasami", "Ekadasi", 
        "Dvadasi", "Trayodasi", "Chaturdasi", "Purnima", 
        "Pratipad", "Dvitiya", "Tritiya", "Chaturthi", 
        "Panchami", "Sashti", "Saptami", "Ashtami", 
        "Navami", "Dasami",    "Ekadasi", "Dvadasi", 
        "Trayodasi", "Chaturdasi", "Amavasya" ]
        self.nak2 = [ 
        "Mars", "Mars", "Mars", "Venus", 
        "Venus", "Mercury", "Mercury", 
        "Moon", "Moon",    "Sun", "Sun", 
        "Sun", "Mercury", "Mercury", "Venus", 
        "Venus", "Mars", "Mars", "Jupiter", 
        "Jupiter","Jupiter", "Saturn", 
        "Saturn", "Saturn", "Saturn", 
        "Jupiter", "Jupiter" ]
        # Nakshatra or constellation names
        self.naklords = ["Ketu", "Venus", 
            "Sun", "Moon", "Mars", "Rahu", "Jupiter", "Saturn", 
            "Mercury", "Ketu", "Venus", "Sun", "Moon", 
            "Mars", "Rahu", "Jupiter", "Saturn", "Mercury", "Ketu", 
            "Venus", "Sun", "Moon", "Mars", 
            "Rahu", "Jupiter", "Saturn", "Mercury"]
        self.nakdeity = ["Ashwins", "Yama", 
            "Agni", "Prajapati", "Soma", "Rudra", "Aditi", "Brihaspati", 
            "Sarpa", "Pitri", "Bhaga", "Aryaman", "Savitar", 
            "Tvastar", "Vayu", "Indra+Agni", "Mitra", "Indra", "Nirrti", 
            "Apah", "Visvadevas", "Vishnu", "Vasus", 
            "Varuna", "Ajikapada", "Ahir Budyani", "Pushan"]        
        self.naksymbol = ["Horse's head", "Womb", 
            "Knife or spear", "Chariot, temple, banyan tree", 
            "Deer's head", 
            "Teardrop, diamond, human head", "Bow and quiver", 
            "Cow's udder, lotus, arrow and circle", 
            "Serpent", "Royal throne", 
            "Front legs of a cot, hammock, fig tree", 
            "Front legs of a cot, hammock", "Hand, fist", 
            "Bright jewel, pearl", "Plant shoot, coral", 
            "Triumph arch, potters wheel", "Triumph arch, lotus", 
            "Amulet, umbrella, ear ring", 
            "Roots tied together, elephant goad", 
            "Elephant's tusk, fan, winnow basket", 
            "Elephant's tusk, small bed", 
            "Ear, three foot prints", 
            "Drum or flute", 
            "Empty circle, thousand flowers or stars", 
            "Swords, front legs of funeral cot, snake in water", 
            "Twins, rear legs of funeral cot, snake in water", 
            "Fish, twin fish, drum"]    
        # names of nakshatras
        self.nak = [ 
        "Aswini", "Bharani", "Krittika", 
        "Rohini", "Mrigashira", "Ardra", "Punarvasu",
        "Pushya", "Aslesha", "Magha", "P-Phalguni", 
        "U-Phalguni", "Hastha", "Chitra", "Swati", 
        "Vishakha",    "Anuradha", "Jyestha", "Moola", 
        "P-Ashada", "U-Ashada", "Sravana", "Dhanistha", 
        "S-Bhishag", "P-Bhadra", "U-Bhadra", "Revati" ]
        # nature of the nakshatra - high, mortal, animal
        # or sub mortal
        # deva - deity, nara - human, rakshas - sub human
        self.ganaA = ["Deva", "Nara", "Rakhshas",   # 1
            "Nara", "Deva",                         # 2
            "Nara", "Deva",                         # 3
            "Deva", "Rakhshas",                     # 4
            "Rakhsas", "Nara", "Nara",              # 5 second set
            "Deva", "Rakhsas",                      # 6
            "Deva", "Rakhsas",                      # 7
            "Deva", "Rakhsas",                      # 8
            "Rakhsas", "Nara", "Nara",              # 9 third set
            "Deva", "Rakhsas",                      # 10
            "Rakhsas", "Nara",                      # 11
            "Nara", "Deva"                          # 12
            ]
        # yoni
        self.yoniA = ["Horse", "Elephant", "Sheep", # 1
            "Serpent", "Serpent",                   # 2
            "Dog", "Cat",                           # 3
            "Sheep", "Cat",                         # 4
            "Rat", "Rat", "Cow",                    # 5
            "Buffalo", "Tiger",                     # 6
            "Buffalo", "Tiger",                     # 7
            "Rabbit", "Rabbit",                         # 8
            "Dog", "Monkey", "Mongoose",            # 9
            "Monkey", "Lion",
            "Horse", "Lion",
            "Cow", "Elephant"]
        # nadi or pulse dosha
        self.nadiA = ["Vata", "Pitta", "Kapha",     # 1
            "Kapha", "Pitta",                       # 2
            "Vata", "Vata",                         # 3
            "Pitta", "Kapha",                       # 4
            "Kapha", "Pitta", "Vata",               # 5
            "Vata", "Pitta",                        # 6
            "Kapha", "Kapha",                       # 7
            "Pitta", "Vata",                        # 8
            "Vata", "Pitta", "Kapha",               # 9
            "Kapha", "Pitta",
            "Vata", "Vata",
            "Pitta", "Kapha"]
        # rajju or body part
        # pada - feet
        # kati - limbs
        # nabhi - navel
        # sira - head
        # kanta - speech
        self.rajjuA = ["Pada", "Kati", "Nabhi",     # 1
            "Kanta", "Sira",                        # 2
            "Kanta", "Nabhi",                       # 3
            "Kati", "Pada",                         # 4
            "Pada", "Kati", "Nabhi",                # 5
            "Kanta", "Sira",
            "Kanta", "Nabhi",
            "Kati", "Pada",
            "Pada", "Kati", "Nabhi",
            "Kanta", "Sira",
            "Kanta", "Nabhi",
            "Kati", "Pada"]
        # varna, profession
        # brahmin - teacher, priest, learned
        # kshatriya - warrior, king, policeman, military personnel
        # vaishya - merchant, business-person, corporate
        # shudra - worker, employee, servant
        self.varnaA = ["Kshatriya", "Vaishya", "Sudra", #1
            "Brahmin", "Kshatriya", "Vaishya",          #2
            "Sudra", "Brahmin", "Kshatriya",            #3
            "Vaishya", "Sudra", "Brahmin"]              #4
        # mahantarey, secondary profession
        self.mahantareyA = ["Vaishya", "Sudra", "Vaishya",
            "Brahmin", "Kshatriya", "Sudra",
            "Kshatriya", "Brahmin", "Kshatriya",
            "Sudra", "Vaishya", "Brahmin"]

    # END def
#END Class