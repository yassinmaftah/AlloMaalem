<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">My Applications</h1>

        @if($applications->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                You have not applied to any jobs yet.
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Job Title</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date Applied</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">My Proposed Price</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($applications as $application)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-gray-800 font-medium">{{ $application->job->title }}</td>
                                <td class="px-6 py-4 text-gray-500 text-sm">{{ $application->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-gray-700 font-semibold">{{ number_format($application->proposed_price, 2) }} DH</td>
                                <td class="px-6 py-4">
                                    @php
                                        $colors = [
                                            'pending'  => 'bg-yellow-100 text-yellow-700',
                                            'accepted' => 'bg-green-100 text-green-700',
                                            'rejected' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $colors[$application->status] }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($application->status === 'pending')
                                        <div class="flex gap-2">
                                            <a href="{{ route('maalem.applications.edit', $application->id) }}"
                                               class="text-sm bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-3 py-1 rounded-lg transition">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('maalem.applications.destroy', $application->id) }}" id="cancel-form-{{ $application->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="openModal({{ $application->id }})"
                                                        class="text-sm bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-1 rounded-lg transition">
                                                    Cancel Offer
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $applications->links() }}
            </div>
        @endif
    </main>

    <div id="cancel-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl p-8 max-w-sm w-full">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Cancel this offer?</h2>
            <p class="text-gray-500 mb-6">This action cannot be undone.</p>
            <div class="flex gap-3 justify-end">
                <button onclick="closeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-5 rounded-lg transition">Go Back</button>
                <button onclick="submitCancel()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-5 rounded-lg transition">Yes, Cancel</button>
            </div>
        </div>
    </div>

    <script>
        let activeFormId = null;

        function openModal(id) {
            activeFormId = id;
            document.getElementById('cancel-modal').classList.remove('hidden');
        }

        function closeModal() {
            activeFormId = null;
            document.getElementById('cancel-modal').classList.add('hidden');
        }

        function submitCancel() {
            document.getElementById('cancel-form-' + activeFormId).submit();
        }
    </script>

</body>
</html>
