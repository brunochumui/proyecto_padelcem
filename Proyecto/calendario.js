// server.js
import express from "express";
import cors from "cors";
import mercadopago from "mercadopago";

const app = express();
app.use(cors());
app.use(express.json());

// ⚠️ PONÉ TU ACCESS TOKEN AQUÍ (modo prueba o producción)
mercadopago.configurations.setAccessToken("APP_USR-6804369879378714-092914-1e4d0df9da027e0b43a58fc9c4cf30b1-2721248854");

app.post("/create_preference", async (req, res) => {
  try {
    const preference = {
      items: [
        {
          title: "Reserva de cancha de pádel",
          unit_price: 2000, // precio de la reserva
          quantity: 1,
        },
      ],
      back_urls: {
        success: "http://127.0.0.1:5500/success.html",
        failure: "http://127.0.0.1:5500//failure.html"
      }
    };

    const response = await mercadopago.preferences.create(preference);
    // Devuelve el link de pago (init_point) además del id
    res.json({ id: response.body.id, link: response.body.init_point });
  } catch (error) {
    console.error(error);
    res.status(500).json({ error: "Error creando la preferencia" });
  }
});

app.listen(8080, () => console.log("Servidor corriendo en http://localhost:8080"));
