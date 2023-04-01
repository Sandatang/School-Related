const error = document.querySelector('#error')
const items =[]
const addRow = () => {
    const input = document.querySelector('#inputValue')
    const qty = document.querySelector('#qty')
    const umsr = document.querySelector('#umsr')
    const tabledata = document.querySelector('#tabledata')
    let rowCount = tabledata.rows.length
    let row = tabledata.insertRow()

    ///CONCATENTATE
    // let umsrValue = umsr.childNodes[0]
    

    
        //add rows with data dynamically
    let triminput = input.value.trim()
    if(triminput !== ''){
        error.style.visibility = 'hidden'

        let itemId = (Math.random()*10000).toFixed().toString(10)
            while(items.find((i => (i.itemId === itemId))) != undefined){
                itemId = (Math.random()* 10000). toFixed().toString(10)
            }
            const item = {'id': itemId, 'item': input.value, 'qty': qty.value, 'umsr': umsr.value}
            input.value = ''
            items.push(item)
            localStorage.setItem(itemId, JSON.stringify(item))
            
                    row.insertCell(0).innerHTML=item.item//push new data
                    row.insertCell(1).innerHTML=qty.value//push new data
                    row.insertCell(2).innerHTML=umsr.value//push new data
                    row.insertCell(3).innerHTML=`<button class="edit btntd" id="edit" onClick="editbtn(this, ${itemId})">&#9998;</button>`    
                    row.insertCell(4).innerHTML= `<button class="delete btntd" onClick="deleteRows(this, ${itemId})">&#128465;</button>`

        //appear if has items
        if(rowCount >= 0){
            const clr = document.querySelector('#parentClear')
            document.querySelector('#parentClear').style.display= 'block'
            clr.innerHTML = '<button class="btnClear" id="btnallclr" onClick="deleteAll()">Clear Items</button>'
        }
    }
    else{
        // console.log(input.parentNode.parentNode.children[1])
        error.style.visibility = 'visible'
    }
}

//laod items from LOCAL STORAGE
const displayItem = () => {
    getItems()
    const tabledata = document.querySelector('#tabledata')
    

    if(items.length > 0){
            items.forEach((item) => {
                const row = tabledata.insertRow()

                    row.insertCell(0).innerHTML=item.item//push new data
                    row.insertCell(1).innerHTML=item.qty//push new data
                    row.insertCell(2).innerHTML=item.umsr//push new data
                    
                    row.insertCell(3).innerHTML=`<button class="edit btntd" id="edit" onClick="editbtn(this, ${item.id})">&#9998;</button>`    
                    row.insertCell(4).innerHTML= `<button class="delete btntd" onClick="deleteRows(this, ${item.id})">&#128465;</button>`
            })
            const clr = document.querySelector('#parentClear')
            document.querySelector('#parentClear').style.display= 'block'
            clr.innerHTML = '<button class="btnClear" id="btnallclr" onClick="deleteAll()">Clear Items</button>'
        }
    else{
            document.querySelector('#parentClear').style.display= 'none'
    }
    
}

///get the stored ITEMS from LOCAL STORAGE
const getItems = () => {
    let keys = Object.keys(localStorage)
    let i = keys.length
    while(i--){
        items.push(JSON.parse(localStorage.getItem(keys[i])))
    }
    // console.log(items)
}



//individual targeted rows deleteed
const deleteRows = (props, id) => {
    const tabledata =document.querySelector('#tabledata')
    // const row = tabledata.rows.length
    const deletethisCell = props.parentNode.parentNode

        deletethisCell.remove()
        localStorage.removeItem(id)
        // tabledata.deleteRow(row-1)//delete specific row
        checkRows()
}

const deleteAll = () => {
    const tabledata =document.querySelector('#tabledata')
       
        tabledata.innerHTML = ''// clear table
        localStorage.clear()
        checkRows()
    
}

//checking if has rows
const checkRows = () => {
    const row = tabledata.rows.length
    if(row === 0) {
        document.querySelector('#parentClear').style.display = 'none'
    }
   
}

