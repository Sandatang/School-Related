//DOM elements
const button = document.getElementById('button')//login button
const userButton = document.getElementById('userButton')//add user
const submitBtn = document.getElementById('submitBtn')//populate user
const logBtn = document.getElementById('logBtn')//logout user

//start of table user html
let users = []



//HTML body element
const body = document.getElementById('body')
window.addEventListener('load', () => {
    PopulateTable()
})

const input = document.getElementById('password')
if(input != null){
    input.addEventListener('keypress', (e) => {
        StoredUsersAndFilteredUsers
        const username = document.getElementById('username').value
        const password = document.getElementById('password').value
        if(e.key === 'Enter'){
            if(users.find((e) => e.username === username &&  e.password === password)){
                location.href = 'table.html'
            }
            else{
                alert('Invalid Credentials!')
            }
        }
    })
}
//Login HTML part
if(button != null){
    button.addEventListener('click', () => {
        StoredUsersAndFilteredUsers
        const username = document.getElementById('username').value
        const password = document.getElementById('password').value

        if(users.find((e) => e.username === username &&  e.password === password)){
                location.href = 'table.html'
        }
        else{
            alert('Invalid Credentials!')
        }
    })
}
//end of Login html part


//LOGOUT BTN
logBtn.addEventListener('click', () => {
    location.href = 'login.html'
})


//Add rows and push new users
submitBtn.addEventListener('click', () => {
    const addUser = document.getElementById('addUser').value
    const addPass = document.getElementById('addPass').value
    const tbody = document.getElementById('tbody')

    StoredUsersAndFilteredUsers()
    
    const parent = document.getElementById('thirdParentDiv')
        const p = document.createElement('p')
        p.style.color = 'red'
        p.style.fontSize = '12px'
        p.style.paddingLeft = '30px'
    
    let pushItem
    if(users.find(e => e.username === addUser)){//check for the same users
        p.innerText = 'Username Already in use!'
        parent.appendChild(p)
        document.getElementById('addUser').value = ''
    }
    //if(users.find(e => e.username != addUser))
    
    else if(/\s/.test(addUser) == true){
        p.innerText = 'Spaces are not allowed! Use "_" instead'
        parent.appendChild(p)
        document.getElementById('addUser').value = ''
    }
    else if(addUser.length < 4){
        p.innerText = 'Username should be more than 4 Characters!'
        parent.appendChild(p)
    }
    else if(addPass.length < 8){
        p.innerText = 'Password should be more than 8 Characters'
        parent.appendChild(p)
        document.getElementById('addPass').value = ''
    }
    else{
        pushItem = {username:addUser.trim(),password:addPass}
        users.push(pushItem)

        let row = tbody.insertRow(tbody.rows.length)//insert new row to tbody element(insert it to last child row of tbody)
        row.insertCell(0).innerHTML = addUser
        row.insertCell(1).innerHTML = addPass
        document.getElementById('addUser').value = ''
        document.getElementById('addPass').value = ''
        document.getElementById('userModal').style.display = 'none'

        localStorage.setItem(`${addUser}`,JSON.stringify(pushItem))
    }
    
})
//Populate table
function PopulateTable(){
    const tbody = document.getElementById('tbody')
    StoredUsersAndFilteredUsers()

    for(let i=0;i<users.length;i++){
        let row = tbody.insertRow(tbody.rows.length)
            row.insertCell(0).innerHTML = users[i].username
            row.insertCell(1).innerHTML = users[i].password
    }

}

//check if users not null
function StoredUsersAndFilteredUsers(){
    let keys = Object.keys(localStorage)
    for(let i =0;i<keys.length;i++){
        users.push(JSON.parse(localStorage.getItem(keys[i])))
    }

    let filtered = users.filter((e) => {
        return e != null
    })
    users =  filtered
}


userButton.addEventListener('click', () => {
    const userModal = document.getElementById('userModal')
    userModal.style.display = 'block'
    const xBTN = document.getElementById('xBTN')
    xBTN.addEventListener('click', () => {
        userModal.style.display = 'none'
    })

    window.addEventListener('click', (e) =>{
        if(e.target == userModal){
            userModal.style.display = 'none'
        }
    })
})