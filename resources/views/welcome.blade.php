<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allo Maalem - Trouvez un artisan facilement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans flex flex-col min-h-screen">

    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/" class="text-2xl font-bold text-blue-600">🛠️ Allo Maalem</a>
                </div>

                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#about" class="text-gray-600 hover:text-blue-600 font-medium">About Us</a>
                    <a href="#contact" class="text-gray-600 hover:text-blue-600 font-medium">Contact</a>

                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-medium">Log in</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium transition">Register</a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md font-medium transition">Go to Dashboard</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <section class="pt-32 pb-20 bg-blue-50">
        <div class="max-w-7xl mx-auto px-4 text-center sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
                Find the Best <span class="text-blue-600">Maalem</span> in Your City
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
                Plumbers, electricians, carpenters, and more. Connect with trusted artisans quickly and easily for all your home repair needs.
            </p>
            @guest
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-bold shadow-lg transition">Get Started Today</a>
            @endguest
        </div>
    </section>

    <section id="about" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">About Allo Maalem</h2>
            <div class="max-w-3xl mx-auto text-gray-600 text-lg leading-relaxed">
                <p class="mb-4">
                    Today, it is difficult to find a good artisan when you have an emergency. You ask friends, you search a lot, and you lose time.
                </p>
                <p>
                    <strong>Allo Maalem</strong> is the solution. It is a simple platform that connects people who need help with the best professional artisans (Maalems) in their city. Fast, reliable, and easy to use!
                </p>
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 bg-gray-100 flex-grow">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Contact Us</h2>
            <div class="bg-white p-8 rounded-lg shadow-md">
                <form action="#" method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Your Name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="you@example.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea rows="4" class="w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" placeholder="How can we help you?"></textarea>
                    </div>
                    <button type="button" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-4 rounded-md transition">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 text-center sm:px-6 lg:px-8">
            <p class="text-gray-400">&copy; {{ date('Y') }} Allo Maalem. All rights reserved.</p>
            <p class="text-gray-500 text-sm mt-2">Built with ❤️ in Morocco.</p>
        </div>
    </footer>

</body>
</html>
