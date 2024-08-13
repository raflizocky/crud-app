<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
    integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const elements = {
            deleteForm: document.getElementById('delete-form'),
            deleteButton: document.getElementById('delete-button'),
            confirmDeleteButton: document.getElementById('confirm-delete-button'),
            deleteModal: document.getElementById('delete-modal'),
            deleteModalText: document.getElementById('delete-modal-text'),
            checkboxes: document.querySelectorAll('input[name="selected[]"]'),
            checkAllCheckbox: document.getElementById('checkbox-all-search'),
            editButton: document.getElementById('edit-button'),
            editModal: document.getElementById('edit-modal'),
            editForm: document.getElementById('edit-form'),
            alertContainer: document.getElementById('alert-container')
        };

        const getSelectedItems = () => Array.from(elements.checkboxes).filter(cb => cb.checked).map(cb => cb
            .value);

        const toggleModal = (modal, show) => {
            modal.classList.toggle('hidden', !show);
            modal.classList.toggle('flex', show);
        };

        const toggleActionButtons = () => {
            const selectedItems = getSelectedItems();
            const isItemSelected = selectedItems.length > 0;
            const isSingleItemSelected = selectedItems.length === 1;

            // Toggle delete button
            elements.deleteButton.disabled = !isItemSelected;
            elements.deleteButton.classList.toggle('opacity-50', !isItemSelected);
            elements.deleteButton.classList.toggle('cursor-not-allowed', !isItemSelected);

            // Toggle edit button
            elements.editButton.disabled = !isSingleItemSelected;
            elements.editButton.classList.toggle('opacity-50', !isSingleItemSelected);
            elements.editButton.classList.toggle('cursor-not-allowed', !isSingleItemSelected);
        };

        // Initial state of action buttons
        toggleActionButtons();

        // Add event listeners to all checkboxes
        elements.checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleActionButtons);
        });

        elements.checkAllCheckbox.addEventListener('change', () => {
            elements.checkboxes.forEach(checkbox => checkbox.checked = elements.checkAllCheckbox
                .checked);
            toggleActionButtons();
        });

        elements.deleteButton.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedItems = getSelectedItems();
            if (selectedItems.length === 0) {
                showAlert('Please select at least one item to delete.', false);
                return;
            }
            elements.deleteModalText.textContent =
                `Are you sure you want to delete ${selectedItems.length} item(s)?`;
            toggleModal(elements.deleteModal, true);
        });

        function showAlert(message, isSuccess) {
            const alertHtml = `
            <div id="alert" class="flex items-center p-4 mb-4 rounded-lg ${isSuccess ? 'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400' : 'text-red-800 bg-red-50 dark:bg-gray-800 dark:text-red-400'}" role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Alert</span>
                <div class="ms-3 text-sm font-medium">${message}</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 p-1.5 inline-flex items-center justify-center h-8 w-8 rounded-lg focus:ring-2 ${isSuccess ? 'bg-green-50 text-green-500 focus:ring-green-400 hover:bg-green-200 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700' : 'bg-red-50 text-red-500 focus:ring-red-400 hover:bg-red-200 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700'}" aria-label="Close" onclick="this.closest('#alert').remove()">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        `;
            elements.alertContainer.innerHTML = alertHtml;
        }

        elements.confirmDeleteButton.addEventListener('click', (e) => {
            e.preventDefault();
            const selectedItems = getSelectedItems();
            if (selectedItems.length === 0) {
                showAlert('Please select at least one item to delete.', false);
                toggleModal(elements.deleteModal, false);
                return;
            }
            document.getElementById('selected-items').value = selectedItems.join(',');

            fetch(elements.deleteForm.action, {
                    method: 'POST',
                    body: new FormData(elements.deleteForm),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.ok ? response.json() : Promise.reject(response.json()))
                .then(data => {
                    showAlert(data.message, data.success);
                    if (data.success) {
                        toggleModal(elements.deleteModal, false);
                        window.location.reload();
                    }
                })
                .catch(error => showAlert(error.message || 'An unknown error occurred', false));
        });

        elements.editButton.addEventListener('click', () => {
            const selectedItems = getSelectedItems();

            if (selectedItems.length !== 1) {
                showAlert('Please select exactly one item to edit.', false);
                return;
            }

            fetch(`/superadmin/${selectedItems[0]}/edit`)
                .then(response => response.json())
                .then(data => {
                    ['name', 'email', 'password', 'role'].forEach(field => {
                        document.getElementById(`edit-${field}`).value = data[field];
                    });
                    elements.editForm.action = `/superadmin/${selectedItems[0]}`;
                    toggleModal(elements.editModal, true);
                })
                .catch(error => showAlert(
                    'An error occurred while fetching the data. Please try again.', false));
        });

        [elements.deleteModal, elements.editModal].forEach(modal => {
            modal.addEventListener('click', (event) => {
                if (event.target === modal || event.target.closest(
                        `[data-modal-hide="${modal.id}"]`)) {
                    toggleModal(modal, false);
                }
            });
        });
    });
</script>
