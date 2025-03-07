class LaserScene extends Phaser.Scene {
  constructor() {
    super({ key: "LaserScene" });
  }

  init(data) {
    this.playerName = data.playerName;
    this.playerScore = data.playerScore;
  }

  preload() {
    this.load.image("personajeVerde", "./images/personaje-del-juego.png");
    this.load.image("laser", "./images/laser.png");
    this.load.image("fuego", "./images/fuego.png");
    this.load.image("llamarada", "./images/incendios.png");
    this.load.image("copo", "./images/copo.png");
    this.load.image("congelar", "./images/congelar.png");
    this.load.image("relampago", "./images/relampago.png");
    this.load.image("relampagoVerde", "./images/relampagoVerde.png");
    this.load.image("redimensionar", "./images/redimensionar.png");
    this.load.image("espadaGrande", "./images/espadaGrande.png");
    this.load.image("personajeGrande", "./images/personajeGrande.png");
    this.load.image("laserGrande", "./images/laserGrande.png");
    this.load.image(
      "personaje-del-juegoGrande",
      "./images/personaje-del-juegoGrande.png"
    );
  }

  create() {
    this.personaje = this.physics.add.sprite(400, 500, "personajeVerde");
    this.cursors = this.input.keyboard.createCursorKeys();
    this.lasers = this.physics.add.group();
    this.llamaradas = this.physics.add.group();
    this.congelar = this.physics.add.group();
    this.escudoActivo = false;
    this.tiempoEscudo = 0;
    this.tiempoUltimoLaser = 0;
    this.teclaEscudo = this.input.keyboard.addKey(
      Phaser.Input.Keyboard.KeyCodes.E
    );
    this.teclaAtaque = this.input.keyboard.addKey(
      Phaser.Input.Keyboard.KeyCodes.I
    );
    this.startTime = this.time.now;
    this.timeText = this.add.text(10, 10, "Tiempo: 0", {
      fontSize: "32px",
      fill: "#fff",
    });
    this.scoreText = this.add.text(10, 50, "Puntuación: " + this.puntuacion, {
      fontSize: "32px",
      fill: "#fff",
    });

    this.physics.add.collider(
      this.personaje,
      this.lasers,
      this.hitLaser,
      null,
      this
    );

    this.physics.add.collider(
      this.llamaradas,
      this.lasers,
      this.hitLlamarada,
      null,
      this
    );

    this.physics.add.collider(
      this.congelar,
      this.lasers,
      this.hitCongelar,
      null,
      this
    );

    this.physics.add.overlap(
      this.personaje,
      this.fuego,
      this.collectFuego,
      null,
      this
    );

    this.physics.add.overlap(
      this.personaje,
      this.copo,
      this.collectCopo,
      null,
      this
    );

    this.physics.add.overlap(
      this.personaje,
      this.relampago,
      this.collectRelampago,
      null,
      this
    );

    this.physics.add.overlap(
      this.personaje,
      this.relampagoVerde,
      this.collectRelampagoVerde,
      null,
      this
    );

    this.physics.add.overlap(
      this.personaje,
      this.redimensionar,
      this.collectRedimensionar,
      null,
      this
    );

    this.spawnItem();

    // Escuchar la tecla "Espacio" para agregar un jugador
    this.input.keyboard.on("keydown-SPACE", () => {
      const playerName = prompt("Ingrese su nombre:");
      if (playerName) {
        this.checkPlayerExists(playerName);
      }
    });

    // Escuchar la tecla "I" para lanzar ataques
    this.input.keyboard.on("keydown-I", () => {
      if (this.teclaLlamarada.enabled) {
        this.lanzarLlamarada();
      } else if (this.teclaCongelar.enabled) {
        this.lanzarCongelar();
      }
    });

    this.updateScore(this.playerName, this.playerScore);
  }

  update(time) {
    if (this.cursors.left.isDown) {
      this.personaje.setVelocityX(-200);
    } else if (this.cursors.right.isDown) {
      this.personaje.setVelocityX(200);
    } else {
      this.personaje.setVelocityX(0);
    }

    if (this.cursors.up.isDown) {
      this.personaje.setVelocityY(-200);
    } else if (this.cursors.down.isDown) {
      this.personaje.setVelocityY(200);
    } else {
      this.personaje.setVelocityY(0);
    }

    if (this.teclaEscudo.isDown && time > this.tiempoEscudo) {
      this.activarEscudo();
    }

    if (time > this.tiempoUltimoLaser + 1000) {
      this.crearLaser();
      this.tiempoUltimoLaser = time;
    }

    const elapsedTime = Math.floor((time - this.startTime) / 200);
    this.timeText.setText("Tiempo: " + elapsedTime);

    if (
      elapsedTime % 60 === 0 &&
      elapsedTime !== 0 &&
      this.puntuacionIncrementada !== elapsedTime
    ) {
      this.puntuacion += 100;
      this.puntuacionIncrementada = elapsedTime;
    }
    this.scoreText.setText("Puntuación: " + this.puntuacion);
    this.add.text(10, 90, "Jugador: " + this.playerName, {
      fontSize: "32px",
      fill: "#fff",
    });
  }

  crearLaser() {
    const x = Phaser.Math.Between(0, 800);
    const laser = this.lasers.create(x, 0, "laser");
    laser.setVelocityY(Phaser.Math.Between(100, 300));
  }

  activarEscudo() {
    this.escudoActivo = true;
    this.tiempoEscudo = this.time.now + 2000;
    this.personaje.setTexture("escudo");
    this.time.delayedCall(2000, () => {
      this.escudoActivo = false;
      this.personaje.setTexture("personajeVerde");
    });
  }

  lanzarLlamarada() {
    const llamarada = this.llamaradas.create(
      this.personaje.x,
      this.personaje.y,
      "llamarada"
    );
    llamarada.setVelocityY(-300);
  }

  lanzarCongelar() {
    const congelar = this.congelar.create(
      this.personaje.x,
      this.personaje.y,
      "congelar"
    );
    congelar.setVelocityY(-300);
  }

  hitLaser(personaje, laser) {
    if (!this.escudoActivo) {
      this.updateScore(this.playerName, this.playerScore);
      this.scene.start("MainScene", {
        playerName: this.playerName,
        playerScore: 0,
      });
    }
    laser.destroy();
  }

  hitLlamarada(llamarada, laser) {
    llamarada.destroy();
    laser.destroy();
  }

  hitCongelar(congelar, laser) {
    congelar.destroy();
    laser.setTexture("congelar");
  }

  collectFuego(personaje, fuego) {
    fuego.destroy();
    this.teclaLlamarada.enabled = true;
    this.time.delayedCall(15000, () => {
      this.teclaLlamarada.enabled = false;
    });
  }

  collectCopo(personaje, copo) {
    copo.destroy();
    this.teclaCongelar.enabled = true;
    this.time.delayedCall(15000, () => {
      this.teclaCongelar.enabled = false;
    });
  }

  collectRelampago(personaje, relampago) {
    relampago.destroy();
    this.lasers.children.iterate((laser) => {
      laser.setVelocityY(laser.body.velocity.y * 1.1);
    });
    this.time.delayedCall(15000, () => {
      this.lasers.children.iterate((laser) => {
        laser.setVelocityY(laser.body.velocity.y / 1.1);
      });
    });
  }

  collectRelampagoVerde(personaje, relampagoVerde) {
    relampagoVerde.destroy();
    this.lasers.children.iterate((laser) => {
      laser.setVelocityY(laser.body.velocity.y * 1.1);
    });
    this.time.delayedCall(15000, () => {
      this.lasers.children.iterate((laser) => {
        laser.setVelocityY(laser.body.velocity.y / 1.1);
      });
    });
  }

  loadScore(playerName) {
    return fetch(`http://localhost:3000/api/scores/${playerName}`)
      .then((response) => response.json())
      .then((data) => {
        if (data.score !== undefined) {
          return data.score; // Retorna la puntuación
        } else {
          console.log("Jugador no encontrado o no tiene puntuación");
          return 0; // Si no hay puntuación, devolver 0
        }
      })
      .catch((error) => {
        console.error("Error al obtener la puntuación:", error);
        return 0; // En caso de error, devolver 0
      });
  }

  collectRedimensionar(personaje, redimensionar) {
    redimensionar.destroy();
    this.lasers.children.iterate((laser) => {
      laser.setScale(1.1);
      laser.setTexture("laserGrande");
    });
    this.personaje.setScale(1.05);
    this.personaje.setTexture("personajeGrande");
    this.time.delayedCall(20000, () => {
      this.lasers.children.iterate((laser) => {
        laser.setScale(1);
        laser.setTexture("laser");
      });
      this.personaje.setScale(1);
      this.personaje.setTexture("personajeVerde");
    });
  }

  spawnItem() {
    const items = [
      "fuego",
      "copo",
      "relampago",
      "relampagoVerde",
      "redimensionar",
    ];
    const item = items[Phaser.Math.Between(0, items.length - 1)];
    const x = Phaser.Math.Between(0, 800);
    const y = Phaser.Math.Between(0, 600);
    this[item] = this.physics.add.sprite(x, y, item);
    this.time.delayedCall(10000, () => {
      if (this[item]) {
        this[item].destroy();
      }
      this.spawnItem();
    });
  }

  updateScore(player, score) {
    this.loadScore(player).then((currentScore) => {
      if (score > currentScore) {
        const elapsedTime = Math.floor((this.time.now - this.startTime) / 1000);
        fetch(`http://localhost:3000/api/scores/${player}`, {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            score: score,
            scene: this.scene.key,
            time: elapsedTime,
          }),
        })
          .then((response) => response.json())
          .then(() => {
            this.loadScores(); // Recargar las puntuaciones
            console.log("Actualizado correctamente");
          })
          .catch((error) => {
            console.error("Error al actualizar la puntuación:", error);
          });
      }
    });
  }

  loadScores() {
    fetch("http://localhost:3000/api/scores")
      .then((response) => response.json())
      .then((data) => {
        if (data.length === 0) {
          alert(
            "No hay jugadores en la base de datos. Por favor, agregue uno."
          );
        } else {
          this.scores = data.scores; // Almacenar las puntuaciones en la variable 'scores'
          this.updateScoreboard(); // Actualizar la visualización de puntuaciones
        }
      })
      .catch((error) => {
        console.error("Error al cargar las puntuaciones:", error);
      });
  }

  updateScoreboard() {
    const topScores = this.scores.slice(0, 10); // Solo mostrar las 10 mejores puntuaciones
    let text = "\n\nTop 10 Puntuaciones:\n";
    topScores.forEach((score, index) => {
      text += `${index + 1}. ${score.playerName || score.player}: ${
        score.score
      }\n`;
    });

    // Mostrar las puntuaciones en la escena de Phaser
    if (this.scoreboardText) {
      this.scoreboardText.setText(text); // Actualizar el texto
    } else {
      this.scoreboardText = this.add.text(20, 100, text, {
        font: "20px Arial",
        fill: "#fff",
      });
    }
  }

  checkPlayerExists(playerName) {
    fetch(`http://localhost:3000/api/scores/${playerName}`)
      .then((response) => {
        if (!response.ok) {
          if (response.status === 404) {
            // Jugador no encontrado, insertar nuevo jugador
            this.insertScore(playerName, 0);
            this.playerName = playerName;
            this.startGame();
          } else {
            throw new Error("Error al verificar el jugador");
          }
        } else {
          return response.json();
        }
      })
      .then((data) => {
        if (data) {
          this.playerName = playerName;
          this.playerScore = data.score;
          this.startGame();
        }
      })
      .catch((error) => {
        console.error("Error al verificar el jugador:", error);
      });
  }
}

export default LaserScene;
