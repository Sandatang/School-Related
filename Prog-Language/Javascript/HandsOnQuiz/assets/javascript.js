//VALUSE OF A
const val1 = document.getElementById('val1')
const val2 = document.getElementById('val2')
const val3 = document.getElementById('val3')
const val4 = document.getElementById('val4')

//VALUES OF B
const valb1 = document.getElementById('valb1')
const valb2 = document.getElementById('valb2')
const valb3 = document.getElementById('valb3')
const valb4 = document.getElementById('valb4')

//first input of A and B
function resultOne(){
    const newVal = val1.value
    const newValb1 = valb1.value

    let pattern = /[a-zA-Z2-9]+$/;
    let patResult = pattern.test(newVal)
    let patResultB = pattern.test(newValb1)

    //NOT Values table
    const valNOT1 = document.getElementById('valNOT1')
    const resultNOT1 = document.getElementById('resultNOT1')
    if(newVal != ''){
        valNOT1.innerHTML = newVal
        let result = !Number(newVal)
            let resultForNot = (result == true) ? '1':'0'
            resultNOT1.innerHTML = resultForNot
    }
    else{
        valNOT1.innerHTML = ''
        resultNOT1.innerHTML = ''
    }//END OF NOT TABLE VALUES
    
    if(patResult != true && patResultB != true){
        const display = document.getElementById('resultVal1')
        const displayOr = document.getElementById('resultOr1')

        //First Row input
        const and1 = document.getElementById('valA1')
        const or1 = document.getElementById('valOR1')
        and1.innerHTML = newVal
        or1.innerHTML = newVal
        //Second Row input
        const andb1 = document.getElementById('valB1')
        const orb1 = document.getElementById('valORb1')
        andb1.innerHTML = newValb1
        orb1.innerHTML = newValb1

        if(newVal == '' || newValb1==''){
            display.innerHTML = ''
            displayOr.innerHTML = ''
        }
        else{
            let result = Number(newVal==1 && newValb1==1)
            let resultOr = Number(newVal==1 || newValb1==1)
            
            const bool = (result == true) ? '1':'0'
            display.innerHTML = bool

            const boolOr = (resultOr == true) ? '1':'0'
            displayOr.innerHTML = boolOr
        }
    }else{
        document.getElementById('alert').innerHTML = 'Enter only 0 and 1'
    }
}

//Second input of A and B
function resultTwo(){
    const newVal = val2.value
    const newValb2 = valb2.value

    let pattern = /[a-zA-Z2-9]+$/;
    let patResult = pattern.test(newVal);
    let patResultB = pattern.test(newValb2);

    //NOT Values table
    const valNOT2 = document.getElementById('valNOT2')
    const resultNOT2 = document.getElementById('resultNOT2')
    if(newVal != ''){
        valNOT2.innerHTML = newVal
        let result = !Number(newVal)
            let resultForNot = (result == true) ? '1':'0'
            resultNOT2.innerHTML = resultForNot
    }
    else{
        valNOT2.innerHTML = ''
        resultNOT2.innerHTML = ''
    }//END OF NOT TABLE VALUES
    
    if(patResult != true && patResultB != true){
        const display = document.getElementById('resultVal2')
        const displayOr = document.getElementById('resultOr2')

        //First Row input of OR and AND
        const and1 = document.getElementById('valA2')
        const or1 = document.getElementById('valOR2')
        and1.innerHTML = newVal
        or1.innerHTML = newVal
        //Second Row input of OR and AND
        const andb1 = document.getElementById('valB2')
        const orb1 = document.getElementById('valORb2')
        andb1.innerHTML = newValb2
        orb1.innerHTML = newValb2

        if(newVal == '' || newValb2==''){
            display.innerHTML = ''
            displayOr.innerHTML = ''
        }
        else{
            let result = Number(newVal==1 && newValb2==1)
            let resultOr = Number(newVal==1 || newValb2==1)
            
            const bool = (result == true) ? '1':'0'
            display.innerHTML = bool

            const boolOr = (resultOr == true) ? '1':'0'
            displayOr.innerHTML = boolOr
        }
    }else{
        document.getElementById('alert').innerHTML = 'Enter only 0 and 1'
    }
}

//Third input of A and B
function resultThree(){
    const newVal = val3.value
    const newValb3 = valb3.value

    let pattern = /[a-zA-Z2-9]+$/;
    let patResult = pattern.test(newVal);
    let patResultB = pattern.test(newValb3);
    
    if(patResult != true && patResultB != true){
        const display = document.getElementById('resultVal3')
        const displayOr = document.getElementById('resultOr3')

        //First Row input of OR and AND
        const and1 = document.getElementById('valA3')
        const or1 = document.getElementById('valOR3')
        and1.innerHTML = newVal
        or1.innerHTML = newVal
        //Second Row input of OR and AND
        const andb1 = document.getElementById('valB3')
        const orb1 = document.getElementById('valORb3')
        andb1.innerHTML = newValb3
        orb1.innerHTML = newValb3

        if(newVal == '' || newValb3==''){
            display.innerHTML = ''
            displayOr.innerHTML = ''
        }
        else{
            let result = Number(newVal==1 && newValb3==1)
            let resultOr = Number(newVal==1 || newValb3==1)
            
            const bool = (result == true) ? '1':'0'
            display.innerHTML = bool

            const boolOr = (resultOr == true) ? '1':'0'
            displayOr.innerHTML = boolOr
        }
    }else{
        document.getElementById('alert').innerHTML = 'Enter only 0 and 1'
    }
}

//Fourth input of A and B
function resultFour(){
    const newVal = val4.value
    const newValb4 = valb4.value

    let pattern = /[a-zA-Z2-9]+$/;
    let patResult = pattern.test(newVal);
    let patResultB = pattern.test(newValb4);
    
    if(patResult != true && patResultB != true){
        const display = document.getElementById('resultVal4')
        const displayOr = document.getElementById('resultOr4')

        //First Row input of OR and AND
        const and1 = document.getElementById('valA4')
        const or1 = document.getElementById('valOR4')
        and1.innerHTML = newVal
        or1.innerHTML = newVal
        //Second Row input of OR and AND
        const andb1 = document.getElementById('valB4')
        const orb1 = document.getElementById('valORb4')
        andb1.innerHTML = newValb4
        orb1.innerHTML = newValb4

        if(newVal == '' || newValb4==''){
            display.innerHTML = ''
            displayOr.innerHTML = ''
        }
        else{
            let result = Number(newVal==1 && newValb4==1)
            let resultOr = Number(newVal==1 || newValb4==1)
            
            const bool = (result == true) ? '1':'0'
            display.innerHTML = bool

            const boolOr = (resultOr == true) ? '1':'0'
            displayOr.innerHTML = boolOr
        }
    }else{
        document.getElementById('alert').innerHTML = 'Enter only 0 and 1'
    }
}

/*const arrayOfinputs = document.querySelectorAll('.input')
arrayOfinputs.forEach((input) => {
    input.addEventListener('input', () => {
        input.nextElementSibling.focus()
    })
})*/

val1.addEventListener('input', resultOne)
valb1.addEventListener('input', resultOne)

val2.addEventListener('input', resultTwo)
valb2.addEventListener('input', resultTwo)

val3.addEventListener('input', resultThree)
valb3.addEventListener('input', resultThree)

val4.addEventListener('input', resultFour)
valb4.addEventListener('input', resultFour)
