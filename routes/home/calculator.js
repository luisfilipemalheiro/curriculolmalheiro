

function test(){

    let salary = document.getElementById('salary').value; //vencimento base
    const typemedal = document.getElementById("typemedal").value; // tipo de subsidio
    const mealallowance = document.getElementById("mealallowance").value; //subsidicio refeicao


    if(salary == null || salary <=700 || typemedal == null || mealallowance == null || mealallowance <=0){
        document.getElementById("send").innerHTML = "Please insert valid numbers";
    }

    if(typemedal == 1 && mealallowance >= 7.33){
        salary += mealallowance;
        return salary;
    }

    if(typemedal == 2 && mealallowance >= 4.57){
        salary += mealallowance;
        return salary
    }


}