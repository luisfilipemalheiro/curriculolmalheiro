function addRow() {
    const form = document.getElementById("myForm");
    const newRow = document.createElement("input");

    //newRow.innerHTML = "Name:";
    newRow.style = "margin-top: 10px";
    newRow.type = "text";
    newRow.className = "form-control";
    newRow.id = "nametask";
    newRow.name = "nametask";
    newRow.placeholder = "Insert Task";


    form.appendChild(newRow);
}