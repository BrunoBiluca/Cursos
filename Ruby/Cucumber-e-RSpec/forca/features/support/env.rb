# Define os arquivos que serão utilizados no cubumber e que será testada
require File.join(File.dirname(__FILE__), "..", "..", "lib", "game")
# Define a gem aruba que é utlizada nos testes
# A gem Aruba simula as interações dos usuários, facilitando os testes de aceitação
# Se não fosse utilizada a gem Aruba seria necessário ter mais de um terminal aberto
# cada um executando as funcionalidades do sistema.
require "aruba/cucumber"