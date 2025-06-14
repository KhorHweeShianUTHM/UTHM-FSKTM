	document.addEventListener("DOMContentLoaded", () => {
        const rows = document.querySelectorAll("tbody tr");
        const orderCodeElement = document.querySelector(".order-code");
        const progressBarElement = document.querySelector(".progress-bar");
        const deliveryInfoElement = document.querySelector(".delivery-info");
    
        rows.forEach(row => {
            row.addEventListener("click", () => {
                const orderCode = row.getAttribute("data-order-code");
                const trackingNumber = row.getAttribute("data-tracking-number");
                const progress = row.getAttribute("data-progress").split(",");
                
                orderCodeElement.textContent = `Order Code: ${orderCode}`;
                
                const steps = progressBarElement.querySelectorAll(".step");
                steps.forEach((step, index) => {
                    if (progress[index] === "completed") {
                        step.classList.add("completed");
                    } else {
                        step.classList.remove("completed");
                    }
                });
                
                deliveryInfoElement.innerHTML = `Your order is on its way<br>J&T Express (tracking number ${trackingNumber})`;
            });
        });
    });