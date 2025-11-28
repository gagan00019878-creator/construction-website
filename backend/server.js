const express = require("express");
const cors = require("cors");
const nodemailer = require("nodemailer");

const app = express();

// CORS setup
app.use(cors({
  origin: "*",
  methods: ["POST", "GET"],
}));

// Body parsers
app.use(express.json());
app.use(express.urlencoded({ extended: true })); // ← Added this line to fix req.body undefined

// SMTP Transporter
const transporter = nodemailer.createTransport({
  host: "smtp.gmail.com",
  port: 587,
  secure: false,
  auth: {
    user: "gagan00019878@gmail.com",
    pass: "mgtdqofysjalhzzl" // App password
  }
});

// POST endpoint
app.post("/send", async (req, res) => {
  const { name, email, phone, message } = req.body;

  console.log("📩 Data received:", req.body);

  const mailOptions = {
    from: "gagan00019878@gmail.com",
    to: "gagan00019878@gmail.com",
    subject: `New Contact Form Submission from ${name}`,
    text: `
Name: ${name}
Email: ${email}
Phone: ${phone}
Message: ${message}
`
  };

  try {
    await transporter.sendMail(mailOptions);
    console.log("✔ Email sent!");
    res.json({ success: true, message: "Message sent successfully!" });
  } catch (err) {
    console.error("❌ Email send error:", err);
    res.json({ success: false, message: "Error sending email" });
  }
});

// Start server
app.listen(5000, () => {
  console.log("🚀 Backend running on port 5000");
});
