document.addEventListener("DOMContentLoaded", function() {
    const quantityInput = document.getElementById("quantity");
    const productSelect = document.getElementById("product");
    const calculateBtn = document.getElementById("calculateBtn");
    const resultOutput = document.getElementById("result");

    function calculateTotal() {
        const quantity = quantityInput.value;
        const price = productSelect.value;
        const total = quantity * price;
        resultOutput.textContent = `Стоимость заказа: ${total}₽`;
    }

    calculateBtn.addEventListener("click", calculateTotal);

    const serviceQuantityInput = document.getElementById("serviceQuantity");
    const serviceTypeInputs = document.getElementsByName("serviceType");
    const serviceOptions = document.getElementById("serviceOptions");
    const serviceOptionSelect = document.getElementById("serviceOption");
    const serviceProperty = document.getElementById("serviceProperty");
    const additionalPropertyCheckbox = document.getElementById("additionalProperty");
    const calculateServiceBtn = document.getElementById("calculateServiceBtn");
    const serviceResultOutput = document.getElementById("serviceResult");

    function updateServiceFields() {
        const selectedType = Array.from(serviceTypeInputs).find(input => input.checked)?.value;
        
        if (selectedType === "type1") {
            serviceOptions.style.display = "none";
            serviceProperty.style.display = "none";
        } else if (selectedType === "type2") {
            serviceOptions.style.display = "block";
            serviceProperty.style.display = "none";
        } else if (selectedType === "type3") {
            serviceOptions.style.display = "none";
            serviceProperty.style.display = "block";
        }
    }

    function calculateServiceTotal() {
        const quantity = parseInt(serviceQuantityInput.value);
        let basePrice = 0;

        const selectedType = Array.from(serviceTypeInputs).find(input => input.checked)?.value;
        if (selectedType === "type1") {
            basePrice = 100;
        } else if (selectedType === "type2") {
            basePrice = 150;
            basePrice += parseInt(serviceOptionSelect.value);
        } else if (selectedType === "type3") {
            basePrice = 200;
            if (additionalPropertyCheckbox.checked) {
                basePrice += 200;
            }
        }

        const total = quantity * basePrice;
        serviceResultOutput.textContent = `Общая стоимость услуги: ${total}₽`;
    }

    serviceTypeInputs.forEach(input => {
        input.addEventListener("change", updateServiceFields);
    });

    calculateServiceBtn.addEventListener("click", calculateServiceTotal);
});
