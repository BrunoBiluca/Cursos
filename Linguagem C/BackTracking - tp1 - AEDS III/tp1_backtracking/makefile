CC = gcc
CFLAGS = -g
OBJS = funcoes.o guloso.o backtraking.o tp1.o 
TARGET = tp1
all: $(TARGET)

tp1: $(OBJS)
	$(CC) $(CFLAGS) $(OBJS) -o tp1

tp1.o: tp1.c funcoes.h guloso.h
	$(CC) $(CFLAGS) -c tp1.c

funcoes.o: funcoes.c funcoes.h
	$(CC) $(CFLAGS) -c funcoes.c

guloso.o: guloso.c guloso.h
	$(CC) $(CFLAGS) -c guloso.c

backtraking.o: backtraking.c backtraking.h
	$(CC) $(CFLAGS) -c backtraking.c

clean: 
	rm -rf *.o ./$(TARGET)
