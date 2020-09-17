#! python
#-*- conding: utf8 -*-
from sys import argv, exit

#######
##    a lista de tokens so avanca quando o token eh confirmado
##    assim entao o proximo token vem depois de uma compacao com a variavel token
#######


ADD = "0"
SUB = "1"
MUL = "2"
DIV = "3"

#    Operadores de associacao

ASSIGN = "4"
REFF = "41"

#    Operadores logicos

OR = "5"
AND = "6"
LOWER = "7"
LE = "8"
GREATER = "9"
GE = "10"
EQUAL = "11"
DIFF = "12"

#    Identificadores

ID = "13"

#    Numeros

NUMI = "14"
NUMF = "15"

#    Textos

LITERAL = "16"

#    Palavras reservadas

CHAR = "17"
INT = "18"
FLOAT = "19"
IF = "20"
ELSE = "21"
RETURN = "22"
FOR = "23"
CONTINUE = "24"
BREAK = "25"
PRINT = "26"
READ = "27"
VOID = "39"
SCAN = "40"

#    Delimitadores

SEMI = "28"
OPEN_BRACE_C = "29"
CLOSE_BRACE_C = "30"
COMA = "31"
EXCLAMATION = "32"
OPEN_PAR = "33"
CLOSE_PAR = "34"
OPEN_BRACE_P = "35"
CLOSE_BRACE_P = "36"
QUOTATION = "37"
APOST = "38"

try:
    if(argv[1] == "-c"):
        arquivo = open(argv[2], 'r')
    else:
        print "O padrao a ser seguido deve ser:\n"
        print "python analisadorSintatico.py -c <nome_arquivo>"
        exit(0)
except:
    print "O padrao a ser seguido deve ser:\n"
    print "python analisadorSintatico.py -c <nome_arquivo>"
    exit(0)
    
arqSimbolos = open("tabSimbolos.txt","r")
limpaSimbolos = []
arqSimbolos = open("tabSimbolos.txt","w")
arqSimbolos.writelines(limpaSimbolos)
arqSimbolos.close()

quadrupla = open("quadrupla.txt","r")
limpaQuadrupla = []
quadrupla = open("quadrupla.txt","w")
quadrupla.writelines(limpaQuadrupla)
quadrupla.close()


################## Variaveis globais #########################

quadrupla = []      #Lista de codigo intermediario
pilha = []          #Pilha auxiliar
pilhaJF = []
pilhaJ = []
pilhaFOR = []
token = ""  #Token atual
i = -1      #Numero do token na lista
ident = 0
tipoAux = ""
tcont = 0
ccont = 0
lcont = 0

##############################################################

def comando():
    global token
    global i
    
    if (atribuicao()):
        #ponto e virgula
        if(token[0] == SEMI):
            print "Funcionou a atribuicao sozinha"
            nextToken()
        else:
            return fail()
    elif (condicional()):
        print "Funcionou a condicional"
    elif (repeticao()):
        print "Funcionou o comando repeticao "
    elif (declaracao()):
        #ponto e virgula
        if(token[0] == SEMI):
            nextToken()
            print "Funcionou a atribuicao de declaracao"
        else:
            return fail()
    elif (token[0] == CONTINUE):
        nextToken()
        #ponto e virgula
        if(token[0] == SEMI):
            nextToken()
            print "Funcionou o comando Continue"
        else:
            return fail()
    elif (token[0] == BREAK):
        nextToken()
        geraBreak()
        #ponto e virgula
        if(token[0] == SEMI):
            nextToken()
            print "Funcionou o comando Break"
        else:
            return fail()
    elif (token[0] == RETURN):
        nextToken()
        if(tipoRetorno()): 
            geraRetorno()               
            #ponto e virgula
            if(token[0] == SEMI):
                nextToken()
                print "Funcionou o comando return"
            else:
                return fail()
        else:
            return fail()
    elif (token[0] == PRINT):
        nextToken()
        if(token[0] == OPEN_PAR):
            nextToken()
            if(token[0] == LITERAL):
                geraLiteral()
                nextToken()
                if(printAux()):
                    if(token[0] == CLOSE_PAR):
                        nextToken()                
                        #ponto e virgula
                        if(token[0] == SEMI):
                            nextToken()
                            geraPrint()
                            print "Funcionou o comando print"
                        else:
                            return fail()
                    else:
                        return fail()
                else:
                    return fail()
            else:
                return fail()
        else:
            return fail()
    else:
        return True
    #Novo comando
    if (comando()):
        return True
    else:
        return True
    
