let step = document.getElementsByClassName('step');
let prevBtn = document.getElementById('prev-btn');
let nextBtn = document.getElementById('next-btn');
let submitBtn = document.getElementById('submit-btn');
let form = document.getElementsByTagName('form')[0];
let preloader = document.getElementById('preloader-wrapper');
let bodyElement = document.querySelector('body');
let succcessDiv = document.getElementById('success');

form.onsubmit = () => {
    return false
}
let current_step = 0;
let stepCount = 4
step[current_step].classList.add('d-block');
if (current_step == 0) {
    prevBtn.classList.add('d-none');
    submitBtn.classList.add('d-none');
    nextBtn.classList.add('d-inline-block');
}

const progress = (value) => {
    document.getElementsByClassName('progress-bar')[0].style.width = `${value}%`;
}

nextBtn.addEventListener('click', () => {
    current_step++;
    let previous_step = current_step - 1;
    if ((current_step > 0) && (current_step <= stepCount)) {
        prevBtn.classList.remove('d-none');
        prevBtn.classList.add('d-inline-block');
        step[current_step].classList.remove('d-none');
        step[current_step].classList.add('d-block');
        step[previous_step].classList.remove('d-block');
        step[previous_step].classList.add('d-none');
        if (current_step == stepCount) {
            submitBtn.classList.remove('d-none');
            submitBtn.classList.add('d-inline-block');
            nextBtn.classList.remove('d-inline-block');
            nextBtn.classList.add('d-none');
        }
    } else {
        if (current_step > stepCount) {
            form.onsubmit = () => {
                return true
            }
        }
    }
    progress((100 / stepCount) * current_step);
});


prevBtn.addEventListener('click', () => {
    if (current_step > 0) {
        current_step--;
        let previous_step = current_step + 1;
        prevBtn.classList.add('d-none');
        prevBtn.classList.add('d-inline-block');
        step[current_step].classList.remove('d-none');
        step[current_step].classList.add('d-block')
        step[previous_step].classList.remove('d-block');
        step[previous_step].classList.add('d-none');
        if (current_step < stepCount) {
            submitBtn.classList.remove('d-inline-block');
            submitBtn.classList.add('d-none');
            nextBtn.classList.remove('d-none');
            nextBtn.classList.add('d-inline-block');
            prevBtn.classList.remove('d-none');
            prevBtn.classList.add('d-inline-block');
        }
    }

    if (current_step == 0) {
        prevBtn.classList.remove('d-inline-block');
        prevBtn.classList.add('d-none');
    }
    progress((100 / stepCount) * current_step);
});


submitBtn.addEventListener('click', () => {
    preloader.classList.add('d-block');

    const timer = ms => new Promise((resolve, reject) => {
        let stock_outs = [];
        let stock_ins = [];
        let task_id = $('#taskid').val();
        let route_id = $('#routeid').val();

        $('input[name^=qty_stock_out]').map(function (idx, elem) {
            let catalog = elem.getAttribute('data-catalog');
            let region = elem.getAttribute('data-region');
            let o_catalog = JSON.parse(catalog)
            let qty_stock_out = $(elem).val()
            o_catalog['qty_stock_out'] = qty_stock_out;
            o_catalog['region'] = region;

            localStorage.removeItem(`prev_stock_out_${idx}`);

            stock_outs.push(o_catalog);
        });

        $('input[name^=qty_stock_in]').map(function (idx, elem) {
            var catalog = elem.getAttribute('data-catalog');
            let region = elem.getAttribute('data-region');
            let o_catalog = JSON.parse(catalog)
            var qty_stock_in = $(elem).val()
            o_catalog['qty_stock_in'] = qty_stock_in;
            o_catalog['region'] = region;

            localStorage.removeItem(`prev_stock_in_${idx}`);

            stock_ins.push(o_catalog);
        });

        $.ajax({
            url: '/mob/inventory/store',
            type: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                stock_outs, stock_ins, task_id, route_id
            },
            success: function (data) {
                setTimeout(resolve(data), ms)
            },
            error: function (error) {
                console.log(error);
                setTimeout(reject(error), ms)
            }
        });
    });

    timer(3000)
        .then(() => {
            bodyElement.classList.add('loaded');
        }).then(() => {
            step[stepCount].classList.remove('d-block');
            step[stepCount].classList.add('d-none');
            prevBtn.classList.remove('d-inline-block');
            prevBtn.classList.add('d-none');
            submitBtn.classList.remove('d-inline-block');
            submitBtn.classList.add('d-none');
            succcessDiv.classList.remove('d-none');
            succcessDiv.classList.add('d-block');
        })

});


