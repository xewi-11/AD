// src/mai
import GameScene from "./scenes/GameScene.js";

const config = {
  type: Phaser.AUTO,
  width: 1500,
  height: 700,
  physics: {
    default: "arcade",
    arcade: {
      gravity: { y: 0 },
      debug: false,
    },
  },
  scene: [GameScene],
};

const game = new Phaser.Game(config);
