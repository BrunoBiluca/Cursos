import os
from src.file_service import FileService

class TestFileService:
    def test_read_text_from_txt(self, capsys):
        path = os.path.join(os.path.dirname(__file__), r'resources/texto1.txt')
        file_service = FileService([path])
        assert file_service.texts() == ["Falar é fácil. Mostre-me o código."]

    def test_read_text_from_multiple_txt(self, capsys):
        path = os.path.join(os.path.dirname(__file__), r'resources/texto1.txt')
        path2 = os.path.join(os.path.dirname(__file__), r'resources/texto2.txt')
        file_service = FileService([path, path2])
        assert file_service.texts() == ["Falar é fácil. Mostre-me o código.","É fácil escrever código. Difícil é escrever código que funcione."]
