@extends('layouts/contentLayoutMaster')

@section('title', __('Projects'))

@section('vendor-style')
    {{-- vendor css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Manage Your Projects</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <h4 class="card-title">Search & Filter</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <x-filter.select-status-component type="real-estate" />
                                </div>
                            </div>
                        </div>
                        <div class="card-datatable table-responsive pt-0">
                            <table class="datatables-basic table" id="data-table"
                                   aria-describedby="{{ __('Project Data Table') }}">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Thumbnail</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Sell Date</th>
                                    <th>Finish Date</th>
                                    <th>Author</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if($item->hasThumbnail())
                                                <img src="{{ $item->getThumbnailUrl() }}" alt="{{ $item->name }}"
                                                     width="50" height="50">
                                            @endif
                                        </td>
                                        <td>{{ $item->slug }}</td>
                                        <td>{!! $item->renderRealEstateBadgeHtml() !!}</td>
                                        <td>{{ $item->date_sell }}</td>
                                        <td>{{ $item->date_finish }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                        <td>{{ $item->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm dropdown-toggle hide-arrow"
                                                   data-bs-toggle="dropdown">
                                                    <i class="font-small-4" data-feather="more-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="{{ \Illuminate\Support\Facades\Config::get('app.main_url') . '/news/' .  $item->slug }}"
                                                       class="dropdown-item">
                                                        <em data-feather="eye" class="font-small-4 me-50"></em> View
                                                    </a>
                                                    <a href="{{ route('real-estate.projects.edit', $item->slug) }}"
                                                       class="dropdown-item">
                                                        <em data-feather="edit" class="font-small-4 me-50"></em> Edit
                                                    </a>
                                                    <a href="javascript:void(0)" class="dropdown-item"
                                                       onclick="event.preventDefault();
                                                        document.getElementById('{{ 'delete-project-' . $item->slug }}').submit();">
                                                        <em class="font-small-4 me-50" data-feather="trash-2"></em>
                                                        Delete
                                                    </a>
                                                    <form id="{{ 'delete-project-' . $item->slug }}"
                                                          action="{{ route('real-estate.projects.destroy', $item->slug) }}"
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
        </div>
    </div>
@endsection

@section('vendor-script')
    {{-- vendor files --}}
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
    {{-- Page js files --}}
    <script>
        const dataTable = $('#data-table');
        dataTable.DataTable({
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
                            exportOptions: {columns: [1, 3, 4, 5, 6, 7, 8, 9]}
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({class: 'font-small-4 me-50'}) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 3, 4, 5, 6, 7, 8, 9]}
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({class: 'font-small-4 me-50'}) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 3, 4, 5, 6, 7, 8, 9]}
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({class: 'font-small-4 me-50'}) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 3, 4, 5, 6, 7, 8, 9]}
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({class: 'font-small-4 me-50'}) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 3, 4, 5, 6, 7, 8, 9]}
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
                    text: 'Create New Project',
                    className: 'add-new btn btn-primary',
                    attr: {
                        'id': 'add-new-project',
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
        $('#add-new-project').on('click', function () {
            window.location.href = '{{ route('real-estate.projects.create') }}';
        });
    </script>
@endsection
