from importlib import import_module
from .base_animal import AnimalBaseClass

def cat(*args, **kwargs):
    animal_module = import_module('.cat', package='animals')
    animal_class = getattr(animal_module, 'Cat')
    instance = animal_class(*args, **kwargs)
    return instance

def dog(*args, **kwargs):
    animal_module = import_module('.dog', package='animals')
    animal_class = getattr(animal_module, 'Dog')
    instance = animal_class(*args, **kwargs)
    return instance