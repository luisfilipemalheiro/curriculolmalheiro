async function editar(id){
    const editForm = document.getElementById("editform");
    const hardskill =  await fetch('update.php?id=' + id)
    const send = await hardskill.json();

    if(send['erro']){
        document.getElementById("send").innerHTML = send['msg'];
    }
    else{
        $('#myModal').modal('show')
        document.getElementById("idskill").value = send['hardskill'].id;
        document.getElementById("descricao").value = send['hardskill'].descricao;
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