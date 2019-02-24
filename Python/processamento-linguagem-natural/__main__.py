import sys
import src as entry

def main():
    if len(sys.argv) == 1:
        raise ValueError("must be at least one file to process the language")

    if sys.argv[1] == '-c':
        entry.init(sys.argv[3:len(sys.argv)], sys.argv[2])
    else:
        entry.init(sys.argv[1:len(sys.argv)])

main()