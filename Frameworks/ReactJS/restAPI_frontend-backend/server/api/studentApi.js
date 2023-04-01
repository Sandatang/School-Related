const express = require('express')
const router = express.Router()
const mysql = require('mysql')
const config = require('../config')


///instance of mysql connector
const db = mysql.createPool(config.db)

//route fro displaying records
router.get('/get-students',function(req,res){
    const sqlComamnd = "Select * FROM student"
    db.query(sqlComamnd, function(err,results,fields){
        if(err) res.status(500).json(err)
        res.json({results})
    })
})

//route for adding records
router.post('/students',function(req,res){
    const student = req.body
    const sqlComamnd = "INSERT INTO `student`(`idno`,`lastname`,`firstname`,`course`,`level`) VALUES("+student.idno+",'"+student.lastname+"','"+student.firstname+"','"+student.course+"',"+student.level+")"
    db.query(sqlComamnd,function(err,results,fields){
        if(err) res.status(500).json(err)
        res.json({"message": "New Student Added"})
    })
})

//route for deleting records
router.delete('/students/:idno', function(req,res){
    const idno = req.params.idno
    const sqlCommand = "DELETE FROM `student` WHERE `idno`='"+idno+"'"
    db.query(sqlCommand, function(err,results,fields){
        if(err) res.status(500).json(err)
        res.json({"message":"Student Deleted"})
    })
})

//route for updating records
router.put('/students', function(req,res){
    const student = req.body
    const sqlComamnd = "UPDATE `student` SET `lastname`='"+student.lastname+"', `firstname`='"+student.firstname+"',`course`='"+student.course+"',`level`="+student.level+" WHERE `idno`="+student.idno+""
    db.query(sqlComamnd, function(err,results,field){
        if(err) res.status(500).json(err)
        res.json({"message":"Student Updated"})
    })
})

module.exports=router