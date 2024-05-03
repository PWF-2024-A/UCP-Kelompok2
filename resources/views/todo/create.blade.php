<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Add Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="todoForm" method="post" action="{{ route('todo.store') }}">
                        @csrf

                        <div class="mb-6">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1"
                                required autofocus autocomplete="title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id"
                                class="block w-full mt-1 text-white bg-gray-800 dark:text-gray-200">
                                <option value="">None</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                        </div>

                        <!-- Hidden input field to capture category ID -->
                        <input type="hidden" id="hidden_category_id" name="category_id"
                            value="{{ $categories->first()->id }}" />

                        <div class="flex items-center gap-4">
                            <x-primary-button type="button"
                                onclick="submitForm()">{{ __('Save') }}</x-primary-button>
                            <x-cancel-button href="{{ route('todo.index') }}" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateCategoryId() {
            var categoryId = document.getElementById('category_id').value;
            document.getElementById('hidden_category_id').value = categoryId;
        }

        function submitForm() {
            updateCategoryId(); // Ensure the category ID is updated before form submission
            document.getElementById('todoForm').submit(); // Submit the form
        }
    </script>
</x-app-layout>
