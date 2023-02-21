<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Skills') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('skills.create') }}" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Skill</a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white p-4">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase">
                    <tr class="border-b">
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($skills as $skill)
                        <tr class="border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ $skill->name }}
                            </th>
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/'.$skill->image) }}" alt="skill" class="w-12 h-12">
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('skills.edit', $skill->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Click ok to delete!')"
                                            class="font-medium text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-4 text-red-600">Data Not Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
