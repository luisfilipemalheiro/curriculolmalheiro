
let count = 0;

function addRow2() {
    const form = document.getElementById("myForm");
    const newRow = document.createElement("input");

    count++;
    console.log(count)

    //newRow.innerHTML = "Name:";

    newRow.style = "margin-top: 10px";
    newRow.type = "text";
    newRow.className = "form-control";
    newRow.id = "nametask" + count;
    console.log("nametask" + count);
    newRow.name = "nametask" + count;
    newRow.placeholder = "Insert Task";

    form.appendChild(newRow);

}

