async function editar(id){
    const editForm = document.getElementById("editform");
    const dados =  await fetch('update.php?id=' + id)
    const resposta = await dados.json();
    console.log(resposta);

    if(resposta['erro']){
        //msgAlerta.innerHTML = resposta['msg];
    }
    else{
        $('#myModal').modal('show')
        document.getElementById("idskill").value = resposta['dados'].id;
        document.getElementById("descricao").value = resposta['dados'].descricao;
        editForm.addEventListener("submit", async (e) =>{
            e.preventDefault();
            const dadosForm = new FormData(editForm)

/*
            for( var dadosteste of dadosForm.entries()){
                console.log(dadosteste[0] + "" + dadosteste[1]);
            }
            */

            const dados = await fetch("update2.php", {
                method: "POST",
                body: dadosForm
            })

            const teste = await dados.json()
            console.log(teste);


        })
    }



}