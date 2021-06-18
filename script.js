const express = require('express');
const morgan = require('morgan');
const cors = require('cors');
const dotenv = require('dotenv').config();
const bodyParser = require('body-parser');
const path = require('path');


const app = express();
const port = process.env.PORT || 8080;

app.use(cors());
app.use(morgan('common'));
app.use(express.static(path.join(__dirname, '../public')));

app.use(bodyParser.json({ limit: '50mb' }));
app.use(bodyParser.urlencoded({ limit: '50mb', extended: true }));


app.listen(port, () => {
  console.log(`Listening on http://localhost:${port}`);
})
