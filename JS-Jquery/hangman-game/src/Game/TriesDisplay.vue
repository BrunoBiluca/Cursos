<template>
  <div>
    <p>Tentativas</p>
    <div>
      <img
        v-for="index in triesCount"
        :key="index"
        alt="Try icon"
        src="../assets/logo.png"
      />
    </div>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from "vue-class-component";

@Options({
  props: {
    triesCount: Number,
  },
})
export default class TriesDisplay extends Vue {}
</script>

<style lang="scss" scoped>
img {
  margin: 0 1em;
  max-width: 100px;
}
</style>
