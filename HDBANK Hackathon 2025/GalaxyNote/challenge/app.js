const express = require("express");
const { getConnection } = require("./config");
const path = require("path");

const app = express();
const port = 3000;

app.use(express.urlencoded({ extended: true }));
app.use(express.json());

app.set("view engine", "ejs");
app.set("views", path.join(__dirname, "views"));

app.get("/", async (req, res) => {
  try {
    const pool = await getConnection();
    let result = await pool.request().query("SELECT * FROM notes ORDER BY note_id DESC");
    res.render("index", { notes: result.recordset });
  } catch (err) {
    console.error("Database error:", err);
    res.status(500).send("Database connection failed!");
  }
});

app.post("/search", async (req, res) => {
  let {search, created_by, order_by} = req.body;
  order_by = order_by || 'note_id';

  let blacklist = [";", "convert", "master", "-", "serverproperty", "exec", "waitfor", "delay", "drop", "case", "when", "unicode", "fn_", "openrowset", "'", '"'];
  const blacklistRegex = new RegExp(blacklist.join("|"), "i");

  if (blacklistRegex.test(order_by)) {
    return res.status(400).json({ code: 400, message: `Hint: blacklist = /${blacklist.join("|")}/i` });
  }

  try {
    const pool = await getConnection();
    const result = await pool.request()
      .input("search", `%${search}%`)
      .input("created_by", `%${created_by}%`)
      .query(`
        SELECT * FROM notes
        WHERE title LIKE @search OR content LIKE @search OR created_by LIKE @created_by
        ORDER BY ${order_by} DESC
      `);
    res.json( {code: 200, data: result.recordset});
  } catch (err) {
    console.error("Database error:", err);
    res.status(500).json({code: 500, message: "Error while fetching data!" });
  }
});

app.get("/create", (req, res) => {
    return res.render("create", {});
});

app.post("/create", async (req, res) => {
  const { title, content, created_by } = req.body;
  if (!title || !content || !created_by) {
    return res.status(400).send("Missing title or content");
  }
  try {
    const pool = await getConnection();
    await pool.request()
      .input("title", title)
      .input("content", content)
      .input("created_by", created_by)
      .query("INSERT INTO notes (title, content, created_by) VALUES (@title, @content, @created_by)");
    res.json({ code: 200, message: "Note created successfully!" });
  } catch (err) {
    console.error("Database error:", err);
    res.status(500).json({code: 500, message: "Failed to create note!"});
  }
});

app.listen(port, () => {
  console.log(`🚀 Server running at http://localhost:${port}`);
});
