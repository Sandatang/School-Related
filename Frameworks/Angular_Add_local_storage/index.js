const express = require('express')
const bodyparser = require('body-parser')
const path=require("path");
const port = process.env.port || 4000


//
const app = express()

app.set('view-engine', 'ejs')
app.get('/', (req,res) => {
    res.render('login.ejs')
})

let server = app.listen(port,() => {
    console.log('listening at port: %s',port)
})

