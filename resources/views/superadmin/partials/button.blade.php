<div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-900 py-4">
        <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            {{-- Search --}}
            <form method="GET" action="{{ route('superadmin.index') }}" class="w-full md:w-auto">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="table-search-users" value="{{ request()->get('search') }}"
                        class="block w-full md:w-80 pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search...">
                </div>
            </form>

            <div class="flex flex-wrap justify-center md:justify-end space-x-2">
                {{-- Delete --}}
                <button id="delete-button" type="button" data-modal-target="delete-modal"
                    data-modal-toggle="delete-modal"
                    class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800"
                    data-tooltip-target="tooltip-delete" data-tooltip-placement="top">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-1 12H6L5 7m5 4v6m4-6v6M9 7h6m2-2H7m3-1h4" />
                    </svg>
                    <span class="sr-only">Delete</span>
                </button>
                <div id="tooltip-delete" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Delete
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                {{-- Edit --}}
                <button type="button" id="edit-button" data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                    class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-yellow-400 dark:hover:bg-yellow-500 dark:focus:ring-yellow-700"
                    data-tooltip-target="tooltip-edit" data-tooltip-placement="top">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536M9 13.5l3.536-3.536 3.536-3.536M9 13.5V18H4v-5.5h5.5z" />
                    </svg>
                    <span class="sr-only">Edit</span>
                </button>
                <div id="tooltip-edit" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Edit
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                {{-- Add --}}
                <button type="button" data-modal-target="add-modal" data-modal-toggle="add-modal"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    data-tooltip-target="tooltip-add" data-tooltip-placement="top">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="sr-only">Add</span>
                </button>
                <div id="tooltip-add" role="tooltip"
                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Add
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>
            </div>
        </div>
    </div>
</div>
