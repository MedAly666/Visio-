@extends('default')
@push('header')
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush


@section('content')
    <div class="container flex justify-center items-center flex-col w-full  mt-20">
        <div>
            <p class="text-7xl font-weight-bold" style="font-weight: 700">All Holidays of This Year</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg shadow mt-10 mb-10 w-[90%] p-4">
            <div class="text-3xl text-center font-semibold text-gray-900 mb-4">Manage Holidays</div>
            <div>

                <table class="table table-bordered display" id="holidays">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Holiday</th>
                            <th>Schoolyear</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                </table>
            </div>
            <div class="w-full flex justify-end">
                <button data-modal-target="holiday-modal" data-modal-toggle="holiday-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 m-4 focus:outline-none" type="button">Add Holiday</button>

                <!-- Flowbite Modal -->
                <div id="holiday-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                                <h3 class="text-lg font-semibold text-gray-900">Add Holiday</h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="holiday-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                            <form class="space-y-4" id="holiday-form">
                                <div>
                                    <label for="holiday_name" class="block mb-2 text-sm font-medium text-gray-900">Holiday</label>
                                    <input type="text" name="holiday_name" id="holiday_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                </div>
                                <div>
                                    <label for="holiday_date" class="block mb-2 text-sm font-medium text-gray-900">Date</label>
                                    <input type="date" name="holiday_date" id="holiday_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                </div>
                                <div>
                                    <label for="schoolyear_id" class="block mb-2 text-sm font-medium text-gray-900">Schoolyear</label>
                                    <select name="schoolyear_id" id="schoolyear_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                        <option value="{{ $current_schoolyear->id }}" selected>Current Schoolyear</option>
                                        @foreach ($schoolyears as $schoolyear)
                                            <option value="{{ $schoolyear->id }}">{{ $schoolyear->schoolyear }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            <!-- Modal footer -->
                            <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
                                <button type="button" id="holiday-add" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add</button>
                                <button data-modal-hide="holiday-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(function() {
                var table = $('#holidays').DataTable({
                   
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('holidays.index') }}",
                    order: [
                        [1, 'asc']
                    ],
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'holiday_date',
                            name: 'holiday_date',
                            searchable: true
                        },
                        {
                            data: 'holiday_name',
                            name: 'holiday_name',
                            searchable: true
                        },
                        {
                            data: 'schoolyear.schoolyear',
                            name: 'schoolyear_schoolyear'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ]
                })
            });
        </script>
        @vite('resources/js/holiday.js')
    @endpush
