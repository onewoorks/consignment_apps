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
        $('input[name^=qty_stock_out]').map(function (idx, elem) {
            let catalog = elem.getAttribute('data-catalog');
            let region = elem.getAttribute('data-region');
            let o_catalog = JSON.parse(catalog)
            let qty_stock_out = $(elem).val()
            o_catalog['qty_stock_out'] = qty_stock_out;
            o_catalog['region'] = region;

            stock_outs.push(o_catalog);
        });

        $('input[name^=qty_stock_in]').map(function (idx, elem) {
            var catalog = elem.getAttribute('data-catalog');
            let region = elem.getAttribute('data-region');
            let o_catalog = JSON.parse(catalog)
            var qty_stock_in = $(elem).val()
            o_catalog['qty_stock_in'] = qty_stock_in;
            o_catalog['region'] = region;

            stock_ins.push(o_catalog);
        });

        $.ajax({
            url: '/mob/inventory/store',
            type: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
                stock_outs, stock_ins
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
        $('div[name^=new_stock_out]').map(function (idx2, elem2) {
            if (idx === idx2) {
                document.getElementById(`new_stock_out_${idx2}`).innerHTML = $(elem).val();
            }
        });
    });
}).get();

var qty_stock_ins = $('input[name^=qty_stock_in]').map(function (idx, elem) {
    $(elem).on('change', () => {
        $('div[name^=new_stock_in]').map(function (idx2, elem2) {
            if (idx === idx2) {
                document.getElementById(`new_stock_in_${idx2}`).innerHTML = $(elem).val();
            }
        });
    });
}).get();
