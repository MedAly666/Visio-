@extends('settings.index')
@push('settings.styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css" rel="stylesheet">
@endpush
@section('settings')
    <div class="container flex justify-center items-center flex-col w-full  mt-20">
        <div>
            <p class="text-7xl font-weight-bold  " style="font-weight: 700">All Teachers </p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg shadow p-4 mt-20 w-[90%] mb-20">
            <div class="text-3xl text-center font-semibold text-gray-900 mb-4">Manage Modules</div>
            <div class="w-[100%]">
                {{-- {!! $dataTab->table() !!} --}}
                <table class="table table-bordered w-full display" id="modules">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Module</th>
                            <th>Department </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
        <div class="h-44 border-2 rounded-2xl flex justify-center items-center mb-20">
            <!-- Button to open modal -->
            <button data-modal-target="module-modal" data-modal-toggle="module-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 focus:outline-none m-96" type="button">
                Add a module
            </button>

            <!-- Flowbite Modal -->
            <div id="module-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                            <h3 class="text-2xl font-bold text-gray-900">
                                Add a module!
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="module-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                    <form id="create-module" action="{{route('modules.create')}}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Module name</label>
                            <input type="text" name="teacher_name" id="name" placeholder="Enter module name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>
                        <div>
                            <label for="grade" class="block mb-2 text-sm font-medium text-gray-900">Module grade</label>
                            <select name="teacher_grade" id="grade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="0">Select a grade</option>
                                <option value="Maitre A">Maitre A</option>
                                <option value="Maitre B">Maitre B</option>
                            </select>
                        </div>
                        <div>
                            <label for="type" class="block mb-2 text-sm font-medium text-gray-900">Module type</label>
                            <select name="teacher_type" id="type" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="0">Select a type</option>
                                <option value="Detache">Detache</option>
                                <option value="Vacataire">Vacataire</option>
                                <option value="ENPEI">ENPEI</option>
                                <option value="EMP">EMP</option>
                                <option value="DSS">DSS</option>
                            </select>
                        </div>
                        {{-- <div>
                            <label for="depart" class="block mb-2 text-sm font-medium text-gray-900">Department</label>
                            <select name="department_id" id="depart" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="">Select a Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </form>
                        <!-- Modal footer -->
                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                            <button type="submit" form="create-module" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create</button>
                            <button data-modal-hide="module-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Close</button>
                        </div>
                    </div>
                </div>
            </div>
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
            var table = $('#modules').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('settings.modules') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'module',
                        name: 'module',
                        searchable: true
                    },
                    {
                        data: 'department.department',
                        name: 'department.department'
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



        });
    </script>
@endpush
