import json
from .utils.case_insensitively import CaseInsensitively

class StopWords():
    def __init__(self, config=None):
        if config:
            with open(config) as f:
                data = json.load(f)
                self.ignoreCase = data["wordSet"]["initArgs"]["ignoreCase"]
                self.list = data["wordSet"]["managedList"]
        else:
            self.ignoreCase = False
            self.list = []

    def strip(self, dictionary):
        for word in self.list:
            if self.ignoreCase:
                if CaseInsensitively(word) in dictionary:
                    self.ss_remove(dictionary, word)
            else:
                if word in dictionary:
                    dictionary.remove(word)

        return dictionary

    def ss_remove(self, list_, element):
        for item in list_:
            if item.lower() == element.lower():
                list_.remove(item)
                break