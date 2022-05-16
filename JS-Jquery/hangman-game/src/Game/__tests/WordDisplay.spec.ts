import { mount } from "@vue/test-utils"
import WordDisplay from "@/Game/WordDisplay.vue"

describe("WordDisplay.vue", () => {
    it("not renders any letters when word parameter is empty", () => {
        let word = undefined;
        const wrapper = mount(WordDisplay, { props: { word } })

        expect(wrapper.text()).toEqual("")
    })

    it("renders all letters as underscores", () => {
        let word = "bi_u_a";
        const wrapper = mount(WordDisplay, { props: { word } })

        expect(wrapper.text()).toEqual(word)
    })
})