import re

def sanitize(text):
    text = re.sub(r' \d+', " ", text) # garante que números não são adicionados aos dicionários
    for ch in ['.', '-']:
        if ch in text:
            text = text.replace(ch, ' ')

    text = " ".join(text.split())
    return text
