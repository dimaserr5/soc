<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Добавить пост
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="form-file">
                        <input type="file" class="form-file-input" id="customFileLong">
                        <label class="form-file-label" for="customFileLong">
                            <span class="form-file-button">Browse</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
