const qty = document.querySelector('#qty')
const price = document.querySelector('#price')
const error = document.querySelector('#errorUpdate')
const errorDecimal = document.querySelector('#errorDecimal')
const umsr = document.querySelector('#umsr')

function updateData(){
    const nonDecimalUmsr = ["pc","set","doz"]
    let checker = true
    // console.log(errorDecimal.innerHTML)
    if(isNaN(qty.value) === true || isNaN(price.value) === true){
        error.style.color = 'red'
        error.innerHTML = 'Quantity or Price should be a number'
        return checker = false;
    }
    if(qty.value < 0 || price.value < 0){
        error.style.color = 'red'
        error.innerHTML = 'Quantity and Price can never be negative'
        return checker = false
    }


    if(nonDecimalUmsr.indexOf(umsr.value) !== -1){
        let newqty = qty.value
        if(newqty.indexOf('.') !== -1){
            error.style.color = 'red'
            error.innerHTML = 'Decimal Values are only allowed in kilo'
            return checker = false
        }
        error.style.color = 'green'
        error.innerHTML = 'Item Updated Succesfully'
        // return checker = true
    }
    if(checker === true){
    error.style.color = 'green'
    error.innerHTML = 'Item Updated Succesfully'
    window.location.href = 'http://localhost/php_activities/semi_final/activity/my_codes/list_all_items.php?keyword=&search='
    }
}
