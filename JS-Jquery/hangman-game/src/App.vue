<template>
  <!-- <hanged-man-game /> -->
  <hanged-man-game-v-2 :gameManager="gameManager" />
</template>

<script lang="ts">
import { Options, Vue } from "vue-class-component";
import HangedManGame from "@/Game/HangedManGame.vue";
import HangedManGameV2 from "@/Game/HangedManGameV2.vue";
import HangmanGameManager from "./Game/services/HangmanGameManager";

@Options({
  components: {
    HangedManGame,
    HangedManGameV2
  },
})
export default class App extends Vue {
  gameManager!: HangmanGameManager;

  created(){
    this.gameManager = new HangmanGameManager(["To aki Sabadin"])
  }
}
</script>

<style lang="scss">
body{
  background-image: url("@/assets/18410.jpg");
  background-size: cover;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
