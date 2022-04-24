function initPayPalButtonBuyNow(element, value) {
    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'gold',
            layout: 'vertical',
            label: 'buynow',

        },

        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{"description":"A","amount":{"currency_code":"{{ currency()->getUserCurrency() }}","value":value}}]
            });
        },

        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {

                // Full available details
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

                // Show a success message within this page, e.g.
                const element = document.getElementById('paypal-button-container');
                element.innerHTML = '';
                element.innerHTML = '<h3>Thank you for your payment!</h3>';

                // Or go to another URL:  actions.redirect('thank_you.html');

            });
        },

        onError: function(err) {
            console.log(err);
        }
    }).render(element);
}