def geraPrint():
    global pilha
    
    nome = pilha.pop()
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append("print"+"    "+nome+"    "+"#"+"    "+"#"+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()  
    
def geraBreak():
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append("break"+"    "+"#"+"    "+"#"+"    "+"#"+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()    
    

def geraRetorno():
    global pilha
    
    nome = pilha.pop()
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append("return"+"    "+nome+"    "+"#"+"    "+"#"+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()    

def printAux():
    global i
    global token
    
    if(token[0] == COMA):
        nextToken()
        if(token[0] == ID):
            nextToken()
            if(printAux()):
                return True
            else:
                return True
        else:
            return fail()
    else:
        return True
        

def tipoRetorno():
    global i
    global token

    if(token[0] in {ID,NUMI,NUMF,LITERAL}):
        if token[0] == ID : geraIdentificador()
        elif token[0] == LITERAL : geraLiteral()
        else : geraNumero()
        nextToken()
        return True
    else:
        return fail()

def geraLiteral():
    global token
    global pilha

    for aux in listLiterais :
        variavel = aux.split("\t")
        if(token[1] == variavel[0]): nome = variavel[1]  
    
    pilha.append(nome)        
    
def geraLabelFOR():
    global lcont
    global pilhaFOR
        
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append("LABEL"+str(lcont)+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()    
    
    pilhaFOR.append("LABEL"+str(lcont));
    lcont += 1

def geraJumpFOR():
    global lcont
    global pilhaFOR
    
    label = pilhaFOR.pop()

    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append("J"+"    "+"#"+"    "+"#"+"    "+label+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()
    
    lcont += 1
    
def repeticao():
    global i
    global token
    
    #For
    if (token[0] == FOR):
        print "Entrou FOR"
        nextToken()
        #ABRE PARENTESE
        if (token[0] == OPEN_PAR):
            print "Entrou Open_Par"
            nextToken()
            #VERIFICA SE E UMA Atribuicao
            if(atribuicao()):
                print "Entrou Atribuicao"
                geraLabelFOR()
                #Ponto e virgula
                if (token[0] == SEMI):
                    nextToken()
                    print "Funcionou ponto e virula da atribuicao" 
                    if(exprlogica()):
                        print "Funcionou expressao logica"
                        geraJumpF()
                        #Ponto e virgula
                        if (token[0] == SEMI):
                            nextToken()
                            print "Funcionou ponto e virula da logica" 
                            if(atribuicao()):
                                print "Funcionou expressao matematica"
                                if(token[0] == CLOSE_PAR):
                                    print "Funcionou fecha parenteses"
                                    nextToken()
                                    if(repeticaoAux()):
                                        geraJumpFOR()
                                        geraLabelJF()
                                        print "Funcionou a repeticao"
                                        return True
                                    else:
                                        return fail()
                            else:
                                return fail()             
                        else:
                            return fail()
                    else:
                        return fail()             
                else:
                    return fail()
            else:
                return fail()
        else:
            return fail()
    else:
        return fail()    

def repeticaoAux():
    if(token[0] == OPEN_BRACE_C):
        nextToken()
        if(comando()):
            if(token[0] == CLOSE_BRACE_C):
                nextToken()
                return True
            else:
                return fail()
        else:
            return fail()
    else:
        return fail()

def declaracao():
    global token
    global i

    if(tipo()):
        print "Funcionou o tipo"
        if(atribuicao2()):
            print "Funcionou atribuicao"
            return True
        else:
            return fail()
    else:
        return fail()
    
def tipo():
    global token
    global i
    global tipoAux
    
    if(token[0] == INT or token[0] == FLOAT or token[0] == CHAR):
        if token[0] == INT : tipoAux = "INT"
        elif token[0] == FLOAT : tipoAux = "FLOAT"
        elif token[0] == CHAR : tipoAux = "CHAR" 
        nextToken()
        return True
    else:
        return fail()

def geraDeclaracao(nome):
    global token
    global i
    global tipoAux
    global ident
    global listVariaveis

    arqSimbolos = open("tabSimbolos.txt", "r")
    texto = arqSimbolos.readlines()
    texto.append(str(ident)+"    "+tipoAux+"    "+nome+"\n")
    arqSimbolos = open("tabSimbolos.txt", "w")
    arqSimbolos.writelines(texto)
    arqSimbolos.close()

    ident += 1

def atribuicao2():
    global token
    global i

    #Indentificador
    if(token[0] == ID):
        print "Funcionou o identificador"
        for aux in listVariaveis :
            variavel = aux.split("\t")
            if(token[1] == variavel[0]): nome = variavel[1]  
        geraDeclaracao(nome)
        nextToken()
        if(token[0] == COMA):
            if(atribuicao2()):
                return True
            else:
                return True
        elif(atribuicaoAux()):
            pilha.append(nome)
            return True
        else:
            return fail()
    else:
        return fail()  
        
def atribuicao():
    global token
    global i

    #Indentificador
    if(token[0] == ID):
        print "Funcionou o identificador"
        for aux in listVariaveis :
            variavel = aux.split("\t")
            if(token[1] == variavel[0]): nome = variavel[1]  
        nextToken()
        if(token[0] == COMA):
            if(atribuicao()):
                return True
            else:
                return True
        elif(atribuicaoAux()):
            pilha.append(nome)
            return True
        else:
            return fail()
    else:
        return fail()  

def geraAtribuicaoAux(op, a, b):
    global pilha

    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append(op+"    "+a+"    "+"#"+"    "+b+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()

def atribuicaoAux():
    #Sinal de igual
    if(token[0] == ASSIGN):
        print "Funcionou o sinal de igual"
        nextToken()
        #Expresao
        if(expresao()):
            geraAtribuicaoAux("=",pilha.pop(),pilha.pop())
            print "funcionou expressao"
            return True
        else:
            return fail()
    else:
        return True

def geraJumpF():
    global pilha
    global lcont
    global pilhaJF
    
    resLogica = pilha.pop()

    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append("JF"+"    "+resLogica+"    "+"#"+"    LABEL"+str(lcont)+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()
    
    pilhaJF.append("LABEL"+str(lcont))
    lcont += 1
    
def geraJump():
    global pilha
    global lcont
    global pilhaJ
    
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append("J"+"    "+"#"+"    "+"#"+"    LABEL"+str(lcont)+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()
    
    pilhaJ.append("LABEL"+str(lcont))
    lcont += 1
        
def condicional(): 
    global i
    global token
    global pilha
    
    #IF
    if (token[0] == IF):
        print "Entrou IF"
        nextToken()
        #ABRE PARENTESE
        if (token[0] == OPEN_PAR):
            print "Entrou Open_Par"
            nextToken()
            #VERIFICA SE E UMA EXPRESSAO LOGICA
            if(exprlogica()):
                geraJumpF()
                print "Entrou ExprLogica"
                #FECHA PARENTESES
                if (token[0] == CLOSE_PAR):
                    nextToken()
                    print "Funcionou condicional" 
                    if(condicionalaux()):
                        print "Funcionou condicionalAux"
                        return True
                    else:
                        return fail()             
                else:
                    return fail()
            else:
                return fail()
        else:
            return fail()
    else:
        return fail()

def condicionalaux():
    global i
    global token

    #ABRE CHAVE
    if (token[0] == OPEN_BRACE_C):
        print "Entrou abre chaves"
        nextToken()      
        #VERIFICA COMANDO
        if (comando()):  
            print "Funcionou condicional aux(1)"  
            if(condicionalaux2()):
                return True
            else:
                return fail()       
        else:
            return fail()
    else:
        if (comando()): 
            print "Funcionou condicional aux(2)"  
            condicionalaux2()
        else:
            return fail()

def geraLabelJF():
    global token
    global pilhaJF
    
    label = pilhaJF.pop()
    
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append(label+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()
    
def geraLabelJ():
    global token
    global pilhaJ
    
    label = pilhaJ.pop()
    
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append(label+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()
             
def condicionalaux2():
    global i
    global token
    
    #FECHA CHAVE
    if (token[0] == CLOSE_BRACE_C): 
        print "Entrou fecha chave"
        nextToken()
        if (token[0] != ELSE):
            geraLabelJF()
            print "Condicional aux 2(1)"
            return True
        else:
            print "Entrou else"
            geraJump()
            geraLabelJF()
            nextToken()
            if(condicionalaux3()): #Entra no ELSE
                print "Condicional aux 2(2)"
                return True
            else:
                fail()
    else:
        return fail()

def condicionalaux3():
    global i
    global token
    
    #ABRE CHAVE
    if (token[0] == OPEN_BRACE_C):
        print "Entrou abre chaves do else"
        nextToken()
        #VERIFICA COMANDO
        if (comando()):  
            print "Entrou comando dentro do else"
            #FECHA CHAVE
            if (token[0] == CLOSE_BRACE_C):
                nextToken()
                geraLabelJ() 
                print "Entrou fecha chaves do else"
                return True
            else:
                return fail()
        else:
            return fail()
    else:
        return fail()
    
    
def exprlogica():
    global i
    global token
        
    if(token[0] == ID):
        geraIdentificador()
        print "Funcionou o primeiro operador da expressao logica"
        nextToken()
        if(exprLogicaAux()):
            print "Funcionou uma expressao logica"
            return True
        else:
            return fail()
    else:
        return fail()
    
def exprLogicaAux():
    global i
    global token
    
    if(exprLogicaAux2()):
        print "Funcionou exprLogicaAux2"
        if(exprLogicaAux3()):
            print "Funcionou exprLogicaAux3"
            return True
        else:
            return fail()
    else:
        return fail()

def geraExprLogica(a, op, b):
    global token
    global pilha
    global ccont
    
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append(op+"    "+a+"    "+b+"    c"+str(ccont)+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()
    
    pilha.append("c"+str(ccont))
    ccont += 1
   
def exprLogicaAux2():
    global i
    global token
    global pilha

    if(opComparacao()):
        print "Funcionou opComparacao"
        if(operando2()):
            geraExprLogica(pilha.pop(),pilha.pop(),pilha.pop())
            print "Funcionou operando2"
            return True
        else:
            return fail()
    else:
        return True
    
def exprLogicaAux3():
    global i
    global token

    if(conector()):
        print "Funcionou conector"
        if(token[0] == ID):
            geraIdentificador()
            nextToken()
            if(exprLogicaAux()):
                geraExprLogica(pilha.pop(), pilha.pop(), pilha.pop())
                return True
            else:
                return fail()
        else:
            return fail()
    else:
        return True

def opComparacao():
    global i
    global token
    global pilha

    if(token[0] == LOWER or token[0] == LE or token[0] == GREATER or token[0] == GE or
       token[0] == EQUAL or token[0] == DIFF):
        if token[0] == LOWER : comp = "<"
        elif token[0] == LE : comp = "<="
        elif token[0] == GREATER : comp = ">"
        elif token[0] == GE : comp = ">="
        elif token[0] == EQUAL : comp = "=="
        elif token[0] == DIFF : comp = "!="
        pilha.append(comp)
        nextToken()
        return True
    else:
        return fail()

def operando2():
    global i
    global token

    if(token[0] == ID):
        geraIdentificador()
        nextToken()
        return True
    elif(token[0] == NUMI):
        geraNumero()
        nextToken()
        return True
    elif(token[0] == NUMF):
        geraNumero()
        nextToken()
        return True
    else:
        return fail()

def conector():
    global i
    global token
    global pilha

    if(token[0] == AND):
        pilha.append("&&")
        nextToken()
        return True
    elif(token[0] == OR):
        pilha.append("||")
        nextToken()
        return True
    else:
        return fail()
    

def exprMat():
    global i
    global token
    
    if(termo()):
        print "Funcionou termo da exprMat"
        if(exprAux()):
            print "Funcionou exprAux da exprMat"
            return True
    else:
        return fail()
    
def termo():
    global i
    global token
    
    if(fator()):
        print "Funcionou Fator do termo"
        if(termoAux()):
            print "Funcionou termoAux do termo"
            return True
        else:
            return fail()
    else:
        return fail()

def geraTermo(op, a, b):
    global token
    global pilha
    global tcont
    
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append(op+"    "+a+"    "+b+"    t"+str(tcont)+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()
    
    pilha.append("t"+str(tcont))
    tcont += 1

def termoAux():
    global i
    global token  
    global pilha  
    
    if(token[0] == MUL or token[0] == DIV):
        print "Funcionou MUL ou DIV"
        if token[0] == MUL : opAux = "*"
        elif token[0] == DIV : opAux = "/"
        nextToken()
        if(fator()):
            geraTermo(opAux, pilha.pop(), pilha.pop())
            if(termoAux()):
                return True
            else:
                return fail()
        else:
            return fail()
    else:
        return True    
    
def geraIdentificador():
    global token
    global pilha

    for aux in listVariaveis :
        variavel = aux.split("\t")
        if(token[1] == variavel[0]): nome = variavel[1]  
    
    pilha.append(nome)
    
def geraNumero():
    global token
    global pilha

    for aux in listConstantes :
        variavel = aux.split("\t")
        if(token[1] == variavel[0]): nome = variavel[1]  
    
    pilha.append(nome)    
    
def fator():
    global i
    global token
    

    if(token[0] == OPEN_PAR):
        nextToken()
        if(exprMat()):
            nextToken()
            if(token[0] == CLOSE_PAR):
                return True
            else:
                fail()
        else:
            fail()
    elif(token[0] == ID):
        geraIdentificador()
        nextToken()
        return True
    elif(token[0] == NUMI):
        geraNumero()
        nextToken()
        return True
    elif(token[0] == NUMF):
        geraNumero()
        nextToken()
        return True    
    else:
        fail()  
        
def geraExprAux(op, a, b):
    global token
    global pilha
    global tcont
    
    quadrupla = open("quadrupla.txt", "r")
    texto = quadrupla.readlines()
    texto.append(op+"    "+a+"    "+b+"    t"+str(tcont)+"\n")
    quadrupla = open("quadrupla.txt", "w")
    quadrupla.writelines(texto)
    quadrupla.close()
    
    pilha.append("t"+str(tcont))
    tcont += 1
    
def exprAux():
    global i
    global token    
    global pilha
    
    if(token[0] == ADD or token[0] == SUB):
        if token[0] == ADD : opAux = "+"
        elif token[0] == SUB : opAux = "-"
        print "Funcionou ADD ou SUB na exprAux"
        nextToken()
        if(termo()):
            geraExprAux(opAux, pilha.pop(), pilha.pop())
            "Funcionou termo na exprAux"
            if(exprAux()):
                "Funcionou exprAux na exprAux"
                return True
            else:
                return fail()
        else:
            return fail()
    else:
        return True
    
def expresao():
    global token
    global i
    
    if(exprMat()):
        print "Funcionou exprMat"
        return True
    elif(token[0] == LITERAL):
        print "Funcionou literal"
        nextToken()
        return True
    else:
        return fail()

def fail():
    return False

def nextToken():
    global token
    global i

    try:
        i+=1
        token = listTokens[i].split(",")
    except IndexError:
        print "Termino de arquivo precoce"
    
def analisadorSintatico() :
    global token
    global i
    
    i = -1
    nextToken()
    if(token[0] == INT):
        nextToken()
        if(token[0] == ID):
            nextToken()
            if(token[0] == OPEN_PAR):
                nextToken()
                if(token[0] == CLOSE_PAR):
                    nextToken()
                    if(token[0] == OPEN_BRACE_C):
                        nextToken()
                        #Comando
                        if(comando()):
                            if(token[0] == CLOSE_BRACE_C):
                                nextToken()        
                                if(token[0] == "eof"):
                                    return True
                            else:
                                return fail()
                        else:
                            return fail()
                    else:
                        return fail()
                else:
                    return fail()
            else:
                return fail()
        else:
            return fail()
    else:
        return fail()
        
if __name__== "__main__":
    global listVariaveis
    
    conteudo = arquivo.readlines()
    
    inicioTokens = (int) (conteudo[3][18]+conteudo[3][19])
    fimTokens = (int) (conteudo[3][21]+conteudo[3][22])
    
    inicioLiterais = (int) (conteudo[5][20]+conteudo[5][21])
    fimLiterais = (int) (conteudo[5][23]+conteudo[5][24])
    
    inicioVariaveis = (int) (conteudo[7][21]+conteudo[7][22])
    fimVariaveis = (int) (conteudo[7][24]+conteudo[7][25])
    
    inicioConstantes = (int) (conteudo[9][22]+conteudo[9][23])
    fimConstantes = (int) (conteudo[9][25]+conteudo[9][26])
    
    listTokens = []
    for i in range(inicioTokens-1,fimTokens):
        listTokens.append(conteudo[i].rstrip())
        
    listTokens.append("eof")
    listTokens.append("eof")
        
    listLiterais = []
    for i in range(inicioLiterais-1,fimLiterais):
        listLiterais.append(conteudo[i].rstrip())
        
    listVariaveis = []
    for i in range(inicioVariaveis-1,fimVariaveis):
        listVariaveis.append(conteudo[i].rstrip())
            
    listConstantes = []
    for i in range(inicioConstantes-1,fimConstantes):
        listConstantes.append(conteudo[i].rstrip())
    
    if(analisadorSintatico()):
        print "Sintaxe correta"
    else:
        print "Sintaxe incorreta"
    
#termina