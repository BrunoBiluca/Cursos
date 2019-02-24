from .isolated_words import IsolatedWords

class SequelWords(IsolatedWords):
    def __init__(self, text=[], stop_words=None):
        super(SequelWords, self).__init__(text, stop_words)

    def get_dictionary(self):
        dictionary = []
        try:
            for text_index in range(len(self.texts)):
                dictionary.append([])
                for word in self.texts[text_index].split(" "):
                    dictionary[text_index].append(word.lower())
                dictionary[text_index] = self.stop_words.strip(dictionary[text_index])
        except Exception as inst:
            print(inst)

        dictionary_sequel = []
        try:
            for sentense in dictionary:
                for token_index in range(len(sentense) - 1):
                    token_sequel = sentense[token_index].lower() + " " +  sentense[token_index + 1].lower()
                    if token_sequel not in dictionary_sequel:
                        dictionary_sequel.append(token_sequel)
        except Exception as inst:
            print(inst)
        return dictionary_sequel

    def get_word_vectors(self):
        dictionary = self.get_dictionary()
        vectors = []

        for text_index in range(len(self.texts)):
            vectors.insert(text_index, [0] * len(dictionary))
            text_list = self.texts[text_index].split(" ")
            for text_list_index in range(len(text_list) - 1):
                text = text_list[text_list_index] + " " + text_list[text_list_index + 1]
                try:
                    token_index = dictionary.index(text.lower())
                    vectors[text_index][token_index] += 1
                except ValueError:
                    pass

        return vectors