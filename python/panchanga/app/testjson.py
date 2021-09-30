import json
from json import JSONEncoder

def default(o):
    return o._asdict()

class User(object):
    def __init__(self, name, mail):
        self.name = name
        self.mail = mail

    def _asdict(self):
        return self.__dict__

js = '[{"name1":"value1", "name2":"value2"}]'

print(json.dumps(User('alice', 'alice@mail.com'), default=default))
x = json.dumps(js, default=default)
print ({x})
print (x.name1)



