import { WordChooser } from "./WordChooserService"

export default class WordGameHandler {
    wordChooser: WordChooser;
    isInitilized = false;
    originalWord = "";
    currentWord = "";

    constructor(wordChooser: WordChooser) {
        this.wordChooser = wordChooser;
    }

    init(): string {
        this.originalWord = this.wordChooser.get().word
        this.currentWord = "_".repeat(this.originalWord.length)
        this.isInitilized = true;
        return this.currentWord;
    }

    guess(letter: string): string {

        if (!this.isInitilized) throw new Error("Game should be initilize before start guessing")
        if (letter.length > 1) throw new Error("Max 1 letter by guess")

        let index = 0;
        while (this.originalWord.indexOf(letter, index) != -1) {
            const found = this.originalWord.toLocaleLowerCase().indexOf(letter, index);
            index = found + 1;
            this.updateLetter(found)
        }

        return this.currentWord;
    }

    tryGuess(letter: string): { isCorrect: boolean; word: string; }{
        const word = this.currentWord;
        const newWord = this.guess(letter);
        return {
            isCorrect: word != newWord,
            word: newWord
        };
    }

    updateLetter(index: number) {
        if (index === -1) return;

        this.currentWord = this.currentWord.substring(0, index)
            + this.originalWord[index]
            + this.currentWord.substring(index + 1);
    }

}