from .file_service import FileService
from .dictionaries.isolated_words import IsolatedWords
from .dictionaries.sequel_words import SequelWords
from .dictionaries.stop_words import StopWords

def init(files, stop_word_config = None):
    isolatedWordsProcessor = IsolatedWords(FileService(files).texts(), StopWords(stop_word_config))
    print("Isolated Words Processor:")
    print('Dictionary: ["' + '", "'.join(isolatedWordsProcessor.get_dictionary()) + '"]')
    for vectors in isolatedWordsProcessor.get_word_vectors():
        print(vectors)

    print()

    sequelWordsProcessor = SequelWords(FileService(files).texts(), StopWords(stop_word_config))
    print("Sequel Words Processor:")
    print('Dictionary: ["' + '", "'.join(sequelWordsProcessor.get_dictionary()) + '"]')
    for vectors in sequelWordsProcessor.get_word_vectors():
        print(vectors)
