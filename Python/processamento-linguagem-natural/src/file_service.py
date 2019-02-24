class FileService():
    def __init__(self, paths=[]):
        self.paths = []
        if(paths):
            self.paths = paths

    def texts(self):
        read_data = []
        for path in self.paths:
            with open(path, 'r', encoding="utf-8") as f:
                read_data.append(f.read())
        return read_data