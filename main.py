#Ejemplo enviado por: Isabel Vega Villablanca
import json
import requests
 
class Mindicador:
    def __init__(self, indicador, year):
        self.indicador = indicador
        self.year = year
    def InfoApi(self):
        # En este caso hacemos la solicitud para el caso de consulta de un indicador en un año determinado
        url = f'https://mindicador.cl/api/{self.indicador}/{self.year}'
        response = requests.get(url)
        data = json.loads(response.text.encode("utf-8"))
        # Para que el json se vea ordenado, retornar pretty_json
        pretty_json = json.dumps(data, indent=2)
        return data

class PhpApi:
    def __init__(self,modelo:str,url:str):
        self.model = modelo
        self.url = url
    def getAll(self):
        res = requests.get(self.url,{'model':self.model})
        data = json.loads(res.text.encode("utf-8"))
        pretty_json = json.dumps(data, indent=2)
        return pretty_json
    def getOne(self,id:int):
        res = requests.get(self.url,{'model':self.model},json={'id':id})
        data = json.loads(res.text.encode("utf-8"))
        pretty_json = json.dumps(data, indent=2)
        return pretty_json


url = 'http://localhost/php_api/api/service.php?'
api = PhpApi("Producto",url).getOne(17)
print(api)