const express = require("express");
const mongoose = require("mongoose");
const cors = require("cors");

const app = express();
app.use(express.json());
app.use(cors());

// MongoDB Connection (Direct URI)
mongoose.connect(
  "mongodb+srv://mscorp7:mscorp7777@mscorp1.d5y2q.mongodb.net/mscorp",
  { useNewUrlParser: true, useUnifiedTopology: true }
);

// Define Schema & Model
const formSchema = new mongoose.Schema({
  name: String,
  email: String,
  comments: String,
});
const Form = mongoose.model("Form", formSchema);

// Handle Form Submission
app.post("/submit", async (req, res) => {
  try {
    const { name, email, comments } = req.body;
    const newEntry = new Form({ name, email, comments });
    await newEntry.save();
    res.status(201).json({ message: "Submitted successfully" });
  } catch (err) {
    res.status(500).json({ error: "Submission failed" });
  }
});

// Start Server
const PORT = 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
