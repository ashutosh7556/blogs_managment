@csrf
<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium">Name</label>
        <input name="name"
               class="w-full border rounded p-2"
               value="{{ old('name', $category->name ?? '') }}"
               required>
        @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
    </div>

    <div class="flex justify-end">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Save
        </button>
    </div>
</div>
