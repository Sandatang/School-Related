const number = document.getElementsByClassName("a")

const input = document.getElementById("input")
const result = document.getElementById("result")
const clear = document.getElementById("clear")
const erase = document.getElementById("erase")
const equal = document.getElementById("totalCalculation")

for(let i=0;i<number.length;i++){
	number[i].addEventListener('click', AppendInput)
}

//FUNCTIONS
function AppendInput(){
	input.value += this.innerText
}

function ClearText(){
	input.value = ''
	result.innerText = ''
}

function  TotalValue(){
	let str = input.value
	
	try{
		let ans = Function('return ' + str)()
		result.innerText = 'Answer:'+ans
	}catch(error){
		result.innerText = 'Mathematical Error'
	}
}
function eraseText(){
	input.value = input.value .toString().slice(0, -1)
}
erase.addEventListener('click', eraseText)
clear.addEventListener('click', ClearText)
equal.addEventListener('click', TotalValue)