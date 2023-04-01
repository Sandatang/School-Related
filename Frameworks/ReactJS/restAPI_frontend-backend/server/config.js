
const config = {}

///port
config.port = process.env.PORT || 4000

//configuration for mysql
 config.db = {
    hostname: "localhost",
    user: "root",
    password: "",
    database: "student_database",
    charset: "utf8mb4",
    multipleStatement: true
}

module.exports = config