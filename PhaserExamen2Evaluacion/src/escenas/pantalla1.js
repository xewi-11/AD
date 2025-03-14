class pantalla1 extends Phaser.Scene {
  constructor() {
    super({ key: "CardGame" });
  }

  preload() {
    this.load.image("card1", "../../assets/1.png");
    this.load.image("card2", "../../assets/2.png");
    this.load.image("card3", "../../assets/3.png");
    this.load.image("card4", "../../assets/4.png");
    this.load.image("joker", "../../assets/joker.png");
    this.load.image("back", "../../assets/dorso.png");
    this.load.image("casino", "../../assets/casino.png"); // Cargar la imagen de fondo
  }

  create() {
    this.add.image(400, 300, "casino"); // Añadir la imagen de fondo

    this.playerCards = [];
    this.aiCards = [];
    this.playerScore = 0;
    this.aiScore = 0;

    this.playerScoreText = this.add.text(
      600,
      550,
      `Jugador: ${this.playerScore}`,
      { fontSize: "24px", color: "#008000" }
    );
    this.aiScoreText = this.add.text(600, 50, `Máquina: ${this.aiScore}`, {
      fontSize: "24px",
      color: "#008000",
    });

    this.createCards();
  }

  createCards() {
    const cardValues = ["card1", "card2", "card3", "card4", "joker"];
    for (let i = 0; i < 5; i++) {
      let playerValue = cardValues[i];
      let aiValue = "back";

      let jugador = this.add
        .image(150 + i * 120, 400, playerValue)
        .setInteractive();
      let maquinacard = this.add.image(150 + i * 120, 200, aiValue);

      jugador.value = playerValue;
      maquinacard.value = aiValue;

      jugador.on("pointerdown", () => {
        this.flipCard(jugador, maquinacard);
      });

      this.playerCards.push(jugador);
      this.aiCards.push(maquinacard);
    }
  }

  flipCard(jugador, maquinacard) {
    jugador.y = 300;
    jugador.x = 400;
    maquinacard.y = 300;
    maquinacard.x = 600;

    let aiValue = Phaser.Math.RND.pick([
      "card1",
      "card2",
      "card3",
      "card4",
      "joker",
    ]);
    maquinacard.setTexture(aiValue);
    maquinacard.value = aiValue;

    this.compareCards(jugador, maquinacard);
  }

  compareCards(jugador, maquinacard) {
    let playerValue = this.getCardValue(jugador.value);
    let aiValue = this.getCardValue(maquinacard.value);

    if (playerValue === aiValue) {
      jugador.destroy();
      maquinacard.destroy();
    } else if (
      (playerValue === 5 && aiValue !== 1) ||
      (playerValue > aiValue && playerValue !== 5)
    ) {
      this.playerScore++;
      this.playerScoreText.setText(`Jugador: ${this.playerScore}`);
      jugador.y = 500;
      jugador.x = 600;
      maquinacard.y = 500;
      maquinacard.x = 650;
    } else {
      this.aiScore++;
      this.aiScoreText.setText(`Máquina: ${this.aiScore}`);
      jugador.y = 100;
      jugador.x = 600;
      maquinacard.y = 100;
      maquinacard.x = 650;
    }

    if (this.playerCards.length == 0 && this.aiCards.length == 0) {
      this.showEndGameAlert();
    }
  }

  showEndGameAlert() {
    let winnerText;
    if (this.playerScore > this.aiScore) {
      winnerText = `Jugador gana con las cartas: ${this.playerCards
        .map((card) => card.value)
        .join(", ")}`;
    } else if (this.aiScore > this.playerScore) {
      winnerText = `Máquina gana con las cartas: ${this.aiCards
        .map((card) => card.value)
        .join(", ")}`;
    } else {
      winnerText = "Habéis quedado empate";
    }

    alert(winnerText);
  }

  getCardValue(card) {
    switch (card) {
      case "card1":
        return 1;
      case "card2":
        return 2;
      case "card3":
        return 3;
      case "card4":
        return 4;
      case "joker":
        return 5;
      default:
        return 0;
    }
  }
}

// Exportar la clase pantalla1 como valor predeterminado
export default pantalla1;
