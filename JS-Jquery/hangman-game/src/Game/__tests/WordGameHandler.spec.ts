import WordChooserService, { WordChooser } from "../services/WordChooserService";
import WordGameHandler from "../services/WordGameHandler"

class TestWordChooser extends WordChooser {
    get(): { word: string; meaning: string; } {
        return {
            word: "Arcanine",
            meaning: "Pokemon mais maneiro de todos"
        }
    }
}

describe("WordGameHandler", () => {
    it("init with a valid word", () => {
        let game = new WordGameHandler(new WordChooserService());

        let word = game.init()
        expect(word).not.toBeNull();
        expect(word.length).toBeGreaterThan(0);
        expect(word).toEqual("_".repeat(word.length))
    })

    it("should only guess when game was initialized", () => {
        let game = new WordGameHandler(new TestWordChooser());

        expect(() => { game.guess("b") }).toThrow(Error)
        expect(() => { game.guess("b") })
            .toThrow("Game should be initilize before start guessing")
    })

    it("should throw error when passing more letters to guess", () => {
        let game = new WordGameHandler(new TestWordChooser());
        game.init();
        expect(() => { game.guess("ba") }).toThrow(Error)
        expect(() => { game.guess("ba") }).toThrow("Max 1 letter by guess")
    })

    it("should not update word when word doesn't contains letter", () => {
        let game = new WordGameHandler(new TestWordChooser());

        let word = game.init();
        let wordNotUpdated = game.guess("b");

        expect(word).toEqual(wordNotUpdated);
    })

    it("should update word when word contains letter", () => {
        const chooser = new TestWordChooser();
        let game = new WordGameHandler(chooser);
        game.init();

        expect(game.guess("r")).toEqual("_r______");
        expect(game.guess("c")).toEqual("_rc_____");
    })

    
    it("should update word when word contains letter multiple times", () => {
        const chooser = new TestWordChooser();
        let game = new WordGameHandler(chooser);
        game.init();

        expect(game.guess("a")).toEqual("A__a____");
    })
})