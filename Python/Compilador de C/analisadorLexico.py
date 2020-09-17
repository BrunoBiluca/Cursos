#! python
#-*- conding: utf8 -*-
from sys import argv, exit

#                Estruturas
numeros = {"1","2","3","4","5","6","7","8","9","0"}
letras = {"a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p",
          "q","r","s","t","u","v","w","x","y","z","_"}

#                Descricao dos tokens
#    Operadores aritmeticos
operadores = {"+","-","*","/","=","|","&","<",">"}

ADD = 0
SUB = 1
MUL = 2
DIV = 3

#    Operadores de associacao

ASSIGN = 4
REFF = 41

#    Operadores logicos

OR = 5
AND = 6
LOWER = 7
LE = 8
GREATER = 9
GE = 10
EQUAL = 11
DIFF = 12

#    Identificadores

ID = 13

#    Numeros

NUMI = 14
NUMF = 15

#    Textos

LITERAL = 16

#    Palavras reservadas

CHAR = 17
INT = 18
FLOAT = 19
IF = 20
ELSE = 21
RETURN = 22
FOR = 23
CONTINUE = 24
BREAK = 25
PRINT = 26
READ = 27
VOID = 39
SCAN = 40

#    Separadores
delimitadores = {";","{","}","(",")",",","!","[","]",'''"''',"""'"""," ","\n","\t"}

SEMI = 28
OPEN_BRACE_C = 29
CLOSE_BRACE_C = 30
COMA = 31
EXCLAMATION = 32
OPEN_PAR = 33
CLOSE_PAR = 34
OPEN_BRACE_P = 35
CLOSE_BRACE_P = 36
QUOTATION = 37
APOST = 38

#    Erro
ERRO = 666

#    Abertura dos arquivos
try:
    if(argv[1] == "-c"):
        arquivo = open(argv[2], 'r')
    else:
        print "O padrao a ser seguido deve ser:\n"
        print "python analisadorLexico.py -c <nome_arquivo>"
        exit(0)
except:
    print "O padrao a ser seguido deve ser:\n"
    print "python analisadorLexico.py -c <nome_arquivo>"
    exit(0)
arqTokens = open("tokens.txt",'w')
conteudo = arquivo.read()           #Conteudo do codigo
arqLiterais = open("literais.txt",'w')
arqConstantes = open("constantes.txt", "w")
arqVariaveis = open("variaveis.txt", "w")

#    Ids
idLiterais = 0
idVariaveis = 0
idContantes = 0

linha = 1
coluna = 0

#    Auxiliares
tipoNum = "int"     #determina o tipo da constante
ehNumero = 0        #determina se o identificador avaliado e ou nao um numero
taErrado = 0        #flag para quando o token nao e valido
dicVariaveis = {}.fromkeys([])      #Armazena as variaveis do programa
dicLiterais = {}.fromkeys([])       #Armazena os literais do programa
dicConstantes = {}.fromkeys([])       #Armazena as constantes do programa

def adicionaColuna(char):
    if char == "\t": coluna = 4
    else: coluna = 1
    return coluna

