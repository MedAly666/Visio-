@extends('default')
@push('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css" rel="stylesheet">
@endpush
@section('content')
    <div class="container flex justify-center items-center flex-col w-full  mt-0">
        <div>
            <p class="text-2xl font-weight-bold text-gray-800" style="font-weight: 700">All Teachers </p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg shadow p-4 mt-20 w-[90%] mb-20">
            <div class="text-3xl text-center font-semibold text-gray-900 mb-4">Manage Teachers</div>
            <div class="w-[100%]">
                {{-- {!! $dataTab->table() !!} --}}
                <table class="table table-bordered w-full display" id="teachers">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Teacher Name</th>
                            <th>Teacher Grade</th>
                            <th>Department </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->teacher_name }}</td>
                                <td>{{ $teacher->teacher_type }}</td>
                                <td>{{ $teacher->department->department }}</td>
                                <td>
                                    <a href="{{ route('teachers.show', ['id' => $teacher->id]) }}"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-1.5 focus:outline-none">View</a>
                                    <a href="javascript:void(0)" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-1.5 focus:outline-none ml-2">Edit</a>
                                    <a href="javascript:void(0)" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-3 py-1.5 focus:outline-none ml-2">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        @vite('resources/js/app.js')
        <script>
            $(function() {
                var table = $('#teachers').DataTable({

                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('teachers.index') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'teacher_name',
                            name: 'teacher_name',
                            searchable: true
                        },
                        {
                            data: 'teacher_type',
                            name: 'teacher_type'
                        },
                        {
                            data: 'department.department',
                            name: 'department_id',
                            searchable: false,
                            orderable: true
                        },
                        
                        {
                            data: 'action',
                            name: 'action'
                        }

                    ],
                    buttons: [{
                            extend: 'copy',
                            exportOptions: {
                                columns: ':not(.exclude)' // Exclude columns with the 'exclude' class from export
                            }
                        },
                        {
                            extend: 'excel',
                            exportOptions: {
                                columns: ':not(.exclude)' // Exclude columns with the 'exclude' class from export
                            }
                        },
                        {
                            extend: 'pdf',
                            exportOptions: {
                                columns: ':not(.exclude)' // Exclude columns with the 'exclude' class from export
                            },
                            customize: function(doc) {
                                // Remove buttons from PDF export
                                $(doc.document.body).find('button').remove();
                            }
                        }
                    ],
                    layout: {
                        top2Start: {
                            buttons: [{
                                extend: 'copyHtml5',
                                text: '<i class="fa fa-files-o">Copy</i>',
                                titleAttr: 'Copy',
                                className: 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none'
                            }, {
                                extend: 'csvHtml5',
                                text: '<i class="fa fa-file-excel-o">CSV</i>',
                                titleAttr: 'CSV',
                                className: 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none'
                            }, {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel-o">Excel</i>',
                                titleAttr: 'Excel',
                                className: 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none'
                            }, {
                                extend: 'pdfHtml5',
                                text: '<i class="fa fa-file-pdf-o">Pdf</i>',
                                titleAttr: 'PDF',
                                className: 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none'
                            }, {
                                extend: 'print',
                                text: '<i class="fa fa-file-excel-o">Print</i>',
                                titleAttr: 'Print',
                                className: 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none'
                            }]
                        }
                    },
                    
                });

                table.on('click', 'tbody tr', function() {
                    let data = table.row(this).data();
                    let teacherId = data.id;
                    window.location.href = "{{ route('teachers.show', ':id') }}".replace(':id', teacherId);
                });

            });
        </script>
    @endpush
