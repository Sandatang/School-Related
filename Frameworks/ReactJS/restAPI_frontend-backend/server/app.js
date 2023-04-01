//es5

const express = require('express')
const bodyparser = require('body-parser')
const config = require('./config')
const students = require('./api/studentApi')
const getstudents = require('./api/studentApi')
const cors = require('cors')


//instance of express
const app = express()

//content type for this app
app.use(cors())
app.use(bodyparser.urlencoded({"extended":true}))
app.use(bodyparser.json())
app.use("/",students)
app.use("/",getstudents)

//create default router
app.get('/',function(req,res){
    res.send('Student Restfull API using MySQL database')
})


const port = config.port
const server = app.listen(port, function(){
    require('dns').lookup(require('os').hostname(),function(err,addr,fam){
        console.log('http://%s:%s',addr,port)
    })
})