import { mount } from "@vue/test-utils"
import HangmanGameV2 from "@/Game/HangedManGameV2.vue"
import WordDisplay from "@/Game/WordDisplay.vue"
import HangmanGameManager from "../services/HangmanGameManager"

describe("HangmanGameV2", () => {
    it("should render word when component start", () => {
        const managerMock: jest.Mocked<HangmanGameManager> = {
            isValidWord: jest.fn(),
            dictionary: [],
            guess: jest.fn(),
            originalDictionary: [],
            tries: 0,
            validate: jest.fn(),
            word: undefined,
            getWord: jest.fn(() => "bla")
        };

        const wrapper = mount(HangmanGameV2, {
            props: { gameManager: managerMock }
        })

        expect(managerMock.getWord).toBeCalled()
        expect(wrapper.findComponent(WordDisplay).text()).toBe("bla")
    })
})