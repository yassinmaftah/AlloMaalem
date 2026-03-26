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
                                        <a href="{{ route('maalem.applications.edit', $application->id) }}"
                                           class="text-sm bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-3 py-1 rounded-lg transition">
                                            Edit
                                        </a>
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

</body>
</html>
