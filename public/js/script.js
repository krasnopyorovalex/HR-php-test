document.addEventListener('DOMContentLoaded', function () {

    const token = document.head.querySelector('meta[name="csrf-token"]');

    const productPrices = document.getElementsByClassName('price-value');
    const formProductPrices = document.getElementsByClassName('form-update-price');

    if (formProductPrices.length) {
        const productPricesLength = productPrices.length;
        const formProductPricesLength = formProductPrices.length;

        for (let i = 0; i < productPricesLength; i++) {
            productPrices[i].addEventListener("click", function (event) {
                return event.currentTarget.closest('.price').querySelector('form').classList.toggle('hidden');
            });
        }

        for (let i = 0; i < formProductPricesLength; i++) {
            formProductPrices[i].addEventListener("submit", function (event) {
                event.preventDefault();

                const form = event.currentTarget;

                return updatePrice(form, token).then(function (response) {
                    return response.json();
                }).then(function (content) {
                    if (content.status === 'ok') {
                        form.closest('.price').querySelector('form').classList.toggle('hidden');
                        form.querySelector('input[name=price]').value = content.price;
                        form.closest('.price').querySelector('.price-value').innerText = content.price;
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            });
        }
    }

    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })

});

function updatePrice(form, token) {

    const payload = {
        price: form.querySelector('input[name=price]').value
    };

    return fetch(form.getAttribute('action'), {
        method: 'PUT',
        credentials: 'same-origin',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
            'X-CSRF-Token': token.content
        },
        body: JSON.stringify(payload)
    });
}
