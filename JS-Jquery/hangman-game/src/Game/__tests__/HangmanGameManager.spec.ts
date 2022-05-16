import HangmanGameManager from "../services/HangmanGameManager"

describe("HangmanGameManager.ts", () => {

    let getValidDictionary = () => [
        "Pirulito",
        "BateBate"
    ]

    let getInvalidDictionary = () => [
        "Beija-Flor",
        "Pirulito",
        "BateBate"
    ]

    it("should not return choice word as undefined when dictionary is valid", () => {
        let word = new HangmanGameManager(getValidDictionary()).getWord()

        expect(word).not.toBeUndefined();
    })

    it("should throw an error when dictionary is not valid", () => {
        expect(() => new HangmanGameManager(getInvalidDictionary())).toThrowError()
        expect(() => new HangmanGameManager([])).toThrowError()
    })

    it("should return a valid word when requested", () => {
        let word = new HangmanGameManager(getValidDictionary()).getWord()

        expect(word.length).toBeGreaterThan(0)
    })

    it("should return multiple words different when requested", () => {
        const manager = new HangmanGameManager(getValidDictionary());
        let word = manager.getWord()
        let word2 = manager.getWord()

        expect(word).not.toEqual(word2)
    })

    it("should reset dictionary when all words were used", () => {
        const manager = new HangmanGameManager(getValidDictionary());

        expect(manager.getWord().length).toBeGreaterThan(0)
        expect(manager.getWord().length).toBeGreaterThan(0)

        expect(manager.getWord().length).toBeGreaterThan(0)
    })

    it("should not have tries when word was not choose", () => {
        const manager = new HangmanGameManager(getValidDictionary());
        expect(manager.tries).toBe(0)
    })

    it("should return tries when word was choose", () => {
        const manager = new HangmanGameManager(getValidDictionary());
        manager.getWord()
        expect(manager.tries).not.toBe(0)
    })

    it("should not guess before choose a word", () => {
        const manager = new HangmanGameManager(["Pirulito"]);

        expect(() => manager.guess("A")).toThrowError();
    })

    it("should maintain tries count when guess is right", () => {
        const manager = new HangmanGameManager(["Pirulito"]);
        manager.getWord();

        let originalTries = manager.tries;

        manager.guess("i");

        expect(manager.tries).toBe(originalTries);
    })

    it("should decrease tries when guess is wrong", () => {
        const manager = new HangmanGameManager(["Pirulito"]);
        manager.getWord();

        let originalTries = manager.tries;

        manager.guess("A");

        expect(manager.tries).toBeLessThan(originalTries);
    })
})