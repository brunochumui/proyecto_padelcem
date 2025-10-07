const express = require("express");
const cors = require("cors");
const { MercadoPagoConfig, Preference } = require("mercadopago");

const app = express();
app.use(cors());
app.use(express.json());

const client = new MercadoPagoConfig({
  accessToken: "APP_USR-6804369879378714-092914-1e4d0df9da027e0b43a58fc9c4cf30b1-2721248854"
});

app.post("/create_preference", async (req, res) => {
  try {
    const preference = new Preference(client);

    const body = {
      items: [
        {
          title: "Reserva de cancha de pádel",
          quantity: 1,
          unit_price: 22000 // precio de la reserva
        }
      ],
      back_urls: {
        success: "http://127.0.0.1:5500/success.html",
        failure: "http://127.0.0.1:5500/failure.html",
        pending: "http://127.0.0.1:5500/pending.html"
      },
    };

    const result = await preference.create({ body });
    res.json({ id: result.id, link: result.init_point });

  } catch (error) {
    console.error("Error al crear la preferencia:", error);
    res.status(500).json({ error: "Error creando la preferencia" });
  }
});

app.listen(8080, () => console.log("🚀 Servidor corriendo en http://localhost:8080"));
