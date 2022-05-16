export default class HangmanGameManager {
    originalDictionary: string[];
    dictionary: string[];
    tries = 0;
    word : string | undefined = undefined;

    constructor(dictionary: string[]) {
        this.validate(dictionary);
        this.originalDictionary = [...dictionary];
        this.dictionary = [...dictionary];
    }

    validate(dictionary: string[]) {
        if(!dictionary.length)
            throw new Error("Tem que passar palavrinhas")

        for (const word of dictionary) {
            if (!this.isValidWord(word))
                throw new Error("Palavra inválida para nosso joguinho")
        }
    }

    isValidWord(word: string) {
        return !word.includes("-")
    }

    getWord(): string {
        this.word = this.dictionary.pop();

        this.tries = 3;

        if (!this.word){
            this.dictionary = this.originalDictionary;
            return this.getWord();
        }

        return this.word
    }

    guess(letter: string): any {
        if(!this.word)
            throw new Error("Word was not choose")

        if(!this.word.includes(letter))
            this.tries--;
    }

}