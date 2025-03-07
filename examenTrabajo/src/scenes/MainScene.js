class MainScene extends Phaser.Scene {
  constructor() {
    super({ key: "MainScene" });
  }

  init(data) {
    this.playerName = data.playerName;
    this.playerScore = data.playerScore;
  }

  preload() {
    this.load.image("personaje", "./images/personaje.png");
    this.load.image("espada", "./images/espada.png");
    this.load.image("escudo", "./images/escudo.png");
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
    this.personaje = this.physics.add.sprite(400, 500, "personaje");
    this.cursors = this.input.keyboard.createCursorKeys();
    this.espadas = this.physics.add.group();
    this.llamaradas = this.physics.add.group();
    this.congelar = this.physics.add.group();
    this.escudoActivo = false;
    this.tiempoEscudo = 0;
    this.puntuacion = this.playerScore || 0;
    this.tiempoUltimaEspada = 0;
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
      this.espadas,
      this.hitEspada,
      null,
      this
    );

    this.physics.add.collider(
      this.llamaradas,
      this.espadas,
      this.hitLlamarada,
      null,
      this
    );

    this.physics.add.collider(
      this.congelar,
      this.espadas,
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

    // Añadir puntuaciones
    this.input.keyboard.on("keydown-M", () => {
      const playerName = prompt("Ingrese nombre para actualizar");
      const scoreValue = parseInt(prompt("Ingrese su puntuación:"));
      if (playerName && !isNaN(scoreValue)) {
        this.puntuacion = scoreValue;
        this.scoreText.setText("Puntuación: " + this.puntuacion);
        this.updateScore(playerName, scoreValue);
      }
    });

    // Escuchar la tecla "I" para lanzar ataques
    this.input.keyboard.on("keydown-I", () => {
      if (this.teclaAtaque.enabled) {
        this.lanzarLlamarada();
      } else if (this.teclaAtaque.enabled) {
        this.lanzarCongelar();
      }
    });

    // Cargar puntuaciones al inicio del juego
    this.loadScores();
  }

  startGame() {
    this.startTime = this.time.now;
    this.timeText.setText("Tiempo: 0");
    this.scoreText.setText("Puntuación: " + this.puntuacion);
    this.add.text(10, 90, "Jugador: " + this.playerName, {
      fontSize: "32px",
      fill: "#fff",
    });
  }

  update(time) {
    if (!this.playerName) {
      return; // No actualizar el juego hasta que se haya agregado un jugador
    }

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

    if (time > this.tiempoUltimaEspada + 1000) {
      this.crearEspada();
      this.tiempoUltimaEspada = time;
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

    if (elapsedTime >= 180) {
      this.updateScore(this.playerName, this.playerScore);
      this.scene.start("LaserScene", {
        playerName: this.playerName,
        puntuacion: this.playerScore,
      });
    }
  }

  crearEspada() {
    const x = Phaser.Math.Between(0, 800);
    const espada = this.espadas.create(x, 0, "espada");
    espada.setVelocityY(Phaser.Math.Between(100, 300));
  }

  activarEscudo() {
    this.escudoActivo = true;
    this.tiempoEscudo = this.time.now + 2000;
    this.personaje.setTexture("escudo");
    this.time.delayedCall(2000, () => {
      this.escudoActivo = false;
      this.personaje.setTexture("personaje");
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

  hitEspada(personaje, espada) {
    if (!this.escudoActivo) {
      this.updateScore(this.playerName, this.puntuacion);
      this.scene.start("MainScene", {
        playerName: this.playerName,
        playerScore: this.puntuacion,
      });
    }
    espada.destroy();
  }

  hitLlamarada(llamarada, espada) {
    llamarada.destroy();
    espada.destroy();
  }

  hitCongelar(congelar, espada) {
    congelar.destroy();
    espada.setTexture("congelar");
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
    this.espadas.children.iterate((espada) => {
      espada.setVelocityY(espada.body.velocity.y * 1.1);
    });
    this.time.delayedCall(15000, () => {
      this.espadas.children.iterate((espada) => {
        espada.setVelocityY(espada.body.velocity.y / 1.1);
      });
    });
  }

  collectRelampagoVerde(personaje, relampagoVerde) {
    relampagoVerde.destroy();
    this.espadas.children.iterate((espada) => {
      espada.setVelocityY(espada.body.velocity.y * 1.1);
    });
    this.time.delayedCall(15000, () => {
      this.espadas.children.iterate((espada) => {
        espada.setVelocityY(espada.body.velocity.y / 1.1);
      });
    });
  }

  collectRedimensionar(personaje, redimensionar) {
    redimensionar.destroy();
    this.espadas.children.iterate((espada) => {
      espada.setTexture("espadaGrande");
    });
    this.personaje.setTexture("personajeGrande");
    this.laser.setTexture("laserGrande");

    this.time.delayedCall(20000, () => {
      this.espadas.children.iterate((espada) => {
        espada.setTexture("espada");
      });
      this.personaje.setTexture("personaje");
      this.laser.setTexture("laser");
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

  insertScore(player, score) {
    fetch("http://localhost:3000/api/scores", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ playerName: player, score: score }),
    })
      .then((response) => response.json())
      .then(() => {
        this.loadScores(); // Recargar las puntuaciones
        console.log("insertado correctamente");
      })
      .catch((error) => {
        console.error("Error al insertar la puntuación:", error);
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
          this.scores = data; // Almacenar las puntuaciones en la variable 'scores'
          this.updateScoreboard(); // Actualizar la visualización de puntuaciones
        }
      })
      .catch((error) => {
        console.error("Error al cargar las puntuaciones:", error);
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
        return 0; // En caso de error, devolver 0
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
          this.puntuacion = data.score;
          this.startGame();
        }
      })
      .catch((error) => {
        console.error("Error al verificar el jugador:", error);
      });
  }
}

export default MainScene;
