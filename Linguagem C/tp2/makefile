CC = gcc
CFLAGS = -g
OBJS = funcoes.o grasp.o triangulos.o tp2.o 
TARGET = tp2
all: $(TARGET)

tp2: $(OBJS)
	$(CC) $(CFLAGS) $(OBJS) -o tp2

tp2.o: tp2.c grasp.h triangulos.h funcoes.h
	$(CC) $(CFLAGS) -c tp2.c

funcoes.o: funcoes.c funcoes.h
	$(CC) $(CFLAGS) -c funcoes.c

triangulos.o: triangulos.c triangulos.h
	$(CC) $(CFLAGS) -c triangulos.c

grasp.o: grasp.c grasp.h
	$(CC) $(CFLAGS) -c grasp.c

clean: 
	rm -rf *.o ./$(TARGET)
