async function editar(id){
    const editForm = document.getElementById("editform");
    const dados =  await fetch('update.php?id=' + id)
    const send = await dados.json();

    if(send['erro']){
        document.getElementById("send").innerHTML = send['msg'];
    }
    else{
        $('#myModal').modal('show')
        document.getElementById("idskill").value = send['dados'].id;
        document.getElementById("descricao").value = send['dados'].descricao;
        editForm.addEventListener("submit", async (e) =>{
            e.preventDefault();
            const dataForm = new FormData(editForm)

/*
            for( var dadosteste of dadosForm.entries()){
                console.log(dadosteste[0] + "" + dadosteste[1]);
            }
            */

            const data = await fetch("update2.php", {
                method: "POST",
                body: dataForm
            })

            const teste = await data.json()
            document.getElementById("send").innerHTML = send['msg'];
        })
    }



}