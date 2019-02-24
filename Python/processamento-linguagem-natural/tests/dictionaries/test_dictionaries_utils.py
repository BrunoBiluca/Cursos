from src.dictionaries.utils import sanitize

class TestDictionariesUtils():
    def test_sanitize(self, capsys):
        text = "Falar .\nÉ fácil. Mostre-me."
        assert sanitize(text) == "Falar É fácil Mostre me"