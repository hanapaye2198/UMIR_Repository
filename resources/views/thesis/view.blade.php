<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $thesis->title }} - Thesis Viewer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .thesis-document {
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin: 2rem auto;
            padding: 3rem;
            max-width: 8.5in;
            min-height: 11in;
        }
        .thesis-header {
            border-bottom: 2px solid #333;
            padding-bottom: 1rem;
            margin-bottom: 2rem;
        }
        .thesis-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 1rem;
        }
        .thesis-subtitle {
            font-size: 1.2rem;
            text-align: center;
            font-style: italic;
            margin-bottom: 2rem;
        }
        .thesis-author {
            text-align: center;
            font-weight: bold;
            margin-top: 3rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Thesis Document Viewer</h1>
            <a href="{{ asset('storage/' . $thesis->file_path) }}"
               download
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Download PDF
            </a>
        </div>

        <div class="thesis-document">
            <div class="thesis-header">
                <div class="thesis-title">{{ strtoupper($thesis->title) }}</div>
                @if($thesis->subtitle)
                    <div class="thesis-subtitle">{{ $thesis->subtitle }}</div>
                @endif
            </div>

            <div class="thesis-content">
                <p class="text-center mb-8">A Thesis</p>
                <p class="text-center mb-8">
                    Submitted for partial fulfillment for the {{ $thesis->degree }}<br>
                    to the department of {{ $thesis->department }}<br>
                    {{ $thesis->institution }}
                </p>

                <div class="thesis-author">
                    <p>By</p>
                    <p class="text-xl">{{ $thesis->author }}</p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('thesis.index') }}" class="text-blue-600 hover:text-blue-800">
                &larr; Back to Thesis List
            </a>
        </div>
    </div>
</body>
</html>
