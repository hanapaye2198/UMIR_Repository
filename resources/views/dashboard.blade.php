<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UMIR Style Repository</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800">
  <!-- Header -->
  <header class="bg-red-800 text-white">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-4">
      <div class="flex items-center gap-2">
        <img src="/logo.png" alt="UMIR Logo" class="h-10">
        <div>
          <h1 class="text-xl font-bold">UMIR</h1>
          <p class="text-xs">Institutional Repository</p>
        </div>
      </div>
      <div class="text-sm hidden md:block">Saturday, April 19, 2025</div>
    </div>
  </header>

  <!-- Navbar -->
  <nav class="bg-red-700 text-white text-sm">
    <div class="max-w-7xl mx-auto px-4 py-2 flex flex-wrap justify-between items-center">
      <div class="flex gap-4">
        <a href="#" class="hover:underline">UMIR Communities</a>
        <a href="#" class="hover:underline">Library Catalog</a>
        <a href="#" class="hover:underline">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Hero Search -->
  <div class="bg-gray-800 text-white px-4 py-4">
    <div class="max-w-7xl mx-auto flex flex-wrap gap-4 items-center">
      <select class="text-black px-3 py-2 rounded">
        <option>All</option>
        <option>Title</option>
        <option>Author</option>
      </select>
      <input type="text" placeholder="Search" class="flex-1 px-4 py-2 text-black rounded" />
    </div>
  </div>

  <!-- Breadcrumb -->
  <div class="bg-yellow-400 text-black py-2 px-4">
    <div class="max-w-7xl mx-auto">
      <a href="#" class="font-medium">UMIR Home</a>
    </div>
  </div>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-4 gap-6">
    <!-- Main Body -->
    <div class="md:col-span-3">
      <h2 class="text-2xl font-bold mb-2">Welcome to UMIR!</h2>
      <p class="text-sm mb-6">
        <strong>UMIR</strong> is the institutional repository of University of Mindanao. It digitally captures, stores, preserves and redistributes the intellectual and research outputs of the University of Mindanao Main and Campuses.
      </p>

      <h3 class="text-xl font-semibold mb-2">Communities in UMIR</h3>
      <p class="mb-4">Select a community to browse its collections.</p>

      <ul class="list-disc pl-6 mb-6">
        <li><strong>UM Main</strong> - University of Mindanao Main</li>
        <li><strong>UM Tagum</strong> - University of Mindanao - Tagum Campus</li>
      </ul>

      <h3 class="text-xl font-semibold mb-4">Recently Added</h3>

      <div class="space-y-6">
        <!-- Paper Card -->
        <div class="flex gap-4 border-b pb-4">
          <img src="/images/sample-thumb.png" class="w-24 h-32 object-cover border" alt="thumbnail">
          <div>
            <h4 class="text-md font-semibold">Deceptive advertisement and consumer’s brand trust.</h4>
            <p class="text-sm text-gray-600">Paraiso, Erica Jane L.; Arbol, Karen Louie C. (Business Administration - Marketing Management, 2023-05)</p>
            <p class="text-sm mt-1 text-gray-700">Deceptive advertisements start when a firm or company supports its product or services with the help of misleading, untrue, or confusing statements...</p>
          </div>
        </div>

        <!-- Repeat for more papers -->
      </div>

      <div class="mt-6">
        <button class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded">View more</button>
      </div>
    </div>

    <!-- Sidebar -->
    <aside class="space-y-4 text-sm">
      <div>
        <h4 class="font-semibold border-b pb-1">All of UMIR</h4>
        <ul class="mt-2 space-y-1">
          <li><a href="#" class="text-blue-600 hover:underline">Communities & Collections</a></li>
          <li><a href="#">By Issue Date</a></li>
          <li><a href="#">Authors</a></li>
          <li><a href="#">Titles</a></li>
          <li><a href="#">Subjects</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold border-b pb-1">My Account</h4>
        <ul class="mt-2 space-y-1">
          <li><a href="#">Logout</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Submissions</a></li>
        </ul>
      </div>
      <div>
        <h4 class="font-semibold border-b pb-1">Discover</h4>
        <p class="font-bold mt-2">Author</p>
        <ul class="space-y-1 text-gray-700">
          <li>Buenaventura, Viola P. (29)</li>
          <li>Montano, Marlon (26)</li>
          <li>...</li>
        </ul>

        <p class="font-bold mt-4">Subject</p>
        <ul class="space-y-1 text-gray-700">
          <li>Davao del Sur (52)</li>
          <li>Bansalan (47)</li>
          <li>...</li>
        </ul>

        <p class="font-bold mt-4">Date Issued</p>
        <ul class="space-y-1 text-gray-700">
          <li>2020 - 2024 (554)</li>
          <li>2010 - 2019 (669)</li>
          <li>...</li>
        </ul>

        <p class="font-bold mt-4 text-red-700">Has File(s)</p>
        <ul class="space-y-1">
          <li>Yes (1142)</li>
          <li>No (86)</li>
        </ul>
      </div>
    </aside>
  </main>

  <!-- Footer (optional) -->
</body>
</html>
