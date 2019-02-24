import os
from src.dictionaries.stop_words import StopWords

class TestStopWords():
    def test_empty_stop_words_list(self, capsys):
        dictionary = StopWords().strip(['o', 'clean', 'code'])
        assert len(dictionary) == 3
        assert 'o' in dictionary

    def test_config_stop_words_list(self, capsys):
        path = os.path.join(os.path.dirname(__file__), r'../resources/stop_words.json')
        dictionary = StopWords(path).strip(['o', 'que', 'clean', 'code'])
        assert len(dictionary) == 2
        assert 'o' not in dictionary
        assert 'que' not in dictionary

    def test_config_stop_words_list_case_insensitively(self, capsys):
        path = os.path.join(os.path.dirname(__file__), r'../resources/stop_words.json')
        dictionary = StopWords(path).strip(['o', 'Que', 'clean', 'code'])
        assert len(dictionary) == 2
        assert 'o' not in dictionary
        assert 'Que' not in dictionary

    def test_config_stop_words_list_case_sensitively(self, capsys):
        path = os.path.join(os.path.dirname(__file__), r'../resources/stop_words_case_sensitively.json')
        dictionary = StopWords(path).strip(['o', 'Que', 'clean', 'code'])
        assert len(dictionary) == 3
        assert 'o' in dictionary
        assert 'Que' not in dictionary