import MainScene from "./scenes/MainScene.js";
import LaserScene from "./scenes/LaserScene.js";

const config = {
  type: Phaser.AUTO,
  width: window.innerWidth,
  height: window.innerHeight,
  physics: {
    default: "arcade",
    arcade: {
      gravity: { y: 0 },
      debug: false,
    },
  },
  scene: [MainScene, LaserScene],
};

const game = new Phaser.Game(config);

export { game };
