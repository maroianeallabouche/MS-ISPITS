
function makeTable(){
    var table=document.getElementById("tab");
    var row=parseInt(document.getElementById("rows").value);
    var col= parseInt(document.getElementById("cols").value);
    if(col==1){
        row+=0;
    } else {
    if(row%2==0){
        row/=2;
    } else if(row%2==1){
        row+=1;
        row/=2;
    } }
 console.log(row+" "+col);
   var i=1;
 for(var rowIndex=0;rowIndex<1;rowIndex++){
    var tr=document.createElement("tr");
    for(var colIndex=0;colIndex<col;colIndex++){
        var td=document.createElement("th");
        var text=document.createTextNode('Group'+" "+i++);
        td.className="th2";
        td.appendChild(text);
        tr.appendChild(td);
    }
    table.appendChild(tr);
}
   
    for(var rowIndex=0;rowIndex<row;rowIndex++){
        var tr=document.createElement("tr");
        for(var colIndex=0;colIndex<col;colIndex++){
            var td=document.createElement("td");
            td.className="td2";
            td.setAttribute("ondrop","drop(event)");
            td.setAttribute("ondragover","allowDrop(event)");
            tr.appendChild(td);
        }

        table.appendChild(tr);
     
    }
}

document.getElementById('make').addEventListener('click', makeTable);