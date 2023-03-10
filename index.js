// API connections
var express = require("express") 
var mongoose = require("mongoose") 
var bodyParser = require("body-parser") 

// creating express app
const app = express() 

// Adding utitites and Middlewares
app.use(bodyParser.json()) 
app.use(express.static('public')) 
app.use(bodyParser.urlencoded({ 
    extended: true

}))

// MongoDB connection using Mongoose 

mongoose.connect('mongodb://0.0.0.0:27017/profiledb'); 

var db = mongoose.connection; 

db.on('error', () => console.log("Error in Connection")); 
db.once('open',() => console.log("Connected Successfully"));

app.post("/signup", (req, res) => { 

    var fullName = req.body.fullName; 
    var workplace = req.body.workplace; 
    var age = req.body.age; 
    var contact = req.body.contact; 

    var data = { 
        "fullName": fullName,
        "workplace": workplace, 
        "age": age, 
        "contact": contact 
    }

    db.collection('users').insertOne(data, (err, collection) =>{ 
        if(err){ 
            throw err;
        } 

        console.log("Record Saved Successfully");
    }); 

   return res.redirect ("success.html");

})


app.get("/", (req, res) => { 
    res.set({ 
        "Allow-access-Allow-Origin": '*'
    })
    return res.redirect ("profile.html");
}).listen(4000); 

console.log("The server is running");