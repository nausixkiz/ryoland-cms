@extends('layouts/contentLayoutMaster')

@section('title', 'Roles')

@section('vendor-style')
    <!-- Vendor css files -->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
@endsection

@section('content')
    <h3>Roles List</h3>
    <p class="mb-2">
        A role provided access to predefined menus and features so that depending <br/>
        on assigned role an administrator can have access to what he need
    </p>

    <!-- Role cards -->
    <div class="row">
        @foreach($listRoles as $role)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <span>Total {{ $role['userCount'] }} users</span>
                            @if($role['userCount'] > 0)
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    @foreach($role['userList'] as $user)
                                        <li
                                            data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom"
                                            data-bs-placement="top"
                                            title="{{ $user->name }}"
                                            class="avatar avatar-sm pull-up"
                                        >
                                            <img class="rounded-circle"
                                                 src="{{ Avatar::create($user->name)->toBase64() }}"
                                                 alt="{{ $user->name }}"/>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                        <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                            <div class="role-heading">
                                <h4 class="fw-bolder">{{ $role['name'] }}</h4>
                                <a href="javascript:" class="role-edit-modal" data-bs-toggle="modal"
                                   data-bs-target="#addRoleModal">
                                    <small class="fw-bolder">{{ __('Edit Role') }}</small>
                                </a>
                            </div>
                            <a href="javascript:void(0);" class="text-body">
                                <i data-feather="copy" class="font-medium-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end justify-content-center h-100">
                            <img
                                src="{{asset('images/illustration/faq-illustrations.svg')}}"
                                class="img-fluid mt-2"
                                alt="Image"
                                width="85"
                            />
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <a
                                href="javascript:void(0)"
                                data-bs-target="#addRoleModal"
                                data-bs-toggle="modal"
                                class="stretched-link text-nowrap add-new-role"
                            >
                                <span class="btn btn-primary mb-1">{{ __('Create New Role') }}</span>
                            </a>
                            <p class="mb-0">Add role, if it does not exist</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    <!--/ Role cards -->--}}

    {{--    <h3 class="mt-50">Total users with their roles</h3>--}}
    {{--    <p class="mb-2">Find all of your company’s administrator accounts and their associate roles.</p>--}}
    {{--    <!-- table -->--}}
    {{--    <div class="card">--}}
    {{--        <div class="table-responsive">--}}
    {{--            <table class="user-list-table table">--}}
    {{--                <thead class="table-light">--}}
    {{--                <tr>--}}
    {{--                    <th></th>--}}
    {{--                    <th></th>--}}
    {{--                    <th>Name</th>--}}
    {{--                    <th>Role</th>--}}
    {{--                    <th>Plan</th>--}}
    {{--                    <th>Billing</th>--}}
    {{--                    <th>Status</th>--}}
    {{--                    <th>Actions</th>--}}
    {{--                </tr>--}}
    {{--                </thead>--}}
    {{--            </table>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <!-- table -->--}}

    @include('_partials._modals.modal-add-role')
@endsection

@section('vendor-script')
    <!-- Vendor js files -->
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script>
        (function () {
            var addRoleForm = $('#addRoleForm');

            // add role form validation
            if (addRoleForm.length) {
                addRoleForm.validate({
                    rules: {
                        modalRoleName: {
                            required: true
                        }
                    }
                });
            }

            // reset form on modal hidden
            $('.modal').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
            });

            // Select All checkbox click
            const selectAll = document.querySelector('#selectAll'),
                checkboxList = document.querySelectorAll('[type="checkbox"]');
            selectAll.addEventListener('change', t => {
                checkboxList.forEach(e => {
                    e.checked = t.target.checked;
                });
            });
        })();
    </script>
    <script src="{{ asset(mix('js/scripts/pages/app-access-roles.js')) }}"></script>
@endsection