//UPDATE DATA
const editbtn = (props, id) => {
    checkRows()
    const parent = props.parentNode.parentNode
    
    const updateThisCell = props.parentNode.parentNode.childNodes[0]
    const updateQty = props.parentNode.parentNode.childNodes[1]
    const updateUmsr = props.parentNode.parentNode.childNodes[2]
    const saveUpdate = props.parentNode.parentNode.childNodes[3]
    const cellValue = updateThisCell.innerHTML


    
    // console.log(updateUmsr.firstChild)
    const button = document.createElement('button')
    button.id = 'checkBtn'
    button.innerHTML = '&#10003;'
    button.style.marginLeft = '1.6em'
    button.style.marginTop = '5px'
    button.style.width = '20%'
    button.style.background = 'transparent'
    button.style.border = 'none'
    button.style.fontWeight = '900'

    const inputVal = document.createElement('input')
    const inputNum = document.createElement('input')
    inputNum.defaultValue = updateQty.innerHTML
    inputNum.type = 'number'
    const umsrUpdate = document.createElement('SELECT')

    

    umsrUpdate.setAttribute('id', 'usmrUpdate')
    const option1 = document.createElement('option')
        // option1.setAttribute('value', 'piece/s')
        option1.value = 'piece/s'
        option1.textContent = 'piece/s'
    const option2 = document.createElement('option')
        option2.value = "kilo/s"
        option2.textContent = 'kilo/s'
    const option3 = document.createElement('option')
        option3.value = 'set/s'
        option3.textContent = 'set/s'
    const option4 = document.createElement('option')
        option4.value = 'dozen/s'
        option4.textContent = 'dozen/s'

    umsrUpdate.appendChild(option1)
    umsrUpdate.appendChild(option2)
    umsrUpdate.appendChild(option3)
    umsrUpdate.appendChild(option4)
    umsrUpdate.value = updateUmsr.innerHTML
    umsrUpdate.style.paddingTop = '8px'
    umsrUpdate.style.paddingBottom = '8px'
    umsrUpdate.style.borderRadius = '5px'

    inputVal.setAttribute('id', 'inputUpdate')
    inputVal.type = 'text'
    inputVal.defaultValue = cellValue

    inputNum.style.width = '40px'
    inputNum.style.marginRight = '5px'
    inputNum.style.paddingTop = '8px'
    inputNum.style.paddingBottom = '8px'
    inputNum.style.borderRadius = '5px'
    inputNum.style.textAlign = 'center'
    inputNum.style.outline = 'none'
    inputNum.style.border = '0.2px solid'

    button.addEventListener('click', (e)=>{
        const inputNumView = document.createTextNode(inputNum.value)
        const inputValView = document.createTextNode(inputVal.value)
        const umsrUpdateView = document.createTextNode(umsrUpdate.value)
       
        localStorage.setItem(id, JSON.stringify({'id': id, 'item': inputVal.value, 'qty': inputNum.value, 'umsr': umsrUpdate.value}))

        updateThisCell.replaceChild(inputValView, updateThisCell.childNodes[0])
        updateQty.replaceChild(inputNumView, updateQty.childNodes[0])
        updateUmsr.replaceChild(umsrUpdateView, updateUmsr.childNodes[0])
        button.remove()
        document.querySelector('#edit').style.display = 'block'
    })
    updateThisCell.replaceChild(inputVal, updateThisCell.childNodes[0])
    updateQty.replaceChild(inputNum, updateQty.childNodes[0])
    updateUmsr.replaceChild(umsrUpdate, updateUmsr.childNodes[0])
    parent.insertBefore(button, parent.childNodes[3])
   const b =  document.querySelector('#edit').style.display = 'none'

}

const btnsun = document.querySelector('#btnSub')
const input = document.querySelector('#inputValue')
input.addEventListener('keyup', (e) => {
    if(e.key === "Enter"){ 
        addRow()
    }
})
btnsun.addEventListener('click', () => {
    addRow()
})

window.addEventListener('load', () => {
    displayItem()
})
