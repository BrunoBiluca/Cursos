CC = gcc
CFLAGS = -g
OBJS = recursao.o tp4.o 
TARGET = tp4
all: $(TARGET)

tp4: $(OBJS)
	$(CC) $(CFLAGS) $(OBJS) -pthread -o tp4

tp4.o: tp4.c recursao.h
	$(CC) $(CFLAGS) -c tp4.c

recursao.o: recursao.c recursao.h
	$(CC) $(CFLAGS) -c recursao.c

clean: 
	rm -rf *.o ./$(TARGET)
