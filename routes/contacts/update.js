async function edit(id){
    const editForm = document.getElementById("editform");
    const dados =  await fetch('update.php?id=' + id)
    const send = await dados.json();

    if(send['erro']){
        document.getElementById("send").innerHTML = send['msg'];
    }
    else{
        $('#myModal').modal('show')
        document.getElementById("idcontact").value = send['dados'].id;
        document.getElementById("telephone").value = send['dados'].telephone;
        document.getElementById("email").value = send['dados'].email;
        editForm.addEventListener("submit", async (e) =>{
            e.preventDefault();
            const dataForm = new FormData(editForm)

            const data = await fetch("update2.php", {
                method: "POST",
                body: dataForm
            })
            $('#myModal').modal('hide');

            const teste = await data.json()
            document.getElementById("send").innerHTML = send['msg'];
        })
    }


}