from flask import Flask, render_template, render_template_string, request
import sqlite3
import re

app = Flask(__name__)
HOST = "0.0.0.0"
PORT = 80
DATABASE = "database/database.db"

def get_db():
    conn = sqlite3.connect(DATABASE)
    conn.row_factory = sqlite3.Row
    return conn

def init_db():
    conn = get_db()
    with open('database/schema.sql', 'r') as f:
        conn.executescript(f.read())
    conn.close()
    return

def waf(str):
    if (len(str)) > 85 or "union" in str.lower():
        return False

    black_list = ["'", '"', '*', '\\', '/', '#', ';', '-']
    for c in black_list:
        if c in str:
            str = str.replace(c, "")

    return str

@app.route('/')
def home():
   return render_template('index.html')

@app.route('/query',methods = ['GET'])
def addrec():
    if request.args.get("query") != "":
        query = request.args.get("query")
    
    query = waf(query)
    
    if query == False:
        return render_template_string("Dont cheat my fen =))")
    else:
        try:
            cur = get_db().execute('SELECT msg FROM ' + query + ' where msg like "MSG-%" and msg not like "%KMACTF{%" limit 1')
            result = cur.fetchall()

            if len(result) == 0:
                return render_template_string("No result")

            cur.close()
            return render_template("index.html", result = result)
        except:
            return render_template_string("Something went wrong")

@app.route('/source')
def source():
    source = open(__file__, "r")
    return render_template("source.html", source = source.read())

if __name__ == '__main__':
    init_db()
    app.run(HOST, PORT, debug=True)