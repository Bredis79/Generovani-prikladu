//const print = document.querySelector('.btnTisk');
const sloupec = document.querySelectorAll(".vedle_online");
const priklad = document.querySelectorAll(".form").textContent;

const firstNumber = Number(document.querySelector(".first-number").textContent);
const secondNumber = Number(document.querySelector(".second-number").textContent);
const znamenko = document.querySelector(".mark").textContent;


// tisk prikladu
function tisk(){
	window.print()
};

// priprava pro online pocitani

/* function pocitani(firstNumber, znamenko, secondNumber) {
    let vysledek;
    switch (znamenko) {
        case '+':
            vysledek = firstNumber + secondNumber;
            break;
        case '-':
            vysledek = firstNumber - secondNumber;
            break;
        case 'x':
            vysledek = firstNumber * secondNumber;
            break;
        case '÷':
            vysledek = firstNumber / secondNumber;
            break;
        default:
            vysledek = 'Neplatný operátor';
            break;
    }
    return vysledek;
}

const prvniCislo = firstNumber;
const druheCislo = secondNumber


const pocet = pocitani(prvniCislo, znamenko, druheCislo);


sloupec.forEach(sloupec => {
	
	console.log(pocet);
	
});
 */



