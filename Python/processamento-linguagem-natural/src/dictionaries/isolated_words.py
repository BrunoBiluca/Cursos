import re
from .utils import sanitize
from .stop_words import StopWords

class IsolatedWords():
    def __init__(self, texts=[], stop_words=StopWords()):
        self.texts = []
        if texts:
            for text in texts:
                self.texts.append(sanitize(text))

        self.stop_words = StopWords()
        if stop_words:
            self.stop_words = stop_words

    def get_dictionary(self):
        dictionary = []
        try:
            for text in self.texts:
                for word in text.split(" "):
                    if word.lower() not in dictionary:
                        dictionary.append(word.lower())
            dictionary = self.stop_words.strip(dictionary)
        except Exception as inst:
            print(inst)

        return dictionary

    def get_word_vectors(self):
        dictionary = self.get_dictionary()
        vectors = []

        for text_index in range(len(self.texts)):
            vectors.insert(text_index, [0] * len(dictionary))
            for text in self.texts[text_index].split(" "):
                try:
                    token_index = dictionary.index(text.lower())
                    vectors[text_index][token_index] += 1
                except ValueError:
                    pass

        return vectors

                
        

