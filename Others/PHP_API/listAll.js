const qty = document.querySelector('#qty')
const qtyerror = document.querySelector('#qtyerror')
const price = document.querySelector('#price')
const error = document.querySelector('#error')
const description = document.querySelector('#description')
const modal = document.querySelector('#modal')
const btnAdd = document.querySelector('#btnAdd')
const umsr = document.querySelector('#umsr')
const closeBtn = document.querySelector('#closeBtn')

btnAdd.addEventListener('click', ()=>{
    modal.style.display = 'block'
})

closeBtn.addEventListener('click', ()=>{
    document.querySelector('#modal').style.display = "none"
})

document.getElementById('search').addEventListener('click', () =>{ document.getElementById('btnAdd').style.display = 'visible'})


// function validateData(){
//     const nonDecimalUmsr = ["pc","set","doz"]
//     let checker = true

//     if(isNaN(qty.value) === true || isNaN(price.value) === true){
//         error.style.color = 'red'
//         error.innerHTML = 'Quantity or Price should be a number'
//         return checker = false
//     }
//     if(qty.value < 0 || price.value < 0){
//         error.style.color = 'red'
//         error.innerHTML = 'Quantity and Price can never be negative'
//         return checker = false
//     }
    
//     if(nonDecimalUmsr.indexOf(umsr.value) !== -1){
//         let newqty = qty.value
//         if(newqty.indexOf('.') !== -1){
//             error.style.color = 'red'
//             error.innerHTML = 'Decimal Values are only allowed in kilo'
//             return checker = true
//         }
//     }
//     if(checker === true){
//         error.style.color = 'green'
//         error.innerHTML = 'Item added succesfully'
//         // modal.style.display = 'none'
//         // location.reload()
//         window.location.href = 'http://localhost/php_activities/semi_final/activity/my_codes/list_all_items.php'
        
//     }
    
// }