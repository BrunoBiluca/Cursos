from django.db import models

# models.Model determina uma entidade na aplicação que pode ser persistida e pesquisa
class Product(models.Model):
    name = models.CharField(max_length=255)
    price = models.FloatField()
    stock = models.IntegerField()
    # TODO: criar o upload para imagens
    image_url = models.CharField(max_length=255)
