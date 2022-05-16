import { mount } from "@vue/test-utils"
import HangedManGame from "@/Game/HangedManGame.vue";

describe("HangedManGame.vue", () => {
    it("should render all alphabet letter for player to choose", () => {
        const wrapper = mount(HangedManGame)

        expect(wrapper.findAll("[data-test='guess-input']")).toHaveLength(26)
    })

    it("should disabled letter button when clicked", () => {
        const wrapper = mount(HangedManGame)

        const button = wrapper.find("[data-test='guess-input']")
        button.trigger("click")

        expect(button.text()).toEqual("A")
        expect(button.attributes()).toHaveProperty("disabled")
    })

    it("should display word when created", () => {
        const wrapper = mount(HangedManGame)

        const word = wrapper.find("[data-test='guess-word']")

        expect(word).not.toEqual("")
    })

})