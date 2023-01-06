
async function updateexp(id){
    const editExp = document.getElementById("editexp");
    const expirence =  await fetch('updateexp.php?id=' + id)
    const sendexp = await expirence.json();

    if(sendexp['erro']){
        console.log(sendform['erro']);
    }
    else{
        $('#updateexpirence').modal('show')
        document.getElementById("idexp").value = sendexp['expirence'].id;
        document.getElementById("titleexp").value = sendexp['expirence'].title;
        document.getElementById("descriptonexp").value = sendexp['expirence'].descripton;
        editExp.addEventListener("submit", async (e) =>{
            e.preventDefault();
            const dataForm = new FormData(editExp)
            console.log(dataForm)

            const data = await fetch("update2exp.php", {
                method: "POST",
                body: dataForm
            })
            $('#updateexpirence').modal('hide');
            openToast();





            const teste = await data.json()
            console.log(teste)
        })
    }
}

function openToast(){
    $(document).ready(function (){
        $('.toast').toast('show');
    })

}


function addModal(){
    $('#adicionarModal').modal('show');

}
