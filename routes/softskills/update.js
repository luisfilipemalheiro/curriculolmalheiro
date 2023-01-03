async function editar(id){
    console.log(id)
    const editForm = document.getElementById("editform");
    const skill =  await fetch('update.php?id=' + id)
    const send = await skill.json();

    if(send['erro']){
        document.getElementById("send").innerHTML = send['msg'];
    }
    else{
        $('#myModal').modal('show')
        document.getElementById("idskill").value = send['skill'].id;
        document.getElementById("descricaosf").value = send['skill'].descricao;
        editForm.addEventListener("submit", async (e) =>{
            e.preventDefault();
            const dataForm = new FormData(editForm)

            const data = await fetch("update2.php", {
                method: "POST",
                body: dataForm
            })

            const teste = await data.json()
            //document.getElementById("send").innerHTML = send['msg'];
        })
    }



}