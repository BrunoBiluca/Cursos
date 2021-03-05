from random import randrange
from datetime import timedelta, datetime
import json
import random
import string


def all_categories():
    return string.ascii_uppercase + string.digits


def random_date(start, end):
    """
    This function will return a random datetime between two datetime 
    objects.
    """
    delta = end - start
    int_delta = (delta.days * 24 * 60 * 60) + delta.seconds
    random_second = randrange(int_delta)
    return start + timedelta(seconds=random_second)

def random_string(length):
    return ''.join(random.choice(all_categories()) for _ in range(length))


def random_year():
    start = datetime.strptime('1/1/1900', '%m/%d/%Y')
    end = datetime.strptime('1/1/2021', '%m/%d/%Y')
    delta = end - start
    int_delta = (delta.days * 24 * 60 * 60) + delta.seconds
    random_second = randrange(int_delta)
    return (start + timedelta(seconds=random_second)).year

def random_object():
    d1 = datetime.strptime('1/1/2020 1:30 PM', '%m/%d/%Y %I:%M %p')
    d2 = datetime.strptime('1/1/2021 4:50 AM', '%m/%d/%Y %I:%M %p')
    return {
        "title": random_string(30),  
        "author": random_string(30),
        "content": random_string(500), 
        "categories": [random_string(1) for _ in range(random.randint(5, 10))],
        "createdAt": random_date(d1, d2),     
        "releaseYear": random_year(),
        "comments": [random_string(120) for _ in range(random.randint(3, 100))]
    }
