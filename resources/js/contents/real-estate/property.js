(function (window, document, $) {
    'use strict';

    const $baseUri = $('body').attr('data-asset-path');
    const $userView = $baseUri + 'real-estate/';

    const dtUserTable = $('.user-list-table'),
        createNewUserModal = $('.new-user-modal'),
        newUserForm = $('.add-new-user'),
        select = $('.select2'),
        dtContact = $('.dt-contact'),
        statusObj = {
            '0': {title: 'Banned', class: 'badge-light-danger'},
            '1': {title: 'Active', class: 'badge-light-success'}
        },
        roleBadgeObj = {
            'Member': feather.icons['user'].toSvg({class: 'font-medium-3 text-primary me-50'}),
            'Authorized Dealer': feather.icons['user'].toSvg({class: 'font-medium-3 text-primary me-50'}),
            'Consultant': feather.icons['settings'].toSvg({class: 'font-medium-3 text-warning me-50'}),
            'Investor': feather.icons['database'].toSvg({class: 'font-medium-3 text-success me-50'}),
            'Moderator': feather.icons['edit-2'].toSvg({class: 'font-medium-3 text-info me-50'}),
            'Administrator': feather.icons['slack'].toSvg({class: 'font-medium-3 text-danger me-50'}),
            'Super Administrator': feather.icons['slack'].toSvg({class: 'font-medium-3 text-danger me-50'})
        }

    // function deleteUser ($id) {
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
    //         }
    //     });
    //     $.ajax({
    //         url: $baseUri + 'web-api/real-estate/property/' + $id,
    //         type: "DELETE",
    //         success: function (response) {
    //             if (response) {
    //                 $('.success').text(response.success);
    //                 toastr['success']('User created successfully', 'Success!', {
    //                     closeButton: true,
    //                     tapToDismiss: false,
    //                     rtl: false
    //                 });
    //                 $("#create-new-user").reset();
    //                 createNewUserModal.modal('hide');
    //             }
    //         },
    //         error: function (jqXHR, textStatus, errorThrown) {
    //             const responseMsg = jQuery.parseJSON(jqXHR.responseText);
    //             const msg = responseMsg.message;
    //             if (jqXHR.status === 422) {
    //                 $.each(msg, function (key, value) {
    //                     toastr['error'](value, 'Error!', {
    //                         closeButton: true,
    //                         tapToDismiss: true,
    //                         rtl: false
    //                     });
    //                 });
    //             }
    //         }
    //     });
    // };

    function getHtmlInfo($data) {

        let $name = $data['full_name'],
            $email = $data['email'],
            $username = $data['username'],
            $base64Avatar = $data['base64_avatar'];

        // Creates full output for row
        let $row_output = '<div class="d-flex justify-content-left align-items-center">';
        $row_output = $row_output + '<div class="avatar-wrapper">';
        $row_output = $row_output + '<div class="avatar me-1">';
        $row_output = $row_output + '<img src="' + $base64Avatar + '" alt="avatar" class="avatar-img rounded-circle">';
        $row_output = $row_output + '</div>';
        $row_output = $row_output + '</div>';
        $row_output = $row_output + '<div class="d-flex flex-column">';
        $row_output = $row_output + '<a href="' + $userView + $data['id'] + '" class="user_name text-truncate text-body">';
        $row_output = $row_output + '<span class="fw-bolder">' + $name + '</span>';
        $row_output = $row_output + '</a>';
        $row_output = $row_output + '<small class="emp_post text-muted">' + $email + '</small>';
        $row_output = $row_output + '<small class="text-muted">@' + $username + '</small>';
        $row_output = $row_output + '</div>';
        $row_output = $row_output + '</div>';

        return $row_output
    }

    select.each(function () {
        const $this = $(this)
        $this.wrap('<div class="position-relative"></div>')
        $this.select2({
            // the following code is used to disable x-scrollbar when click in select input and
            // take 100% width in responsive also
            dropdownAutoWidth: true,
            width: '100%',
            dropdownParent: $this.parent()
        })
    })

    // Users List datatable
    if (dtUserTable.length) {
        var data = dtUserTable.DataTable({
            ajax: $baseUri + 'web-api/users', // JSON file to add data
            columns: [
                // columns according to JSON
                {data: ''},
                {data: 'full_name'},
                {data: 'role'},
                {data: 'phone'},
                {data: 'gender'},
                {data: 'address'},
                {data: 'birthday'},
                {data: 'status'},
                {data: 'last_login'},
                {data: ''}
            ],
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
                    // User full name and username
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return getHtmlInfo(full);
                    }
                },
                {
                    // User Role
                    targets: 2,
                    render: function (data, type, full, meta) {
                        let $role = full['role']
                        return "<span class='text-truncate align-middle'>" + roleBadgeObj[$role] + $role + '</span>'
                    }
                },
                {
                    // User Status
                    targets: 7,
                    render: function (data, type, full) {
                        let $status = full['status']

                        return (
                            '<span class="badge rounded-pill ' +
                            statusObj[$status].class +
                            '" text-capitalized>' +
                            statusObj[$status].title +
                            '</span>'
                        )
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({class: 'font-small-4'}) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-end">' +
                            '<a href="' +
                            $userView + full['id'] +
                            '" class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({class: 'font-small-4 me-50'}) +
                            'Details</a>' +
                            '<a class="dropdown-item delete-record" id="delete-user-id-' + full['id'] + '">' +
                            feather.icons['trash-2'].toSvg({class: 'font-small-4 me-50'}) +
                            'Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        )
                    }
                }
            ],
            order: [[1, 'desc']],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            // Buttons with Dropdown
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle me-2',
                    text: feather.icons['external-link'].toSvg({class: 'font-small-4 me-50'}) + 'Export',
                    buttons: [
                        {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({class: 'font-small-4 me-50'}) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 2, 3, 4, 5]}
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({class: 'font-small-4 me-50'}) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 2, 3, 4, 5]}
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({class: 'font-small-4 me-50'}) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 2, 3, 4, 5]}
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({class: 'font-small-4 me-50'}) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 2, 3, 4, 5]}
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({class: 'font-small-4 me-50'}) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: {columns: [1, 2, 3, 4, 5]}
                        }
                    ],
                    init: function (api, node) {
                        $(node).removeClass('btn-secondary')
                        $(node).parent().removeClass('btn-group')
                        setTimeout(function () {
                            $(node).closest('.dt-buttons').removeClass('btn-group').addClass('d-inline-flex mt-50')
                        }, 50)
                    }
                },
                {
                    text: 'Create New User',
                    className: 'add-new btn btn-primary',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#modals-slide-in'
                    },
                    init: function (api, node) {
                        $(node).removeClass('btn-secondary')
                    }
                }
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            const data = row.data();
                            return 'Details of ' + data['full_name']
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        const data = $.map(columns, function (col, i) {
                            return col.columnIndex !== 6 // ? Do not show row in modal popup if title is blank (for check box)
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
                                : ''
                        }).join('');
                        return data ? $('<table class="table"/>').append('<tbody>' + data + '</tbody>') : false
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
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(2)
                    .every(function () {
                        const column = this;
                        const label = $('<label class="form-label" for="UserRole">Role</label>').appendTo('.user_role');
                        const select = $(
                            '<select id="UserRole" class="form-select text-capitalize mb-md-0 mb-2"><option value=""> Select Role </option></select>'
                        )
                            .appendTo('.user_role')
                            .on('change', function () {
                                const val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw()
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>')
                            })
                    })
                // Adding status filter once table initialized
                this.api()
                    .columns(7)
                    .every(function () {
                        const column = this;
                        const label = $('<label class="form-label" for="FilterTransaction">Status</label>').appendTo('.user_status');
                        const select = $(
                            '<select id="FilterTransaction" class="form-select text-capitalize mb-md-0 mb-2xx"><option value=""> Select Status </option></select>'
                        )
                            .appendTo('.user_status')
                            .on('change', function () {
                                const val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw()
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append(
                                    '<option value="' +
                                    statusObj[d].title +
                                    '" class="text-capitalize">' +
                                    statusObj[d].title +
                                    '</option>'
                                )
                            })
                    })
            }
        })
    }

    // Form Validation
    if (newUserForm.length) {
        newUserForm.validate({
            errorClass: 'error',
            rules: {
                'name': {
                    required: true,
                    minlength: 6,
                    maxlength: 255
                },
                'username': {
                    required: true,
                    minlength: 6,
                    maxlength: 255
                },
                'email': {
                    required: true,
                    email: true,
                    minlength: 6,
                    maxlength: 255
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 255
                },
                'phone': {
                    required: true,
                },
                'gender': {
                    required: true,
                },
                'role': {
                    required: true,
                }
            }
        })

        newUserForm.on('submit', function (e) {
            const isValid = newUserForm.valid();
            e.preventDefault()
            if (isValid) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('value')
                    }
                });
                let name = $("input[name=name]").val();
                let username = $("input[name=username]").val();
                let email = $("input[name=email]").val();
                let password = $("input[name=password]").val();
                let phone = $("input[name=phone]").val();
                let gender = $('#gender').find(":selected").text()
                let role = $('#role').find(":selected").text();
                let _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: $baseUri + 'web-api/users',
                    type: "POST",
                    data: {
                        name: name,
                        username: username,
                        email: email,
                        password: password,
                        phone: phone,
                        gender: gender,
                        role: role,
                        _token: _token
                    },
                    success: function (response) {
                        if (response) {
                            $('.success').text(response.success);
                            toastr['success']('User created successfully', 'Success!', {
                                closeButton: true,
                                tapToDismiss: false,
                                rtl: false
                            });
                            $("#create-new-user").reset();
                            createNewUserModal.modal('hide');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        const responseMsg = jQuery.parseJSON(jqXHR.responseText);
                        const msg = responseMsg.message;
                        if (jqXHR.status === 422) {
                            $.each(msg, function (key, value) {
                                toastr['error'](value, 'Error!', {
                                    closeButton: true,
                                    tapToDismiss: true,
                                    rtl: false
                                });
                            });
                        }
                    }
                });
            }
        })
    }

    // Phone Number
    if (dtContact.length) {
        dtContact.each(function () {
            new Cleave($(this), {
                phone: true,
                phoneRegionCode: 'VN'
            })
        })
    }

    $(".delete-record").on('click', function (e) {
        var data = table.row( this ).data();
        alert( 'You clicked on '+data[0]+'\'s row' );
    });

})(window, document, jQuery);
