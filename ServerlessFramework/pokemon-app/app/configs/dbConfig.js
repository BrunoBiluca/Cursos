const { Pool } = require('pg')

const pool = new Pool({
  host: 'database',
  user: 'postgres',
  password: process.env.POSTGRES_PASSWORD,
  database: 'pokemon',
  max: 20,
  idleTimeoutMillis: 30000,
  connectionTimeoutMillis: 2000,
});

module.exports = pool;