var qty_stock_outs = $('input[name^=qty_stock_out]').map(function (idx, elem) {
    $(elem).on('change', () => {
        let stock_dec = parseInt($(elem).val());
        $('div[name^=new_stock_out]').map(function (idx2, elem2) {
            if (idx === idx2) {
                let previous_stockOut = parseInt(localStorage.getItem(`prev_stock_out_${idx2}`));
                if (isNaN(previous_stockOut)) {
                    localStorage.setItem(`prev_stock_out_${idx2}`, stock_dec);
                    previous_stockOut = 0;
                }

                let tot_stock_ele = document.getElementById(`total_consigned_${idx2}`);
                let initial_stock = parseInt(tot_stock_ele.getAttribute('data-initialstock'));
                let current_stock = parseInt(tot_stock_ele.innerHTML);

                if (stock_dec > initial_stock) {
                    alert(`Maximum allowable Stock Out is ${initial_stock}`);
                    $(elem).val(stock_dec - 1);
                    localStorage.setItem(`prev_stock_out_${idx2}`, stock_dec - 1);
                    document.getElementById(`new_stock_out_${idx2}`).innerHTML = stock_dec - 1;
                } else {
                    document.getElementById(`new_stock_out_${idx2}`).innerHTML = stock_dec;

                    if (stock_dec > previous_stockOut) {
                        tot_stock_ele.innerHTML = current_stock - 1;
                    } else {
                        tot_stock_ele.innerHTML = current_stock + 1;
                    }

                    localStorage.setItem(`prev_stock_out_${idx2}`, stock_dec);
                }
            }
        });
    });
}).get();


var IsStockAvailableAtBranchInventory = async (branchCode, productCode, quantityIn) => {
    return await $.ajax({
        type: 'POST',
        url: '/api/v1/inventory/validate',
        data: {
            branch: branchCode,
            product: productCode,
            quantity: quantityIn
        },
        success: function (data) {
            return data;
        }
    })

}

var qty_stock_ins = $('input[name^=qty_stock_in]').map(function (idx, elem) {
    $(elem).on('change', () => {
        let stock_inc = $(elem).val();
        $('div[name^=new_stock_in]').map(function (idx2, elem2) {
            var catalog = elem.getAttribute('data-catalog');
            let region = elem.getAttribute('data-region');
            let o_catalog = JSON.parse(catalog);

            if (idx === idx2) {
                let previous_stockIn = localStorage.getItem(`prev_stock_in_${idx2}`);
                if (previous_stockIn == null) {
                    localStorage.setItem(`prev_stock_in_${idx2}`, stock_inc);
                    previous_stockIn = 0;
                }

                document.getElementById(`new_stock_in_${idx2}`).innerHTML = stock_inc;

                let tot_stock_ele = document.getElementById(`total_consigned_${idx2}`);
                let current_stock = tot_stock_ele.innerHTML;
                if (parseInt(stock_inc) > parseInt(previous_stockIn)) {
                    IsStockAvailableAtBranchInventory(region, o_catalog['product_code'], stock_inc)
                        .then((response) => {
                            if (parseInt(response) === 1) {
                                tot_stock_ele.innerHTML = parseInt(current_stock) + 1;
                            } else {
                                alert('No Stock Available. Exceed Maximum Limit of Available Product ' + o_catalog['product_code']);
                                $(elem).val(stock_inc - 1);
                                localStorage.setItem(`prev_stock_in_${idx2}`, stock_inc - 1);
                                document.getElementById(`new_stock_in_${idx2}`).innerHTML = stock_inc - 1;
                            }
                        })

                } else {
                    tot_stock_ele.innerHTML = parseInt(current_stock) - 1;
                }

                localStorage.setItem(`prev_stock_in_${idx2}`, stock_inc);
            }
        });
    });
}).get();

$('#print_consignment').on('click', function () {
    let product_data = []
    $('.list-product').each(function () {
        var $this = $(this)
        product_data.push({
            catalog_id: this.id,
            total_consigned: parseInt($this.find('div.total-consigned').text()),
            total_add: parseInt($this.find('div.action-add').text()),
            total_sold: parseInt($this.find('div.action-remove').text())
        })
    })

    $.ajax({
        type: 'POST',
        url: '/api/v1/sales/create',
        data: JSON.stringify({
            products: product_data,
            'task_id': $('#taskid').val(),
            'customer_id': $('#custid').val(),
        }),
        success: function (data) {
            console.log(data)
            // window.location.href = 'my.bluetoothprint.scheme://https://ncig.onewoorks-solutions.com/print-data/sales/1'
        }
    })
    //do ajax call with payload yang dah dibind
    //suppose akan hantar ke printer bluetooth

})