def verificaId(i, identificador):
    global idContantes
    global idVariaveis
    global taErrado
    global dicVariaveis
    global dicConstantes
    
    if(conteudo[i+1] in delimitadores or conteudo[i+1] in operadores):
        identificador += conteudo[i]
        if(ehNumero == 1):
            if(taErrado == 0):
                if(identificador in dicConstantes):
                    if(tipoNum == "int"): n = NUMI
                    elif(tipoNum == "float"): n = NUMF
                    arqTokens.write(str(n)+","+str(dicConstantes.get(identificador))+"\n")
                    tamanho = len(identificador)
                    arqConstantes.write(str(dicConstantes.get(identificador))+"\t"+identificador+"\t"+tipoNum
                                        +"\t"+str(linha)+"\t"+str(coluna-tamanho+1)+"\n")
                    estado = 0                     
                else:
                    item = [(identificador,idContantes)]
                    dicConstantes.update(item)
                    if(tipoNum == "int"): n = NUMI
                    elif(tipoNum == "float"): n = NUMF
                    arqTokens.write(str(n)+","+str(dicConstantes.get(identificador))+"\n")
                    tamanho = len(identificador)
                    arqConstantes.write(str(idContantes)+"\t"+identificador+"\t"+tipoNum+"\t"+str(linha)+"\t"+str(coluna-tamanho+1)+"\n")
                    idContantes += 1
                    estado = 0 
            elif(taErrado == 1):
                arqTokens.write(str(ERRO)+"\n")
                estado = 0 
        else:    
            if(identificador == "char"):    # Palavra reservadas
                arqTokens.write(str(CHAR)+"\n")
                estado = 0    
            elif (identificador == "int"):
                arqTokens.write(str(INT)+"\n")
                estado = 0         
            elif (identificador == "if"):
                arqTokens.write(str(IF)+"\n")
                estado = 0         
            elif (identificador == "float"):
                arqTokens.write(str(FLOAT)+"\n")
                estado = 0         
            elif (identificador == "for"):
                arqTokens.write(str(FOR)+"\n")
                estado = 0   
            elif (identificador == "return"):
                arqTokens.write(str(RETURN)+"\n")
                estado = 0  
            elif (identificador == "continue"):
                arqTokens.write(str(CONTINUE)+"\n")
                estado = 0  
            elif (identificador == "break"):
                arqTokens.write(str(BREAK)+"\n")
                estado = 0 
            elif (identificador == "print"):
                arqTokens.write(str(PRINT)+"\n")
                estado = 0 
            elif (identificador == "read"):
                arqTokens.write(str(READ)+"\n")
                estado = 0 
            elif (identificador == "void"):
                arqTokens.write(str(VOID)+"\n")
                estado = 0 
            elif (identificador == "scan"):
                arqTokens.write(str(SCAN)+"\n")
                estado = 0 
            else :      #Identificador
                #Verficar se o identificador ja existe em alguma lista
                if(identificador in dicVariaveis):
                    arqTokens.write(str(ID)+","+str(dicVariaveis.get(identificador))+"\n")
                    tamanho = len(identificador)
                    arqVariaveis.write(str(dicVariaveis.get(identificador))+"\t"+identificador+"\t"+str(linha)
                                       +"\t"+str(coluna-tamanho+1)+"\n")
                    estado = 0
                else:
                    item = [(identificador,idVariaveis)]
                    dicVariaveis.update(item)
                    tamanho = len(identificador)
                    arqVariaveis.write(str(idVariaveis)+"\t"+identificador+"\t"+str(linha)+"\t"+str(coluna-tamanho+1)+"\n")
                    idVariaveis += 1
                    arqTokens.write(str(ID)+","+str(dicVariaveis.get(identificador))+"\n")
                    estado = 0
    elif(conteudo[i+1] in numeros):
        identificador += conteudo[i]
        estado = 38        
    else:
        if(ehNumero == 1):  taErrado = 1;
        identificador += conteudo[i]
        estado = 8
    return estado, identificador

# Analisador Lexico
def analisador():
    global idLiterais
    global dicLiterais
    global ehNumero
    global tipoNum
    
    global taErrado
    
    global linha
    global coluna
    #arquivo = open("teste.c", 'r')
    #conteudo = arquivo.read()           #Conteudo do codigo
    #arqTokens = open("tokens.txt",'w')
    #arqTokens.write("<token_id,valor>\n")   #Padrao do token

    if conteudo:
        print "Tem conteudo\n"
    elif not conteudo:
        print "Vazio"
    
    estado = 0
    linha = 1
    coluna = 0
    identificador = ""
    i = -1
    while i < len(conteudo) - 1:
