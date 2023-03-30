
window.addEventListener('load',()=>{
    populateTotable()
})
let users = []




const loginBtn = document.getElementById('logbtn')
if(loginBtn != null){
    loginBtn.addEventListener('click', () => {
        location.href = 'remaketable.html'
    })
}

const logoutbtn = document.getElementById('btnLogout')
if(logoutbtn != null){
    logoutbtn.addEventListener('click', () => {
        location.href = 'remakeLogin.html'
    })
}


//MODAL
const openModal = document.getElementById('openModal')
const addBtn = document.getElementById('addBtn')
if(addBtn != null){
    addBtn.addEventListener('click', () => {
        openModal.style.display = 'block'
    })
    window.addEventListener('click', (e) => {
        if(e.target == openModal){
            openModal.style.display = 'none'
        }
    })
}

//SAVE new acc
const savebtn = document.getElementById('saveBtn')

savebtn.addEventListener('click', () => {
    const newUser = document.getElementById('newUser').value
    const newPass = document.getElementById('newPass').value
    const tbody = document.getElementById('tbody')
    storedUsersWithFilter()

    let newUsersHolder = []

    newUsersHolder = {username: newUser,password:newPass}
    users.push(newUsersHolder)
    let row = tbody.insertRow(tbody.rows.length)
    row.insertCell(0).innerHTML = newUser
    row.insertCell(1).innerHTML = newPass
    localStorage.setItem(newUser, JSON.stringify(newUsersHolder))
    
})

function populateTotable(){
    const tbody = document.getElementById('tbody')
    storedUsersWithFilter()

    for(let i =0; i<users.length;i++){
        let row = tbody.insertRow(tbody.rows.length)
        row.insertCell(0).innerHTML = users[i].username
        row.insertCell(1).innerHTML = users[i].password
    }
}
function storedUsersWithFilter(){
    let keys = Object.keys(localStorage)
    for(let i =0; i<keys.length;i++){
        users.push(JSON.parse(localStorage.getItem(keys[i])))
    }

    let filtered = users.filter((e) => {
        return e!=null
    })
    users = filtered
}