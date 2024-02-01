const express = require('express');
const app = express();
const port = 3001;

// Dummy data - replace this with your database logic
const data = [
  { id: 1, name: 'Hart Hagerty', job: 'Desktop Support Technician', favoriteColor: 'Purple' },
  // Add more data as needed
];

app.get('/api/data', (req, res) => {
  res.json(data);
});

app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
