'''
Created on Feb 3, 2017

@author: devbhattacharyya
'''

import logging
from flask import Flask
from flask.helpers import make_response
from flask_restful import Resource, Api
from core.jotiz import Jotiz
from core.jconstant import JConstant
import math
import json
from datetime import date
from json import JSONEncoder


app = Flask(__name__)
api = Api(app)

@app.errorhandler(404)
def server_error(e):
    # Log the error and stacktrace.
    logging.exception('An error occurred during a request.')
    return 'Jotiz Astrology Application: An internal error occurred.', 404


@app.route('/api/naksya/')
class NaksyaCore(Resource):
    def get(self, appid):
        resp = self.doJotiz()
        # print (resp)
        return resp

    def doJotiz(self):
        j = Jotiz()
        jc = JConstant()
        b_year = 1959
        b_month = 11
        b_day = 12
        b_hour = 13
        b_min = 21
        b_latitude = 22.5726
        b_longitude = 88.3639
        b_timezone = 5.5
        b_dst = 0
        j.setvalues(b_year, b_month, b_day, b_hour, b_min, 
            b_latitude, b_longitude, b_timezone, b_dst)
        b_ayantype = 0
        b_ayanvalue = 0
        j.runCalculations(b_ayantype, b_ayanvalue)
        d2 = 13.33333333333333
        d1 = 3.333333333333333
        ascdegs = j.globLagnaDeg
        ascSign = int(ascdegs / 30.0)
        ascnak = int(ascdegs / d2)
        ascpada = int(ascdegs / d1) % 4 + 1
        retval = [{}]*10
        retval[0] = {'ayanamsa': '%-8.3f' % j.plnt[0], 
            'ascendant': '%s' % jc.zsigns[ascSign],
            'longitude': '%-8.3f' % j.globLagnaDeg,
            'degs': '%-3.3f' % (j.globLagnaDeg - (math.floor(j.globLagnaDeg / 30)*30)),
            'nakno': '%2d' % (ascnak + 1),
            'naklord': '%s' % jc.naklords[ascnak],
            'naksymbol': '%s' % jc.naksymbol[ascnak],
            'nakdeity': '%s' % jc.nakdeity[ascnak],
            'nakgana': '%s' % jc.ganaA[ascnak],                        
            'nakyoni': '%s' % jc.yoniA[ascnak],
            'naknadi': '%s' % jc.nadiA[ascnak],                                                            
            'nakrajju': '%s' % jc.rajjuA[ascnak],                                                            
            'naksya': '%s' % jc.nak[ascnak]}
        # print plnt values
        for i in range (1, 10):
            plntSign = int(j.plnt[i] / 30.0)
            plntnak = int(j.plnt[i] / d2)
            retval[i] = {'%s' % jc.planet[i]: '%s' % jc.zsigns[plntSign],
                'longitude': '%-8.3f' % j.plnt[i],
                'degrees': '%-3.3f' % (j.plnt[i] - (math.floor(j.plnt[i] / 30)*30)),
                'nakno': '%2d' % (plntnak + 1),
                'naklord': '%s' % jc.naklords[plntnak],
                'naksymbol': '%s' % jc.naksymbol[plntnak],
                'nakdeity': '%s' % jc.nakdeity[plntnak],                
                'nakgana': '%s' % jc.ganaA[plntnak],                        
                'nakyoni': '%s' % jc.yoniA[plntnak],                        
                'naknadi': '%s' % jc.nadiA[plntnak],                                                            
                'nakrajju': '%s' % jc.rajjuA[plntnak],                                                            
                'naksya': '%s' % jc.nak[plntnak]}
        return retval

@app.route('/api/naksyamain/')
class NaksyaMain(Resource):
    def get(self, appid):
        return {'hello': 'naksya main world'+appid}
    def post(self, appid):
        return {'hello': 'naksya main world'+appid}
    
api.add_resource(NaksyaCore, '/api/naksya/<string:appid>')
api.add_resource(NaksyaMain, '/api/naksyamain/<string:appid>')

def mortgage_json_handler(x):
    if isinstance(x, date):
        return x.isoformat()
    if isinstance(x, Jotiz):
        return x.__dict__

if __name__ == '__main__':
    app.run(debug=True)