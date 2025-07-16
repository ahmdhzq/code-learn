<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Kita akan menggunakan CDN Tailwind CSS untuk styling cepat -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen bg-gray-200">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white p-5">
            <h2 class="text-2xl font-bold mb-10">CodeLearn Admin</h2>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="block py-2.5 px-4 rounded transition duration-200 bg-gray-700">Dashboard</a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Kelola Tracks</a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Kelola Materi</a>
                <a href="#" class="block py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">Kelola Pengguna</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center p-6 bg-white border-b">
                <h1 class="text-xl font-semibold">Dashboard</h1>
                <div>
                    <span class="mr-2">Welcome, {{ auth()->user()->name }}</span>
                    <!-- Form untuk Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-blue-500 hover:text-blue-700">Logout</button>
                    </form>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6">
                <div class="bg-white p-8 rounded-md shadow-md">
                    <h2 class="text-2xl font-bold mb-4">Selamat Datang di Panel Admin!</h2>
                    <p>Dari sini, Anda dapat mengelola semua aspek platform CodeLearn.</p>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