#         if conteudo[i] == "\n": 
#             print "Quebra de linha"
#         elif conteudo[i] == "\t":
#             print "tabulacao"   
#         elif conteudo[i] == " ":
#             print "Espaco"
#         else:
#             print conteudo[i]
        i += 1
        coluna += adicionaColuna(conteudo[i])
        if(estado == 0):
            ehNumero = 0
            taErrado = 0
            identificador = ""
            if(conteudo[i] == "+"):
                arqTokens.write(str(ADD)+"\n")
                estado = 0
            elif(conteudo[i] == "-"):
                arqTokens.write(str(SUB)+"\n")
                estado = 0
            elif(conteudo[i] == "*"):
                arqTokens.write(str(MUL)+"\n")
                estado = 0
            elif(conteudo[i] == "/"):
                if(conteudo[i+1] == "*"):
                    i += 1
                    coluna += adicionaColuna(conteudo[i])
                    estado = 1
                else:
                    arqTokens.write(str(DIV)+"\n")
                    estado = 0
            elif(conteudo[i] == "="):
                if(conteudo[i+1] == "="):
                    estado = 2
                else:
                    arqTokens.write(str(ASSIGN)+"\n")
                    estado = 0     
            elif(conteudo[i] == ">"):
                if(conteudo[i+1] == "="):
                    estado = 3
                else:
                    arqTokens.write(str(GREATER)+"\n")
                    estado = 0
            elif(conteudo[i] == "<"):
                if(conteudo[i+1] == "="):
                    estado = 4
                else:
                    arqTokens.write(str(LOWER)+"\n")
                    estado = 0
            elif(conteudo[i] == "!"):
                if(conteudo[i+1] == "="):
                    estado = 5
                else:
                    arqTokens.write(str(EXCLAMATION)+"\n")
                    estado = 0  
            elif(conteudo[i] == "&"):
                if(conteudo[i+1] == "&"):
                    estado = 6
                else:
                    arqTokens.write(str(REFF)+"\n")
                    estado = 0
            elif(conteudo[i] == "|"):
                if(conteudo[i+1] == "|"):
                    estado = 7
                else:
                    arqTokens.write(str(ERRO)+"\n")
                    estado = 0                                
            elif(conteudo[i] == "i"):   #Comeca a reconhecer int ou if
                if(conteudo[i+1] == "n"):
                    identificador += conteudo[i]
                    estado = 9
                elif(conteudo[i+1] == "f"):
                    identificador += conteudo[i]
                    estado = 8
                else:
                    estado, identificador = verificaId(i, identificador)
            elif(conteudo[i] == "c"): #Comeca a reconhecer char ou continue
                if(conteudo[i+1] == "h"):
                    identificador += conteudo[i]
                    estado = 10
                elif(conteudo[i+1] == "o"):
                    identificador += conteudo[i]
                    estado = 22                    
                else:
                    estado, identificador = verificaId(i, identificador)
            elif(conteudo[i] == "e"): #Comeca a reconhecer else
                if(conteudo[i+1] == "l"):
                    identificador += conteudo[i]
                    estado = 12
                else:
                    estado, identificador = verificaId(i, identificador)
            elif(conteudo[i] == "f"): #Comeca a reconhecer float ou for
                if(conteudo[i+1] == "l"):
                    identificador += conteudo[i]
                    estado = 14
                elif(conteudo[i+1] == "o"):
                    identificador += conteudo[i]
                    estado = 17                    
                else:
                    estado, identificador = verificaId(i, identificador)
            elif(conteudo[i] == "r"):   #Comeca a reconhecer return
                if(conteudo[i+1] == "e"):
                    identificador += conteudo[i]
                    estado = 18
                else:
                    estado, identificador = verificaId(i, identificador)     
            elif(conteudo[i] == "b"):   #Comeca a reconhecer break
                if(conteudo[i+1] == "r"):
                    identificador += conteudo[i]
                    estado = 28
                else:
                    estado, identificador = verificaId(i, identificador)
            elif(conteudo[i] == "p"):   #Comeca a reconhecer print
                if(conteudo[i+1] == "r"):
                    identificador += conteudo[i]
                    estado = 31
                else:
                    estado, identificador = verificaId(i, identificador)    
            elif(conteudo[i] == "v"):   #Comeca a reconhecer void
                if(conteudo[i+1] == "o"):
                    identificador += conteudo[i]
                    estado = 39
                else:
                    estado, identificador = verificaId(i, identificador)   
            elif(conteudo[i] == "s"):   #Comeca a reconhecer void
                if(conteudo[i+1] == "c"):
                    identificador += conteudo[i]
                    estado = 41
                else:
                    estado, identificador = verificaId(i, identificador)  
            elif(conteudo[i] in numeros):   #Comeca a reconhecer numeros
                ehNumero = 1
                tipoNum = "int"
                if(conteudo[i+1] == "."):
                    identificador += conteudo[i]
                    estado = 37
                else:
                    estado, identificador = verificaId(i, identificador)             
            elif(conteudo[i] == ";"):
                arqTokens.write(str(SEMI)+"\n")
                estado = 0
            elif(conteudo[i] == "{"):
                arqTokens.write(str(OPEN_BRACE_C)+"\n")
                estado = 0
            elif(conteudo[i] == "}"):
                arqTokens.write(str(CLOSE_BRACE_C)+"\n")
                estado = 0
            elif(conteudo[i] == ","):
                arqTokens.write(str(COMA)+"\n")
                estado = 0
            elif(conteudo[i] == "("):
                arqTokens.write(str(OPEN_PAR)+"\n")
                estado = 0
            elif(conteudo[i] == ")"):
                arqTokens.write(str(CLOSE_PAR)+"\n")
                estado = 0
            elif(conteudo[i] == "["):
                arqTokens.write(str(OPEN_BRACE_P)+"\n")
                estado = 0
            elif(conteudo[i] == "]"):
                arqTokens.write(str(CLOSE_BRACE_P)+"\n")
                estado = 0      
            elif(conteudo[i] == '''"'''):
                #arqTokens.write(str(QUOTATION)+"\t"+conteudo[i]+"\n")
                identificador += conteudo[i]; 
                estado = 35
            elif(conteudo[i] == """'"""):
                #arqTokens.write(str(APOST)+"\t"+conteudo[i]+"\n")
                identificador += conteudo[i]; 
                estado = 36   
            elif(conteudo[i] in letras):
                estado, identificador = verificaId(i, identificador)  
        elif(estado == 1):  #Comentario
            if conteudo[i] == "*" and conteudo[i+1] == "/" :    #Acaba o comentario
                i += 1
                coluna += adicionaColuna(conteudo[i])
                estado = 0
            else:   #Comentario continua
                estado = 1
            if i == len(conteudo) - 1:
                print "Voce esqueceu de fechar o comentario"
        elif(estado == 2):
            arqTokens.write(str(EQUAL)+"\n")
            estado = 0  
        elif(estado == 3):
            arqTokens.write(str(GE)+"\n")
            estado = 0  
        elif(estado == 4):
            arqTokens.write(str(LE)+"\n")
            estado = 0  
        elif(estado == 5):
            arqTokens.write(str(DIFF)+"\n")
            estado = 0 
        elif(estado == 6):
            arqTokens.write(str(AND)+"\n")
            estado = 0 
        elif(estado == 7):
            arqTokens.write(str(OR)+"\n")
            estado = 0 
        elif(estado == 8):      #Reconhece qualquer identificador
            estado, identificador = verificaId(i, identificador)
        elif(estado == 9):      #Reconhece o in da palavra reservada int
            if(conteudo[i+1] == "t"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 10):      #Reconhece o ch da palavra reservada char
            if(conteudo[i+1] == "a"):
                identificador += conteudo[i]
                estado = 11
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 11):      #Reconhece o cha a palavra reservada char
            if(conteudo[i+1] == "r"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 12):      #Reconhece else
            if(conteudo[i+1] == "s"):
                identificador += conteudo[i]
                estado = 13
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 13):      #Reconhece else
            if(conteudo[i+1] == "e"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 14):      #Reconhece float
            if(conteudo[i+1] == "o"):
                identificador += conteudo[i]
                estado = 15
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 15):      #Reconhece float
            if(conteudo[i+1] == "a"):
                identificador += conteudo[i]
                estado = 16
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 16):      #Reconhece float
            if(conteudo[i+1] == "t"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 17):      #Reconhece for
            if(conteudo[i+1] == "r"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)         
        elif(estado == 18):      #Reconhece return ou read
            if(conteudo[i+1] == "t"):
                identificador += conteudo[i]
                estado = 19
            elif(conteudo[i+1] == "a"):
                identificador += conteudo[i]
                estado = 34                
            else:
                estado, identificador = verificaId(i, identificador)         
        elif(estado == 19):      #Reconhece return
            if(conteudo[i+1] == "u"):
                identificador += conteudo[i]
                estado = 20
            else:
                estado, identificador = verificaId(i, identificador)         
        elif(estado == 20):      #Reconhece return
            if(conteudo[i+1] == "r"):
                identificador += conteudo[i]
                estado = 21
            else:
                estado, identificador = verificaId(i, identificador)         
        elif(estado == 21):      #Reconhece return
            if(conteudo[i+1] == "n"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)       
        elif(estado == 22):      #Reconhece continue
            if(conteudo[i+1] == "n"):
                identificador += conteudo[i]
                estado = 23
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 23):      #Reconhece continue
            if(conteudo[i+1] == "t"):
                identificador += conteudo[i]
                estado = 24
            else:
                estado, identificador = verificaId(i, identificador)      
        elif(estado == 24):      #Reconhece continue
            if(conteudo[i+1] == "i"):
                identificador += conteudo[i]
                estado = 25
            else:
                estado, identificador = verificaId(i, identificador)      
        elif(estado == 25):      #Reconhece continue
            if(conteudo[i+1] == "n"):
                identificador += conteudo[i]
                estado = 26
            else:
                estado, identificador = verificaId(i, identificador)      
        elif(estado == 26):      #Reconhece continue
            if(conteudo[i+1] == "u"):
                identificador += conteudo[i]
                estado = 27
            else:
                estado, identificador = verificaId(i, identificador)      
        elif(estado == 27):      #Reconhece continue
            if(conteudo[i+1] == "e"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)      
        elif(estado == 28):      #Reconhece break
            if(conteudo[i+1] == "e"):
                identificador += conteudo[i]
                estado = 29
            else:
                estado, identificador = verificaId(i, identificador)     
        elif(estado == 29):      #Reconhece break
            if(conteudo[i+1] == "a"):
                identificador += conteudo[i]
                estado = 30
            else:
                estado, identificador = verificaId(i, identificador)     
        elif(estado == 30):      #Reconhece break
            if(conteudo[i+1] == "k"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)     
        elif(estado == 31):      #Reconhece print
            if(conteudo[i+1] == "i"):
                identificador += conteudo[i]
                estado = 32
            else:
                estado, identificador = verificaId(i, identificador)  
        elif(estado == 32):      #Reconhece print
            if(conteudo[i+1] == "n"):
                identificador += conteudo[i]
                estado = 33
            else:
                estado, identificador = verificaId(i, identificador)  
        elif(estado == 33):      #Reconhece print
            if(conteudo[i+1] == "t"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)  
        elif(estado == 34):      #Reconhece read
            if(conteudo[i+1] == "d"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)  
        elif(estado == 35):     #Reconhece um literal
            identificador += conteudo[i]
            if(conteudo[i] == '''"'''):
                if(identificador in dicLiterais):
                    arqTokens.write(str(LITERAL)+","+str(dicLiterais.get(identificador))+"\n")
                    tamanho = len(identificador)
                    arqLiterais.write(str(dicLiterais.get(identificador))+"\t"+identificador+"\t"+str(tamanho)+"\t"+str(linha)+"\t"+str(coluna-tamanho+1)+"\n")
                    estado = 0                    
                else:
                    item = [(identificador,idLiterais)]
                    dicLiterais.update(item)
                    arqTokens.write(str(LITERAL)+","+str(dicLiterais.get(identificador))+"\n")
                    tamanho = len(identificador)
                    arqLiterais.write(str(idLiterais)+"\t"+identificador+"\t"+str(tamanho)+"\t"+str(linha)+"\t"+str(coluna-tamanho+1)+"\n")
                    idLiterais += 1
                    estado = 0
            else:
                estado = 35
        elif(estado == 36):
            identificador += conteudo[i]
            if(conteudo[i] == """'"""):
                if(identificador in dicLiterais):
                    arqTokens.write(str(LITERAL)+","+str(dicLiterais.get(identificador))+"\n")
                    tamanho = len(identificador)
                    arqLiterais.write(str(dicLiterais.get(identificador))+"\t"+identificador+"\t"+str(tamanho)+"\t"+str(linha)+"\t"+str(coluna-tamanho+1)+"\n")
                    estado = 0                    
                else:
                    item = [(identificador,idLiterais)]
                    dicLiterais.update(item)
                    arqTokens.write(str(LITERAL)+","+str(dicLiterais.get(identificador))+"\n")
                    tamanho = len(identificador)
                    arqLiterais.write(str(idLiterais)+"\t"+identificador+"\t"+str(tamanho)+"\t"+str(linha)+"\t"+str(coluna-tamanho+1)+"\n")
                    idLiterais += 1
                    estado = 0
            else:
                estado = 36
        elif(estado == 37):     #Reconhece um numero float
            tipoNum = "float"
            estado, identificador = verificaId(i, identificador)
        elif(estado == 38):
            if(conteudo[i+1] == "."):
                identificador += conteudo[i]
                estado = 37
            else:
                estado, identificador = verificaId(i, identificador) 
        elif(estado == 39):      #Reconhece void
            if(conteudo[i+1] == "i"):
                identificador += conteudo[i]
                estado = 40
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 40):      #Reconhece void
            if(conteudo[i+1] == "d"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)    
        elif(estado == 41):      #Reconhece scan
            if(conteudo[i+1] == "a"):
                identificador += conteudo[i]
                estado = 42
            else:
                estado, identificador = verificaId(i, identificador)
        elif(estado == 42):      #Reconhece scan
            if(conteudo[i+1] == "n"):
                identificador += conteudo[i]
                estado = 8
            else:
                estado, identificador = verificaId(i, identificador)
                                   
        if(conteudo[i] == "\n"):
            linha += 1
            coluna = 0
        
