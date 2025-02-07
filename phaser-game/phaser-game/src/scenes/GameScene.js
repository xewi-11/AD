const PLAYER_SPEED = 200;
const BULLET_SPEED = 400;
const FIRE_DELAY = 250;
const MAX_BULLETS = 10;

class GameScene extends Phaser.Scene {
  constructor() {
    super({ key: "GameScene" });
  }

  preload() {
    this.load.image("character1", "assets/characters/joker_copy.png");
    this.load.image("character2", "assets/characters/joker.png");
    this.load.image("bullet", "assets/bullets/torpedo.png");
  }

  create() {
    this.player1 = this.physics.add.sprite(
      100,
      this.cameras.main.centerY,
      "character1"
    );
    this.player2 = this.physics.add.sprite(
      700,
      this.cameras.main.centerY,
      "character2"
    );

    this.player1.setCollideWorldBounds(true);
    this.player2.setCollideWorldBounds(true);

    this.cursors1 = this.input.keyboard.addKeys({
      up: "W",
      down: "S",
      fire: "D",
    });
    this.cursors2 = this.input.keyboard.addKeys({
      up: "UP",
      down: "DOWN",
      fire: "LEFT",
    });

    this.bullets1 = this.physics.add.group({
      classType: Phaser.Physics.Arcade.Image,
      runChildUpdate: true,
    });
    this.bullets2 = this.physics.add.group({
      classType: Phaser.Physics.Arcade.Image,
      runChildUpdate: true,
    });

    this.lastFired1 = 0;
    this.lastFired2 = 0;

    this.bulletsRemaining1 = MAX_BULLETS;
    this.bulletsRemaining2 = MAX_BULLETS;

    this.shotsFired1 = 0;
    this.shotsFired2 = 0;

    this.bulletsImages1 = this.add.group({
      key: "bullet",
      repeat: MAX_BULLETS - 1,
      setXY: { x: 50, y: 50, stepX: 20 },
    });
    this.bulletsImages2 = this.add.group({
      key: "bullet",
      repeat: MAX_BULLETS - 1,
      setXY: { x: 650, y: 50, stepX: 20 },
    });

    this.player1Text = this.add.text(50, 30, "Jugador 1", {
      fontSize: "20px",
      fill: "#fff",
    });
    this.player2Text = this.add.text(650, 30, "Jugador 2", {
      fontSize: "20px",
      fill: "#fff",
    });

    this.player1Countdown = this.add.text(50, 70, "", {
      fontSize: "20px",
      fill: "#fff",
    });
    this.player2Countdown = this.add.text(650, 70, "", {
      fontSize: "20px",
      fill: "#fff",
    });

    this.triangle1 = this.add.triangle(400, 200, 0, 0, 20, 40, 40, 0, 0xff0000);
    this.triangle2 = this.add.triangle(400, 400, 0, 0, 20, 40, 40, 0, 0x0000ff);

    this.physics.add.existing(this.triangle1);
    this.physics.add.existing(this.triangle2);

    this.triangle1.body.setVelocityY(100);
    this.triangle2.body.setVelocityY(-150);

    this.physics.add.collider(
      this.bullets1,
      this.player2,
      this.handlePlayerHit,
      null,
      this
    );
    this.physics.add.collider(
      this.bullets2,
      this.player1,
      this.handlePlayerHit,
      null,
      this
    );

    this.gameOver = false;
  }

  update(time) {
    if (!this.gameOver) {
      this.handlePlayerMovement(this.player1, this.cursors1);
      this.handlePlayerMovement(this.player2, this.cursors2);

      this.handleShooting(
        this.player1,
        this.cursors1,
        this.bullets1,
        time,
        this.lastFired1,
        (time) => (this.lastFired1 = time),
        () => this.bulletsRemaining1--,
        this.bulletsImages1,
        this.player1Countdown,
        () => this.shotsFired1++
      );
      this.handleShooting(
        this.player2,
        this.cursors2,
        this.bullets2,
        time,
        this.lastFired2,
        (time) => (this.lastFired2 = time),
        () => this.bulletsRemaining2--,
        this.bulletsImages2,
        this.player2Countdown,
        () => this.shotsFired2++
      );

      this.checkForDraw();
    }

    this.handleTriangleMovement(this.triangle1);
    this.handleTriangleMovement(this.triangle2);
  }

  handlePlayerMovement(player, cursors) {
    if (cursors.up.isDown) {
      player.setVelocityY(-PLAYER_SPEED);
    } else if (cursors.down.isDown) {
      player.setVelocityY(PLAYER_SPEED);
    } else {
      player.setVelocityY(0);
    }
  }

  handleShooting(
    player,
    cursors,
    bullets,
    time,
    lastFired,
    setLastFired,
    decrementBullets,
    bulletsImages,
    countdownText,
    incrementShotsFired
  ) {
    if (
      cursors.fire.isDown &&
      time > lastFired + FIRE_DELAY &&
      bullets.countActive(true) < MAX_BULLETS
    ) {
      const bullet = bullets.get(player.x, player.y, "bullet");
      if (bullet) {
        bullet.setActive(true);
        bullet.setVisible(true);
        bullet.body.velocity.x =
          player === this.player1 ? BULLET_SPEED : -BULLET_SPEED;
        setLastFired(time);
        decrementBullets();
        incrementShotsFired();
        this.updateBulletsImages(player, bulletsImages);

        if (
          (player === this.player1 && this.shotsFired1 % 2 === 0) ||
          (player === this.player2 && this.shotsFired2 % 2 === 0)
        ) {
          countdownText.setText("Espera 3 segundos");
          player.setVelocityY(0); // Detener el movimiento del jugador
          player.canShoot = false; // Deshabilitar disparo
          this.time.delayedCall(3000, () => {
            countdownText.setText("");
            player.canShoot = true; // Habilitar disparo después de 3 segundos
          });
        }
      }
    }
  }

  updateBulletsImages(player, bulletsImages) {
    const bulletsRemaining =
      player === this.player1 ? this.bulletsRemaining1 : this.bulletsRemaining2;
    bulletsImages.children.iterate((bulletImage, index) => {
      bulletImage.setVisible(index < bulletsRemaining);
    });
  }

  handleTriangleMovement(triangle) {
    if (triangle.y <= 0 || triangle.y >= this.cameras.main.height) {
      triangle.body.setVelocityY(triangle.body.velocity.y * -1);
    }
  }

  handlePlayerHit(player, bullet) {
    bullet.destroy();
    this.add.text(
      300,
      250,
      `${player === this.player1 ? "Jugador 2" : "Jugador 1"} gana!`,
      { fontSize: "40px", fill: "#fff" }
    );
    this.physics.pause();
    this.gameOver = true;
  }

  checkForDraw() {
    if (this.bulletsRemaining1 === 0 && this.bulletsRemaining2 === 0) {
      this.add.text(300, 250, "Empate!", { fontSize: "40px", fill: "#fff" });
      this.physics.pause();
      this.gameOver = true;
    }
  }
}

export default GameScene;
