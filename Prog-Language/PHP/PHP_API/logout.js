
const logout = document.querySelector('#logout')

logout.addEventListener('click', () =>{
    document.querySelector('#logoutModal').style.display = 'block'
})

window.onclick = (event) => {if(event.target == document.querySelector('#logoutModal')) document.querySelector('#logoutModal').style.display = 'none'}