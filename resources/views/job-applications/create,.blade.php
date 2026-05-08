<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Job Applications
        </h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a href="{{ route('job-applications.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            Add Job Application
        </a>

        <div class="mt-6 bg-white shadow rounded-lg p-6">
            @if(session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            @forelse($jobApplications as $job)
                <div class="border-b py-4">
                    <h3 class="text-lg font-semibold">{{ $job->company_name }}</h3>
                    <p>{{ $job->job_title }}</p>
                    <p class="text-sm text-gray-500">{{ $job->status }}</p>
                </div>
            @empty
                <p>No job applications found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>