<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white shadow-md rounded-md">
            <form method="POST" action="{{ route('projects.update', $project->id) }}" class="p-4 max-w-md" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!--  Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $project->name)" autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!--  Skill -->
                <div class="mt-4">
                    <x-input-label for="skill" :value="__('Skill')" />
                    <!-- <x-text-input id="skill" class="block mt-1 w-full" type="text" name="skill" :value="old('skill')" autofocus /> -->
                    <select name="skill_id" id="skill_id" class="block mt-1 w-full">
                        <option value="">Select Skill</option>
                        @foreach($skills as $skill)
                            <option value="{{ $skill->id }}" {{ $skill->id == $project->skill_id ? 'selected' : '' }}>{{ $skill->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('skill_id')" class="mt-2" />
                </div>

                <!--  Image -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image"/>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                @if($project->image)
                <!-- Current Image -->
                <div class="mt-4">
                    <p>Current Image</p>
                    <img src="{{ asset('storage/'.$project->image) }}" alt="project" class="w-12 h-12">
                </div>
                @endif

                <!--  Project URL -->
                <div class="mt-4">
                    <x-input-label for="project_url" :value="__('Project URL')" />
                    <x-text-input id="project_url" class="block mt-1 w-full" type="text" name="project_url" :value="old('project_url', $project->project_url)" autofocus />
                    <x-input-error :messages="$errors->get('project_url')" class="mt-2" />
                </div>

                <div class="flex items-center justify-start mt-4">
                    <x-primary-button>
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
