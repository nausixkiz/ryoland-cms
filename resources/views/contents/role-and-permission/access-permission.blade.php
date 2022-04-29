@extends('layouts/contentLayoutMaster')

@section('title', 'Permission')

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
    <h3>Permissions List</h3>
    <p>Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>

    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-permissions table">
                <thead class="table-light">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Name</th>
                    <th>Assigned To</th>
                    <th>Created Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!--/ Permission Table -->

    @include('_partials/_modals/modal-add-permission')
    @include('_partials/_modals/modal-edit-permission')
@endsection

@section('vendor-script')
    <!-- Vendor js files -->
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script>
        $(function () {
            ('use strict');
            var addPermissionForm = $('#addPermissionForm');

            // jQuery Validation
            // --------------------------------------------------------------------
            if (addPermissionForm.length) {
                addPermissionForm.validate({
                    rules: {
                        modalPermissionName: {
                            required: true
                        }
                    }
                });
            }

            // reset form on modal hidden
            $('.modal').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
            });

            var editPermissionForm = $('#editPermissionForm');

            // jQuery Validation
            // --------------------------------------------------------------------
            if (editPermissionForm.length) {
                editPermissionForm.validate({
                    rules: {
                        editPermissionName: {
                            required: true
                        }
                    }
                });
            }
        });

    </script>
    <script src="{{ asset(mix('js/scripts/pages/app-access-permission.js')) }}"></script>
@endsection
