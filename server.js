const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();

// Middleware
app.use(cors());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// MongoDB connection
mongoose.connect('mongodb+srv://mscorp7:mscorp7777@mscorp1.d5y2q.mongodb.net/mscorp', {
  useNewUrlParser: true,
  useUnifiedTopology: true
});

// Define a Schema and Model for form data
const formSchema = new mongoose.Schema({
  name: String,
  email: String,
  comments: String
});
const Form = mongoose.model('Form', formSchema);

// Handle form submission (POST route)
app.post('/', async (req, res) => {
  const { name, email, comments } = req.body;
  const newFormEntry = new Form({ name, email, comments });
  
  try {
    await newFormEntry.save();
    res.send("Form submitted successfully!");
  } catch (err) {
    res.status(500).send("Error in form submission.");
  }
});

// Define the server port
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
