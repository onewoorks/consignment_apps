@extends('layouts.mob.master')

@section('title')
@endsection

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="card p-0">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-3">
                            <h5 class="text-primary">Kedai Ali</h5>
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-sm-4">
                        <h5 class="font-size-15 text-truncate">{{ Auth::user()->name }}</h5>
                        <p class="text-muted mb-0 text-truncate">0196693481</p>
                    </div>

                    <div class="col-sm-8">
                        <div class="pt-4">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="font-size-15">125</h5>
                                    <p class="text-muted mb-0">Stock Consigned</p>
                                </div>
                                <div class="col-6">
                                    <h5 class="font-size-15">RM 1,291.00</h5>
                                    <p class="text-muted mb-0">Expected Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @for($i = 1; $i <= 15; $i++)
    <div id="product-{{$i}}"class="row list-product">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <div>nama barang {{ $i }}</div>
                        <div class='total-consigned'>{{ rand ( 1 , 99 ) }}</div>

                    </div>
                    <div class="col-2 text-center">
                        <div class="btn btn-success btn-lg action-add" data-add="0">0</div>
                    </div>
                    <div class="col-2 text-center">
                        <div class="btn btn-danger btn-lg action-remove" data-remove="0">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endfor

    <div class="mt-4">&nbsp;</div>

    <div class="row g-0 fixed-footer">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-grid mt-2">
                    <div
                    class="btn btn-primary btn-block"
                    id='print_consignment'>Print Consigment Note
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection
@section('script')
    <script type="text/javascript">
        $('.action-add').on('click', function(){
            let add_value = parseInt($(this).data('add'))
            add_value++
            $(this).data('add', add_value)
            $(this).text(add_value)
        })
        $('.action-remove').on('click', function(){
            let remove_value = parseInt($(this).data('remove'))
            remove_value++
            $(this).data('remove', remove_value)
            $(this).text(remove_value)
        })
        $('#print_consignment').on('click', function(){
            let product_data = []
            $('.list-product').each(function(){
                var $this = $(this)
                product_data.push({
                    product_id: this.id,
                    total_consigned: parseInt($this.find('div.total-consigned').text()),
                    total_add: parseInt($this.find('div.action-add').data('add')),
                    total_sold: parseInt($this.find('div.action-remove').data('remove'))
                })
            })

            $.ajax({
                type: 'POST',
                url: '/api/v1/sales/create',
                data: JSON.stringify({
                    products: product_data
                }),
                success: function (data) {
                    console.log(data)
                    // window.location.href = 'my.bluetoothprint.scheme://https://ncig.onewoorks-solutions.com/print-data/sales/1'
                }
            })
            //do ajax call with payload yang dah dibind
            //suppose akan hantar ke printer bluetooth

        })
    </script>
@endsection
