import WordChooserService from "@/Game/services/WordChooserService"

describe("WordChooserService", () => {
    it("should return word from word repository", () => {
        var word = new WordChooserService().get()
        expect(word).not.toBeNull();
    })

    it("should return diffent words every get", () => {
        let service = new WordChooserService()

        let words = new Set();
        for (let i = 0; i < 10; i++) {
            words.add(service.get())
        }   

        expect(words.size).toEqual(10)
    })

})