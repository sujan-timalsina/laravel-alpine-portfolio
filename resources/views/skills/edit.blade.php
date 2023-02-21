<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Skill') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-md">
            <form method="POST" action="{{ route('skills.update', $skill->id) }}" class="p-4 max-w-md" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--  Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $skill->name)" autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!--  Image -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"/>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                @if($skill->image)
                <!-- Current Image -->
                <div class="mt-4">
                    <p>Current Image</p>
                    <img src="{{ asset('storage/'.$skill->image) }}" alt="skill" class="w-12 h-12">
                </div>
                @endif

                <div class="flex items-center justify-start mt-4">
                    <x-primary-button>
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
