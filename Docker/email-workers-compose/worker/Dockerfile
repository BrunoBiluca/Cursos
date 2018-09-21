FROM python:3.6
LABEL maintainer 'Bruno Costa<bruno.b.costa@accenture.com>'

# esta variável de ambiente é específica do python, para não fazer buffer das mensagens do console, isso dificultaria a visualização pelo log
ENV PYTHONUNBUFFERED 1
RUN pip install redis==2.10.5

ENTRYPOINT ["/usr/local/bin/python"]