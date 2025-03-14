import pantalla1 from "./escenas/pantalla1.js";

const config = {
  type: Phaser.AUTO,
  width: 800,
  height: 600,
  scene: pantalla1,
  physics: {
    default: "arcade",
    arcade: {
      gravity: { y: 300 },
      debug: false,
    },
  },
};

const game = new Phaser.Game(config);
