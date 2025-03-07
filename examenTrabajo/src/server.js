import express from "express";
import mongoose from "mongoose";
import bodyParser from "body-parser";
import cors from "cors";

const app = express();
const PORT = 3000;

// Middleware
app.use(bodyParser.json());
app.use(cors());

// Conexión a MongoDB
mongoose
  .connect("mongodb://localhost:27017/phaser_scores", {
    useNewUrlParser: true,
    useUnifiedTopology: true,
  })
  .then(() => console.log("Conectado a MongoDB"))
  .catch((err) => console.error("Error al conectar a MongoDB:", err));

// Esquema y modelo de puntuaciones
const scoreSchema = new mongoose.Schema({
  playerName: String,
  score: Number,
  date: { type: Date, default: Date.now },
});

const Score = mongoose.model("Score", scoreSchema);

// Rutas
app.post("/api/scores", async (req, res) => {
  try {
    const { playerName, score } = req.body;
    const newScore = new Score({ playerName, score });
    await newScore.save();
    res
      .status(201)
      .json({ message: "Puntuación guardada correctamente", data: newScore });
  } catch (error) {
    res.status(500).json({ message: "Error al guardar la puntuación", error });
  }
});

app.get(`/api/scores/`, async (req, res) => {
  try {
    const scores = await Score.find().sort({ score: -1 }); // Top 10 puntuaciones
    res.status(200).json(scores);
  } catch (error) {
    res
      .status(500)
      .json({ message: "Error al obtener las puntuaciones", error });
  }
});

/* app.get("/api/scores/:playerName", async (req, res) => {
  try {
    const { playerName } = req.params;
    const score = await Score.findOne({ playerName });
    if (!score) {
      return res.status(404).json({ message: "Puntuación no encontrada" });
    }
    res.status(200).json(score);
  } catch (error) {
    res.status(500).json({ message: "Error al obtener la puntuación", error });
  }
}); */
app.get("/api/scores/:playerName", async (req, res) => {
  try {
    const { playerName } = req.params; // Obtener el nombre del jugador desde los parámetros de la URL
    const score = await Score.findOne({ playerName }); // Buscar una única entrada para el jugador
    if (!score) {
      return res.status(404).json({ message: "Jugador no encontrado" });
    }
    res.status(200).json({ score: score.score }); // Solo devolver la puntuación
  } catch (error) {
    res.status(500).json({ message: "Error al obtener la puntuación", error });
  }
});

/* app.put("/api/scores/:playerName", async (req, res) => {
  try {
    const { playerName } = req.params;
    const { score } = req.body;
    const actualizado = await Score.findOneAndUpdate(
      { playerName },
      { score },
      { new: true }
    );
    if (!actualizado) {
      return res
        .status(404)
        .json({ message: "Puntuación no encontrada", data: actualizado });
    }
    res.status(200).json({ message: "Puntuación actualizada" });
  } catch (error) {
    res
      .status(500)
      .json({ message: "Error al obtener las puntuaciones", error });
  }
}); */
app.put("/api/scores/:playerName", async (req, res) => {
  try {
    const { playerName } = req.params;
    const { score } = req.body;
    const actualizado = await Score.findOneAndUpdate(
      { playerName },
      { score },
      { new: true }
    );
    if (!actualizado) {
      return res
        .status(404)
        .json({ message: "Puntuación no encontrada", data: actualizado });
    }
    res.status(200).json({ message: "Puntuación actualizada" });
  } catch (error) {
    res
      .status(500)
      .json({ message: "Error al obtener las puntuaciones", error });
  }
});

// Iniciar servidor
app.listen(PORT, () =>
  console.log("Servidor ejecutándose en http://localhost:${PORT}")
);
