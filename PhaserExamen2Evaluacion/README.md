# Crear un Juego en Phaser

Este documento explica cómo crear un juego en Phaser utilizando el ejemplo proporcionado.

## Requisitos

- Node.js
- Un servidor web para servir los archivos (puede ser un servidor local como `http-server`)

## Estructura del Proyecto

El proyecto tiene la siguiente estructura de archivos:

```
Phaser01/
├── assets/
│   ├── bomb.png
│   ├── dude.png
│   ├── enemigo.png
│   ├── ground.png
│   ├── pistola.png
│   ├── sky.png
│   ├── sky2.png
│   ├── star.png
│   ├── torpedo.png
│   ├── sonidos/
│       ├── ok1.ogg
│       ├── enemigoKO.ogg
│       ├── pistola.ogg
├── src/
│   ├── componentes/
│   │   ├── button.js
│   │   ├── play-button.js
│   ├── escenas/
│   │   ├── gameover.js
│   │   ├── menu.js
│   │   ├── pantalla01.js
│   │   ├── pantalla02.js
│   ├── main.js
├── index.html
├── ejemplo.json
├── README.md
```

## Configuración del Proyecto

1. Clona el repositorio o descarga los archivos del proyecto.
2. Abre una terminal en la carpeta del proyecto.
3. Si no tienes un servidor web instalado, puedes instalar `http-server` ejecutando:
   ```sh
   npm install -g http-server
   ```
4. Inicia el servidor web en la carpeta del proyecto:
   ```sh
   http-server
   ```
5. Abre tu navegador web y navega a `http://localhost:8080` (o el puerto que indique tu servidor).

## Archivos Principales

### index.html

Este archivo HTML carga Phaser y el archivo principal `main.js`.

```html
<!-- filepath: /c:/Users/alons/OneDrive/Escritorio/AD/DAM2/Phaser01/index.html -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Making your first Phaser 3 Game - Part 1</title>
    <script src="//cdn.jsdelivr.net/npm/phaser@3.11.0/dist/phaser.js"></script>
    <style type="text/css">
      body {
        margin: 0;
      }
    </style>
  </head>
  <body>
    <script type="module" src="src/main.js"></script>
  </body>
</html>
```

### main.js

Este archivo configura el juego y define las escenas.

```javascript
// filepath: /c:/Users/alons/OneDrive/Escritorio/AD/DAM2/Phaser01/src/main.js
import { pantalla01 } from "./escenas/pantalla01.js";
import { gameover } from "./escenas/gameover.js";
import { pantalla02 } from "./escenas/pantalla02.js";
import { menu } from "./escenas/menu.js";

var config = {
  type: Phaser.AUTO,
  width: 800,
  height: 600,
  scene: [menu, pantalla02, pantalla01, gameover],
  physics: {
    default: "arcade",
    arcade: {
      gravity: { y: 300 },
      debug: false,
    },
  },
};
var game = new Phaser.Game(config);
```

### Escenas

Las escenas definen diferentes estados del juego, como el menú, el juego en sí y la pantalla de game over.

#### menu.js

```javascript
// filepath: /c:/Users/alons/OneDrive/Escritorio/AD/DAM2/Phaser01/src/escenas/menu.js
import { PlayButton } from "../componentes/play-button.js";

export class menu extends Phaser.Scene {
  constructor() {
    super({ key: "menu" });
    this.playButton = new PlayButton(this);
  }

  preload() {
    // ...cargar recursos...
  }

  create() {
    // ...crear elementos de la escena...
    this.playButton.create();
  }
}
```

#### pantalla01.js

```javascript
// filepath: /c:/Users/alons/OneDrive/Escritorio/AD/DAM2/Phaser01/src/escenas/pantalla01.js
export class pantalla01 extends Phaser.Scene {
  constructor() {
    super({ key: "pantalla01" });
  }

  // ...código de la escena...
}
```

#### pantalla02.js

```javascript
// filepath: /c:/Users/alons/OneDrive/Escritorio/AD/DAM2/Phaser01/src/escenas/pantalla02.js
export class pantalla02 extends Phaser.Scene {
  constructor() {
    super({ key: "pantalla02" });
  }

  // ...código de la escena...
}
```

#### gameover.js

```javascript
// filepath: /c:/Users/alons/OneDrive/Escritorio/AD/DAM2/Phaser01/src/escenas/gameover.js
export class gameover extends Phaser.Scene {
  constructor() {
    super({ key: "gameover" });
  }
  create() {
    // ...crear elementos de la escena...
  }
}
```

### Componentes

Los componentes son elementos reutilizables que se pueden usar en diferentes escenas.

#### button.js

```javascript
// filepath: /c:/Users/alons/OneDrive/Escritorio/AD/DAM2/Phaser01/src/componentes/button.js
export class Button {
  constructor(scene, image, x, y) {
    this.image = image;
    this.relatedScene = scene;
    this.x = x;
    this.y = y;
  }

  create() {
    // ...crear botón...
  }
}
```

#### play-button.js

```javascript
// filepath: /c:/Users/alons/OneDrive/Escritorio/AD/DAM2/Phaser01/src/componentes/play-button.js
import { Button } from "./button.js";
export class PlayButton extends Button {
  constructor(scene) {
    super(scene, "playbutton", 400, 300);
  }

  doClick() {
    this.relatedScene.scene.start("pantalla01");
  }
}
```

## Conclusión

Este ejemplo proporciona una base para crear un juego en Phaser. Puedes expandirlo agregando más escenas, componentes y funcionalidades según tus necesidades.
