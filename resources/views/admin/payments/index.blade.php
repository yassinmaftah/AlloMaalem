<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Payment History - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fb; min-height: 100vh; }
        h1, h2, h3 { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-[#f7f9fb] text-[#191c1e] antialiased">

    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-12 mb-20">

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight flex items-center gap-3">
                    Payment History
                </h1>
                <p class="text-gray-500 mt-2">A complete log of all successful Premium upgrades.</p>
            </div>

            <div class="bg-gradient-to-r from-green-600 to-green-500 text-white px-8 py-4 rounded-2xl shadow-lg flex items-center gap-4">
                <div>
                    <p class="text-sm font-bold uppercase tracking-wider opacity-90">Total App Revenue</p>
                    <p class="text-3xl font-black">${{ $totalRevenue }}</p>
                </div>
            </div>
        </header>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            @if($payments->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
                    <h3 class="text-xl font-bold">No Payments Yet</h3>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500 font-bold">
                                <th class="px-6 py-4">Transaction ID</th>
                                <th class="px-6 py-4">User Details</th>
                                <th class="px-6 py-4">Date & Time</th>
                                <th class="px-6 py-4 text-right">Amount Paid</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($payments as $payment)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-sm text-gray-500">
                                        {{ $payment->id}}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-900">{{ $payment->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $payment->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $payment->created_at->format('M d, Y') }}</div>
                                        <div class="text-xs text-gray-500">{{ $payment->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold">
                                            + ${{ number_format($payment->price, 2) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>

</body>
</html>
