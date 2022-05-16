<template>
  <div>
    <tries-display :triesCount="triesLeft" />
    <word-display :word="word" />
    <div v-if="!isGameFinished" class="inputs-holder">
      <div
        v-for="letter in alphabet"
        :key="letter"
        @click="guessLetter(letter, $event)"
        class="letter-input"
        data-test="guess-input"
      >
        {{ letter }}
      </div>
    </div>
    <div v-if="isGameFinished" class="game-over-holder">
      <div v-if="itGuessedRight" class="winner" data-test="winner-message">
        Você manja das paradas, acertou miserávi.
      </div>
      <div v-else class="loser" data-test="loser-message">
        Foi dessa vez não, relaxa que pelo menos programação vc aprendeu hoje.
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Options, Vue } from "vue-class-component";
import WordChooserService from "./services/WordChooserService";
import WordGameHandler from "./services/WordGameHandler";
import TriesDisplay from "./TriesDisplay.vue";
import WordDisplay from "./WordDisplay.vue";

@Options({
  components: { TriesDisplay, WordDisplay },
})
export default class HangedManGame extends Vue {
  alphabet: string[] = [];
  word = "";
  gameHandler!: WordGameHandler;
  triesLeft = 3;
  isGameFinished = false;
  itGuessedRight = false;

  created() {
    this.alphabet = [
      "A",
      "B",
      "C",
      "D",
      "E",
      "F",
      "G",
      "H",
      "I",
      "J",
      "K",
      "L",
      "M",
      "N",
      "O",
      "P",
      "Q",
      "R",
      "S",
      "T",
      "U",
      "V",
      "W",
      "X",
      "Y",
      "Z",
    ];

    this.gameHandler = new WordGameHandler(new WordChooserService());
    this.word = this.gameHandler.init();
  }

  guessLetter(letter: string, event: Event) {
    let target = event.target as HTMLSpanElement;

    if (target.hasAttribute("disabled")) return;

    target.setAttribute("disabled", "");
    const guess = this.gameHandler.tryGuess(letter.toLowerCase());

    this.word = guess.word;
    if (!guess.isCorrect) this.triesLeft--;

    if (this.triesLeft === 0) {
      this.isGameFinished = true;
      this.itGuessedRight = false;
    }

    if (!this.word.includes("_")) {
      this.isGameFinished = true;
      this.itGuessedRight = true;
    }
  }
}
</script>

<style lang="scss" scoped>
.inputs-holder {
  display: grid;
  margin: 100px;
  justify-content: center;
  grid-template-columns: 200px 200px 200px;
  grid-row-gap: 1em;
  grid-column-gap: 1em;
}

.letter-input {
  border: 1px solid #1fa31f;
  border-radius: 6px;
  padding: 5px 10px;
  color: #1fa31f;
  max-width: 100px;
  cursor: pointer;

  &:hover {
    color: white;
    background: #1fa31f;
  }

  &[disabled] {
    cursor: default;
    border-color: gray;
    background: gray;
    color: white;
  }
}

.game-over-holder {
  font-size: 3em;
  font-weight: bold;

  .winner {
    color: #20a920;
  }

  .loser {
    color: #c16617;
  }
}
</style>
