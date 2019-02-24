class CaseInsensitively(object):
    def __init__(self, s):
        self.__s = s.lower()
    def __hash__(self):
        return hash(self.__s)
    def __eq__(self, other):
        # ensure proper comparison between instances of this class
        try:
           other = other.__s
        except (TypeError, AttributeError):
          try:
             other = other.lower()
          except:
             pass
        return self.__s == other