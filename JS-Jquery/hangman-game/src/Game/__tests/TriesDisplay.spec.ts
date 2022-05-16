import { mount } from "@vue/test-utils"
import TriesDisplay from "@/Game/TriesDisplay.vue"

describe("TriesDisplay.vue", () => {
    it("not render with 0 tries", () => {
        const wrapper = mount(TriesDisplay, { props: { triesCount: 0 } })
        expect(wrapper.findAll("img").length).toEqual(0)
    })

    it("renders tries icons", () => {
        const wrapper = mount(TriesDisplay, { props: { triesCount: 3 } })
        expect(wrapper.findAll("img")).toHaveLength(3)
    })
})