if __name__== "__main__":
    
    analisador()
    
    arqTokens.close()
    arqLiterais.close()
    arqConstantes.close()
    arqVariaveis.close()
    
    arqSaida = open("saida.txt", 'w')
    

    arqLiterais = open("literais.txt",'r')
    arqConstantes = open("constantes.txt", "r")
    arqVariaveis = open("variaveis.txt", "r")
    
    #Verificar tamanho do arquivo de tokens
    arqTokens = open("tokens.txt","r")  #Abre a primeira vez para contar
    cont = 0
    for line in arqTokens:
        cont += 1
    arqTokens.close()    
    arqTokens = open("tokens.txt","r")  #Abre a segunda vez para escrever na saida
    
        #Verificar tamanho do arquivo de literais
    arqLiterais = open("literais.txt","r")  #Abre a primeira vez para contar
    cont2 = 0
    for line in arqLiterais:
        cont2 += 1
    arqLiterais.close()    
    arqLiterais = open("literais.txt","r")  #Abre a segunda vez para escrever na saida
    
        #Verificar tamanho do arquivo de variaveis
    arqVariaveis = open("variaveis.txt","r")  #Abre a primeira vez para contar
    cont3 = 0
    for line in arqVariaveis:
        cont3 += 1
    arqVariaveis.close()    
    arqVariaveis = open("variaveis.txt","r")  #Abre a segunda vez para escrever na saida
    
        #Verificar tamanho do arquivo de constantes
    arqConstantes = open("constantes.txt","r")  #Abre a primeira vez para contar
    cont4 = 0
    for line in arqConstantes:
        cont4 += 1
    arqConstantes.close()    
    arqConstantes = open("constantes.txt","r")  #Abre a segunda vez para escrever na saida
    
    diferenca = 15      #Linha que comeca o arquivo de tokens
    arqSaida.write("***********************************************************\n")
    arqSaida.write("\n")
    arqSaida.write("            Padrao do analisador lexico 1.0\n")
    arqSaida.write("Tabela de tokens: "+str(diferenca)+"-"+str(cont+diferenca-1)+"\n")
    arqSaida.write("<token_id,value>"+"\n")
    arqSaida.write("Tabela de literais: "+str(cont+diferenca+1)+"-"+str(cont+diferenca+cont2)+"\n")
    arqSaida.write("<ID>\t<type>\t<value>\t<line>\t<column>"+"\n")
    arqSaida.write("Tabela de variaveis: "+str(cont+diferenca+cont2+2)+"-"+str(cont+diferenca+cont2+cont3+1)+"\n")
    arqSaida.write("<ID>\t<value>\t<line>\t<column>"+"\n")
    arqSaida.write("Tabela de constantes: "+str(cont+diferenca+cont2+cont3+3)+"-"+str(cont+diferenca+cont2+cont3+cont4+2)+"\n")
    arqSaida.write("<ID>\t<value>\t<line>\t<column>"+"\n")
    arqSaida.write("\n")
    arqSaida.write("***********************************************************\n")
    arqSaida.write("\n")
 
    arqSaida.write(arqTokens.read())
    arqSaida.write("\n")   
    arqSaida.write(arqLiterais.read())
    arqSaida.write("\n")
    arqSaida.write(arqVariaveis.read())
    arqSaida.write("\n")
    arqSaida.write(arqConstantes.read())
    
#termina
        