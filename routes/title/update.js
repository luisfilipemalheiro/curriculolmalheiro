async function editar(id){
    const editForm = document.getElementById("editform");
    const title =  await fetch('update.php?id=' + id)
    const sendtitle = await title.json();

    if(sendtitle['erro']){
        console.log("ERROR")
        //document.getElementById("sendtitle").innerHTML = sendtitle['msg'];
    }
    else{
        $('#myModal').modal('show')
        document.getElementById("idtitle").value = sendtitle['title'].id;
        document.getElementById("firstname").value = sendtitle['title'].firstname;
        document.getElementById("lastname").value = sendtitle['title'].lastname;
        document.getElementById("imagepath").value = sendtitle['title'].imagepath;
        document.getElementById("description").value = sendtitle['title'].description;
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


        })
    }

}

function openToast(){
    $(document).ready(function (){
        $('.toast').toast('show');
    })

}

function uploadimageok(){
    const upload = document.getElementById("upload");
    upload.addEventListener("submit", async (e) => {
        console.log("entrei")
        $('#myModal').modal('show')
    })
}