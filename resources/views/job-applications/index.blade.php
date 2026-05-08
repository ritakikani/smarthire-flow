<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Job Application
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <form method="POST" action="{{ route('job-applications.store') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium">Company Name</label>
                    <input type="text" name="company_name" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Job Title</label>
                    <input type="text" name="job_title" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Location</label>
                    <input type="text" name="location" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Source</label>
                    <input type="text" name="source" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Job URL</label>
                    <input type="url" name="external_url" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Status</label>
                    <select name="status" class="w-full border rounded p-2">
                        <option value="Applied">Applied</option>
                        <option value="Interview">Interview</option>
                        <option value="Offer">Offer</option>
                        <option value="Rejected">Rejected</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Applied Date</label>
                    <input type="date" name="applied_at" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Salary Range</label>
                    <input type="text" name="salary_range" class="w-full border rounded p-2">
                </div>

                <div class="mb-4">
                    <label class="block font-medium">Job Description</label>
                    <textarea name="job_description" class="w-full border rounded p-2" rows="5"></textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Save Job Application
                </button>
            </form>
        </div>
    </div>
</x-app-layout>