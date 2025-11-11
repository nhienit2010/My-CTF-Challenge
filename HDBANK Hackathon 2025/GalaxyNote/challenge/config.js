const sql = require("mssql");

const dbConfig = {
  user: process.env.DB_USER || "sa",
  password: process.env.DB_PASSWORD || "GalaxyOne@2025",
  server: process.env.DB_SERVER || "10.0.2.182",
  port: parseInt(process.env.DB_PORT) || 14333,
  database: process.env.DB_NAME || "hackathon",
  options: {
    encrypt: false,
    trustServerCertificate: true,
  },
};

async function getConnection() {
  try {
    const pool = await sql.connect(dbConfig);
    return pool;
  } catch (err) {
    throw err;
  }
}

module.exports = {
  sql,
  dbConfig,
  getConnection,
};