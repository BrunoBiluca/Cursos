from src.dictionaries.sequel_words import SequelWords


class TestSequelWords():

    def test_empty_words(self, capsys):
        dictionarty = SequelWords().get_dictionary()
        assert len(dictionarty) == 0

    def test_three_words(self, capsys):
        dictionarty = SequelWords(["the clean code"]).get_dictionary()
        assert len(dictionarty) == 2
        assert dictionarty[0] == "the clean"
        assert dictionarty[1] == "clean code"

    def test_multi_sentences(self, capsys):
        dictionarty = SequelWords(
            ["the clean code", "the art of clean code"]).get_dictionary()
        assert len(dictionarty) == 5
        assert dictionarty[0] == "the clean"
        assert dictionarty[1] == "clean code"
        assert dictionarty[2] == "the art"
        assert dictionarty[3] == "art of"
        assert dictionarty[4] == "of clean"

    def test_invalid_tokens(self, capsys):
        dictionary = SequelWords(["python in 10 minutes"]).get_dictionary()
        assert len(dictionary) == 2
        assert dictionary[0] == "python in"
        assert dictionary[1] == "in minutes"

    def test_get_word_vector_multi_sentence_upper_letters(self, capsys):
        vectors = SequelWords(["Falar é fácil. Mostre-me o código.",
                                 "É fácil escrever código. Difícil é escrever código que funcione."]).get_word_vectors()
        assert len(vectors) == 2
        assert len(vectors[0]) == 13
        print(vectors[0])
        out, err = capsys.readouterr()
        assert out == '[1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0]\n'

        assert len(vectors[1]) == 13
        print(vectors[1])
        out, err = capsys.readouterr()
        assert out == '[0, 1, 0, 0, 0, 0, 1, 2, 1, 1, 1, 1, 1]\n'
