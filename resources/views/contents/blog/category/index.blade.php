@extends('layouts/contentLayoutMaster')
@section('title', __('Categories'))

@section('vendor-style')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom">
                    <h4 class="card-title">Search & Filter</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <x-filter.select-status-component type="normal" />
                        </div>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table class="datatables-basic table" id="category-data-table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Default</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $item)
                            <tr>
                                <td></td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->slug }}</td>
                                <td>
                                     <span class="badge rounded-pill text-capitalize
                                                    @if($item->isPublished()) badge-light-success @endif
                                                    @if($item->isDraft()) badge-light-secondary @endif
                                                    @if($item->isPending()) badge-light-warning @endif
                                                    text-capitalized">
                                                    {{ $item->status }}
                                                </span>
                                </td>
                                <td>
                                    <span class="avatar-content">
                                        @if($item->isFeatured())
                                            <em data-feather="check-circle" class="me-25 text-success"></em>
                                        @else
                                            <em data-feather="x-circle" class="me-25 text-danger"></em>
                                        @endif
                                    </span>
                                </td>
                                <td>
                                   <span class="avatar-content">
                                        @if($item->default())
                                           <em data-feather="check-circle" class="me-25 text-success"></em>
                                       @else
                                           <em data-feather="x-circle" class="me-25 text-danger"></em>
                                       @endif
                                    </span>
                                </td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                                <td>{{ $item->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="font-small-4" data-feather="more-vertical"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('categories.edit', $item->slug) }}"
                                               class="dropdown-item">
                                                <em data-feather="edit" class="font-small-4 me-50"></em> Edit
                                            </a>
                                            <a href="javascript:void(0)" class="dropdown-item"
                                               onclick="event.preventDefault();
                                                        document.getElementById('{{ 'delete-category-' . $item->slug }}').submit();">
                                                <em class="font-small-4 me-50" data-feather="trash-2"></em>
                                                Delete
                                            </a>
                                            <form id="{{ 'delete-category-' . $item->slug }}"
                                                  action="{{ route('categories.destroy', $item->slug) }}"
                                                  method="POST"
                                                  class="d-none" hidden>
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </td>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    <script>
        (function (window, document, $) {
            'use strict';

            const category_data_table = $('#category-data-table');
            category_data_table.DataTable({
                dom:
                    '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                    '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                    '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
                    '>t' +
                    '<"d-flex justify-content-between mx-2 row mb-1"' +
                    '<"col-sm-12 col-md-6"i>' +
                    '<"col-sm-12 col-md-6"p>' +
                    '>',
                buttons: [
                    {
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle me-2',
                        text: feather.icons['share'].toSvg({class: 'font-small-4 me-50'}) + 'Export',
                        buttons: [
                            {
                                extend: 'print',
                                text: feather.icons['printer'].toSvg({class: 'font-small-4 me-50'}) + 'Print',
                                className: 'dropdown-item',
                                exportOptions: {columns: [1, 2, 3, 4, 5, 6]}
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({class: 'font-small-4 me-50'}) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {columns: [1, 2, 3, 4, 5, 6]}
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({class: 'font-small-4 me-50'}) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {columns: [1, 2, 3, 4, 5, 6]}
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({class: 'font-small-4 me-50'}) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {columns: [1, 2, 3, 4, 5, 6]}
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({class: 'font-small-4 me-50'}) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {columns: [1, 2, 3, 4, 5, 6]}
                            }
                        ],
                        init: function (api, node, config) {
                            $(node).removeClass('btn-secondary');
                            $(node).parent().removeClass('btn-group');
                            setTimeout(function () {
                                $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex');
                            }, 50);
                        },
                    },
                    {
                        text: 'Create New Category',
                        className: 'add-new btn btn-primary',
                        attr: {
                            'id': 'add-new-category',
                        },
                        init: function (api, node) {
                            $(node).removeClass('btn-secondary')
                        }
                    }
                ],
                responsive: {
                    details: {
                        type: 'column',
                        renderer: function (api, rowIdx, columns) {
                            const data = $.map(columns, function (col, i) {
                                return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                    ? '<tr data-dt-row="' +
                                    col.rowIdx +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td>' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>'
                                    : '';
                            }).join('');

                            return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false;
                        }
                    }
                },
                language: {
                    searchPlaceholder: 'Search..',
                    search: 'Search',
                    paginate: {
                        // remove previous & next text from pagination
                        previous: ' ',
                        next: ' '
                    }
                },
                columnDefs: [
                    {
                        // For Responsive
                        className: 'control',
                        orderable: false,
                        responsivePriority: 2,
                        targets: 0,
                        render: function (data, type, full, meta) {
                            return ''
                        }
                    },
                    {
                        className: 'text-center',
                        targets: 5,
                    },
                    {
                        className: 'text-center',
                        targets: 6,
                    },
                    {
                        className: 'text-center',
                        orderable: false,
                        targets: 9,
                    }
                ],
                order: [[1, 'desc']],
                initComplete: function (settings, json) {
                    const table = settings.oInstance.api();
                    table.columns(4).every(function () {
                        const column = this;
                        $('#filter-status').on('change', function () {
                            const val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column.search(val, true, false).draw()
                        });
                    });
                }
            });

            $('#add-new-category').on('click', function () {
                window.location.href = '{{ route('categories.create') }}';
            });
        })(window, document, jQuery);
    </script>
@endsection

