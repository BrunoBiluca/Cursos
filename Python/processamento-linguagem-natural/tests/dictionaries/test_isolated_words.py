from src.dictionaries.isolated_words import IsolatedWords

class TestIsolatedWords(object):
    def test_empty_input(self, capsys):
        dictionary = IsolatedWords().get_dictionary()
        assert len(dictionary) == 0

    def test_one_word_input(self, capsys):
        dictionary = IsolatedWords(["code"]).get_dictionary()
        assert len(dictionary) == 1
        assert dictionary[0] == "code"

    def test_input_with_only_spaces(self, capsys):
        dictionary = IsolatedWords(["clean code"]).get_dictionary()
        assert len(dictionary) == 2
        assert dictionary[0] == "clean"
        assert dictionary[1] == "code"

    def test_input_with_others_delimiters(self, capsys):
        dictionary = IsolatedWords(["clean-code"]).get_dictionary()
        assert len(dictionary) == 2
        assert dictionary[0] == "clean"
        assert dictionary[1] == "code"

    def test_dictionary_with_multi_inputs(self, capsys):
        dictionary = IsolatedWords(["clean-code", "the art of clean code"]).get_dictionary()
        assert len(dictionary) == 5
        assert dictionary[0] == "clean"
        assert dictionary[1] == "code"
        assert dictionary[2] == "the"
        assert dictionary[3] == "art"
        assert dictionary[4] == "of"

    def test_get_word_vector_one_sentence(self, capsys):
        vectors = IsolatedWords(["clean-code"]).get_word_vectors()
        assert len(vectors) == 1
        assert len(vectors[0]) == 2
        assert vectors[0][0] == 1
        assert vectors[0][1] == 1

    def test_get_word_vector_multi_sentence(self, capsys):
        vectors = IsolatedWords(["clean-code", "uncle bob is clean"]).get_word_vectors()
        assert len(vectors) == 2
        assert len(vectors[0]) == 5 # 5 words in the dictionary
        assert sum(vectors[0]) == 2 # 2 occurrences in dictionary
        assert len(vectors[1]) == 5
        assert sum(vectors[1]) == 4 # 4 occurrences in dictionary

    def test_get_word_vector_multi_sentence_upper_letters(self, capsys):
        vectors = IsolatedWords(["Falar é fácil. Mostre-me o código.", "É fácil escrever código. Difícil é escrever código que funcione."]).get_word_vectors()
        assert len(vectors) == 2
        assert len(vectors[0]) == 11 # 5 words in the dictionary
        print(vectors[0])
        out, err = capsys.readouterr()
        assert out == '[1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0]\n'

        assert len(vectors[1]) == 11
        print(vectors[1])
        out, err = capsys.readouterr()
        assert out == '[0, 2, 1, 0, 0, 0, 2, 2, 1, 1, 1]\n'

    def test_invalid_tokens(self, capsys):
        dictionary = IsolatedWords(["python in 10 minutes"]).get_dictionary()
        assert len(dictionary) == 3
        assert dictionary[0] == "python"
        assert dictionary[1] == "in"
        assert dictionary[2] == "minutes"
