@extends('layouts.web.master')

@section('title')
    @lang('translation.Dashboards')
@endsection

@section('css')
    <!-- DataTables -->
    <link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Dashboards
        @endslot
        @slot('title')
            Shop
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><a href="{{ url('web/shop/add') }}"
                                class="btn btn-primary waves-effect waves-light">Add Shop</a></div>
                    </div>
                    <hr />
                    <div class="table-responsive">
                        <table class="table table-bordered dt-responsive  nowrap w-100" id="shopTable" width="100%"
                            cellspacing="0">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center d-none">#ID</th>
                                    <th class="text-center d-none">Shop Name</th>
                                    <th class="text-center">Shop Name</th>
                                    <th class="text-center">Region</th>
                                    <th class="text-center">Address</th>
                                    <th class="text-center">Owner</th>
                                    <th class="text-center">Phone No.</th>
                                    <th class="text-center">Last Visit</th>
                                    <th class="text-center">Created At</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($shops) && count($shops) > 0)
                                    @foreach ($shops as $shop)
                                        <tr style="vertical-align: middle;">
                                            <td class="text-center d-none">{{ $shop->id }}</td>
                                            <td class="text-center d-none">{{ $shop->shop_name }}</td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <div class="col-md-4 avatar-sm mx-auto mb-3 mt-1 float-start float-lg-none">
                                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                                            <img class="rounded-circle" src="{{ asset($shop->shop_image) }}"
                                                                alt="{{ $shop->shop_name }}" height="50">
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6 mt-4"><h5 class="text-truncate pb-1">{{ $shop->shop_name }}</h5></div>
                                                </div>
                                            </td>
                                            <td class="text-center">{{ $shop->region }}</td>
                                            <td class="text-left">{{ $shop->address }}</td>
                                            <td class="text-center">{{ $shop->owner }}</td>
                                            <td class="text-center">{{ $shop->phone_number }}</td>
                                            <td class="text-center">{{ $shop->last_visit }}</td>
                                            <td class="text-center">{{ $shop->created_at }}</td>
                                            <td class="text-center">
                                                {{-- <a data-bs-target="#viewShopModal" data-bs-toggle="modal" title="View"
                                                    data-shop="{{ $shop }}" class="text-success"><i
                                                        class="bx bx-detail font-size-18"></i>
                                                </a> --}}
                                                <a href="{{ url('web/shop/edit') }}/{{ $shop->id }}" title="Edit"
                                                    class="text-success"><i class="mdi mdi-pencil font-size-18"></i>
                                                </a>
                                                <a data-bs-target="#deleteShopModal" data-bs-toggle="modal" title="Delete"
                                                    data-shop="{{ $shop }}" class="text-danger"><i
                                                        class="mdi mdi-delete font-size-18"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteShopModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <strong><i class="far fa-trash-alt"></i>&nbsp;Delete</strong>&nbsp;Shop</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('web/shop/delete') }}" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <input id="shopid" name="shopid" type="hidden" value="" class="form-control">
                            <p>Are you sure to delete <strong><span id="dshop"></span></strong>?</p>
                            <p>&nbsp;</p>
                        </fieldset>
                        <div class="mt-3 d-grid">
                            <button class="btn btn-danger waves-effect waves-light" type="submit">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Required datatable js -->
    <script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var shopTable = $('#shopTable').DataTable();

            $('#shopTable tbody').on('click', 'tr', function() {
                var shop = shopTable.row(this).data();

                $('#shopid').val(shop[0]);
                document.getElementById("dshop").textContent = shop[1];
            });
        });
    </script>
@endsection
