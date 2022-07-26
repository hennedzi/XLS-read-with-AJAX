let table=document.getElementById('tid');

let rmin=0;
let rmax=0;
let tempMin=9999;
let tempMax=0;
for(let i=0;i<992;i++){
    if(+table.rows[i].cells[2].innerHTML<tempMin){
        tempMin= +table.rows[i].cells[2].innerHTML;
        rmin=i;
    }
    if(+table.rows[i].cells[1].innerHTML>tempMax){
        tempMax= +table.rows[i].cells[1].innerHTML;
        rmax=i;
    }
}
console.log(rmin);
console.log(rmax);

table.rows[rmin].style.backgroundColor = 'green';
table.rows[rmax].style.backgroundColor = 'red';



   
