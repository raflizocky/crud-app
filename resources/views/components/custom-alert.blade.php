 {{-- Alert --}}
 <div id="alert-container">
     @if (session('success') || $errors->any())
         <div id="alert" class="flex items-center p-4 mb-4 rounded-lg" role="alert" x-data="{ isSuccess: {{ session('success') ? 'true' : 'false' }} }"
             :class="isSuccess ? 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400' :
                 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400'">
             <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                 viewBox="0 0 20 20">
                 <path
                     d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
             </svg>
             <span class="sr-only">Alert</span>
             <div class="ms-3 text-sm font-medium">
                 @if (session('success'))
                     {{ session('success') }}
                 @elseif ($errors->any())
                     <ul>
                         @foreach ($errors->all() as $error)
                             <li>{{ $error }}</li>
                         @endforeach
                     </ul>
                 @endif
             </div>
             <button type="button"
                 class="ms-auto -mx-1.5 -my-1.5 p-1.5 inline-flex items-center justify-center h-8 w-8 rounded-lg focus:ring-2"
                 aria-label="Close"
                 :class="isSuccess ?
                     'bg-green-50 text-green-500 focus:ring-green-400 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700' :
                     'bg-red-50 text-red-500 focus:ring-red-400 hover:bg-red-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700'"
                 @click="$el.closest('#alert').remove()">
                 <span class="sr-only">Close</span>
                 <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                 </svg>
             </button>
         </div>
     @endif
 </div>
