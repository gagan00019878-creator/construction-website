const nodemailer = require("nodemailer");

// ✅ 1. Function define karo
async function testEmail() {
  let transporter = nodemailer.createTransport({
    service: "gmail",   // Gmail ke liye simple
    auth: {
      user: "gagan00019878@gmail.com",
      pass: "mgtdqofysjalhzzl"  // 16-character App Password
    }
  });

  let info = await transporter.sendMail({
    from: "gagan00019878@gmail.com",
    to: "gagan00019878@gmail.com",
    subject: "Test Email",
    text: "Hello! This is a test email from Nodemailer."
  });

  console.log("✅ Email sent:", info.response);
}

// ✅ 2. Function call karo **definition ke baad**
testEmail().catch(console.error);
