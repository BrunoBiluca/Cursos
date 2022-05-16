<template>
  <div class="word-display" data-test="guess-word">{{ word }}</div>
</template>

<script lang="ts">
import { Options, Vue } from "vue-class-component";

@Options({
  props: {
    word: String,
  },
})
export default class WordDisplay extends Vue {
  word!: string;
}
</script>

<style lang="scss" scoped>
.word-display {
  font-size: 3em;
  font-weight: bold;
  letter-spacing: 1em;
  margin: 1em 0;
}
</style>
