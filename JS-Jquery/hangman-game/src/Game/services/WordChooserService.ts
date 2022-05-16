export abstract class WordChooser {
  abstract get(): { word: string; meaning: string; }
}

class WordChooserService extends WordChooser {
    wordRepo: { word: string; meaning: string; }[];
    currentWordIndex: number;

    constructor() {
        super();
        this.currentWordIndex = 0;
        this.wordRepo = [
            {
                word: "Balacobaco",
                meaning: "festa, qualidade ou beleza excepcionais."
            },
            {
                word: "Birosca",
                meaning: "pequena venda simples, misto de mercearia e bar.."
            },
            {
                word: "Bugiganga",
                meaning: "objeto de pouco ou nenhum valor, quinquilharia."
            },
            {
                word: "Bulhufas",
                meaning: "coisa alguma, nada."
            },
            {
                word: "Chumbrega",
                meaning: "de má qualidade, comum."
            },
            {
                word: "Espelunca",
                meaning: "lugar mal frequentado, sem asseio."
            },
            {
                word: "Faniquito",
                meaning: "chilique."
            },
            {
                word: "Galalau",
                meaning: "homem de estatura elevada, galalão."
            },
            {
                word: "Gororoba",
                meaning: "homem de estatura elevada, galalão."
            },
            {
                word: "Mequetrefe",
                meaning: "indivíduo sem importância, inútil."
            },
            {
                word: "Mixuruca",
                meaning: "de pouca qualidade, ruim."
            },
            {
                word: "Pindaíba",
                meaning: "condição de falta de dinheiro."
            },
            {
                word: "Sacripanta",
                meaning: "aquele que é velhaco, patife, indigno."
            },
            {
                word: "Salamaleque",
                meaning: "saudação cerimonial entre os muçulmanos, cumprimento exagerado (figurado informal)."
            },
            {
                word: "Serelepe",
                meaning: "esperto, vivo."
            },
            {
                word: "Songamonga",
                meaning: "mula de médico (origem), pessoa sonsa."
            },
            {
                word: "Tribufu",
                meaning: "pessoa feia."
            },
            {
                word: "Urucubaca",
                meaning: "má sorte, feitiço."
            },
            {
                word: "Xexelento",
                meaning: "de pouco valor."
            },
            {
                word: "Ziquizira",
                meaning: "má sorte, feitiço, doença vaga ou de causa não esclarecida."
            },
        ]
    }

    get() {
        return this.wordRepo[this.currentWordIndex++]
    }
}

export default WordChooserService;