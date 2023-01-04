async function editar(id){
    const editForm = document.getElementById("editform");
    const school =  await fetch('update.php?id=' + id)
    const sendform = await school.json();

    if(sendform['erro']){
        document.getElementById("sendform").innerHTML = sendform['msg'];
    }
    else{
        $('#myModal').modal('show')
        document.getElementById("idschool").value = sendform['school'].id;
        document.getElementById("description").value = sendform['school'].description;
        document.getElementById("startyear").value = sendform['school'].startyear;
        document.getElementById("endyear").value = sendform['school'].endyear;
        editForm.addEventListener("submit", async (e) =>{
            e.preventDefault();
            const dataForm = new FormData(editForm)

            const data = await fetch("update2.php", {
                method: "POST",
                body: dataForm
            })
            $('#myModal').modal('hide');
            openToast();





            const teste = await data.json()
            document.getElementById("sendform").innerHTML = sendform['msg'];
        })
    }
}


function openToast(){
    $(document).ready(function (){
        $('.toast').toast('show');
    })

}


































