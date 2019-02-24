from django.contrib import admin
from .models import Offer

class OfferAdmin(admin.ModelAdmin):
    list_display = ('code', 'discout')

admin.site.register(Offer, OfferAdmin)