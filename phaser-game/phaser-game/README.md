# FILE: /phaser-game/phaser-game/README.md

# Proyecto Phaser Game

Este proyecto es un juego simple desarrollado con Phaser 3, que incluye dos personajes que pueden moverse verticalmente y disparar balas. 

## Estructura del Proyecto

- **index.html**: Página principal que carga el juego.
- **package.json**: Configuración para npm, incluyendo dependencias y scripts.
- **assets/**: Contiene las imágenes de los personajes y las balas.
  - **characters/**: Imágenes de los personajes.
  - **bullets/**: Imagen de la bala.
- **src/**: Código fuente del juego.
  - **main.js**: Punto de entrada del juego.
  - **scenes/**: Contiene la lógica del juego.
    - **GameScene.js**: Define la clase GameScene y su lógica.
  - **utils/**: Contiene utilidades y constantes.
    - **constants.js**: Exporta constantes utilizadas en el juego.

## Instrucciones para Ejecutar el Juego

1. Clona este repositorio en tu máquina local.
2. Navega al directorio del proyecto.
3. Instala las dependencias ejecutando:
   ```
   npm install
   ```
4. Inicia el servidor local con:
   ```
   npm start
   ```
5. Abre tu navegador y ve a `http://localhost:3000` para jugar.

## Controles del Juego

- **Jugador 1**:
  - Mover hacia arriba: Tecla asignada (definida en constants.js)
  - Mover hacia abajo: Tecla asignada (definida en constants.js)
  - Disparar: Tecla asignada (definida en constants.js)

- **Jugador 2**:
  - Mover hacia arriba: Tecla asignada (definida en constants.js)
  - Mover hacia abajo: Tecla asignada (definida en constants.js)
  - Disparar: Tecla asignada (definida en constants.js)

## Notas

- Cada personaje tiene un máximo de 10 balas y un tiempo de espera de 3 segundos entre disparos.
- Los triángulos en el medio de los jugadores se moverán hacia arriba y hacia abajo.

¡Diviértete jugando!