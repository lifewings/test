(function(){
    function handle(reason, _data) {
        switch (reason) {
            case 'load_data':
                $.post('/load', function (data) {
                    let result = JSON.parse(data);
                    let div = document.createElement('div');
                    div.innerHTML = "<p>Результат</p><div>" + result.result + "</div>";
                    document.body.append(div);
                    setTimeout(() => div.remove(), 2000);

                    if (result.productWrite && result.productWrite != undefined) {
                        let divProduct = document.createElement('div');
                        divProduct.innerHTML = "<p>Товары характеристики которых загружены</p><div>" + result.productWrite + "</div>";
                        document.body.append(divProduct);
                        setTimeout(() => divProduct.remove(), 2000);
                    }

                    if (result.productError && result.productError != undefined) {
                        let divError = document.createElement('div');
                        divError.innerHTML = "<p>Товары характеристики которых не загружены</p><div>" + result.productError + "</div>";
                        document.body.append(divError);
                        setTimeout(() => divError.remove(), 2000);
                    }
                });
                break;
            default:
                console.log(reason);
        }
        return false;
    }

    $(document).on('click', '[data-event]', function () {
        return handle.call(this, $(this).data('event'));
    });
})();