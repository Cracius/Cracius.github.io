window.addEventListener("DOMContentLoaded", function ()
{
    const Things = {"pr1": 2500, "pr2": 3000, "pr3": 1000, "pr4": 1555, "pr5": 1333};
    let amount = document.getElementById("amount");
    let product = document.getElementById("Things");
    let calcButton = document.getElementById("calculate");
    let resultfield = document.getElementById("result");
    calcButton.addEventListener("click", function ()
    {
        let inp = amount.value;
        if (inp.match(/^\d+$/) !== null)
        {
            let ava = Things[product.value] * inp;
            resultfield.innerText = ava;
        }
        else
        {
            resultfield.innerText = "Некорректный ввод";
        }
    });
});
