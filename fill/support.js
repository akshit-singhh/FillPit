// scripts.js
document.querySelectorAll('.support-button').forEach(button => {
    button.addEventListener('click', function() {
        const cause = this.getAttribute('data-cause');
        alert(`Thank you for supporting the ${cause} cause!`);
    });
});

// scripts.js
document.getElementById("donateButton").addEventListener("click", function() {
    const donationAmount = document.getElementById("donationAmount").value;
    const customAmount = document.getElementById("customAmount").value;

    let amountToDonate = customAmount ? customAmount : donationAmount;
    
    if (amountToDonate && amountToDonate > 0) {
        document.getElementById("paymentStatus").textContent = `Thank you for donating ₹${amountToDonate}! Payment processing...`;
        
        // Simulate payment process with a delay
        setTimeout(() => {
            document.getElementById("paymentStatus").textContent = `Payment successful for ₹${amountToDonate}!`;
        }, 2000);
        
        // Here you would integrate your payment API (e.g. Stripe or PayPal)
    } else {
        document.getElementById("paymentStatus").textContent = 'Please enter a valid amount to donate.';
    }
});

