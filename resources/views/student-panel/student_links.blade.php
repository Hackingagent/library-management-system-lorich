@extends("user_layout")
@section("content")
    <div class="container user-links-page">
        <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="page-heading">External Resources</h2>
                <p>Explore useful external websites, journals, and articles curated by the library.</p>
            </div>
        </div>

        <div class="row">
            @php
                $groupedLinks = [
                    'site' => [
                        ['title' => 'Example Research Site', 'url' => 'https://research.example.com'],
                        ['title' => 'Online Encyclopedia', 'url' => 'https://encyclopedia.example.org']
                    ],
                    'journal' => [
                        ['title' => 'Journal of Fictional Science', 'url' => 'https://jfs.example.edu'],
                    ],
                    'article' => [
                        ['title' => 'Getting Started with Laravel', 'url' => 'https://laravel-docs.example.com/article1'],
                        ['title' => 'Advanced Blade Techniques', 'url' => 'https://blade-pro.example.net/advanced']
                    ]
                ];
            @endphp

            @foreach ($groupedLinks as $type => $linksOfType)
                @if (!empty($linksOfType))
                    <div class="col-md-12 mb-4">
                        <h4>{{ ucfirst($type) }}s</h4>
                        <div class="list-group">
                            @foreach ($linksOfType as $link)
                                <a href="{{ $link["url"] }}" class="list-group-item list-group-item-action" target="_blank">
                                    {{ $link["title"] }}
                                    <small class="text-muted d-block">{{ $link["url"] }}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>

    <style>
        .page-heading {
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .user-links-page h4 {
            margin-top: 15px;
            color: #343a40;
        }
    </style>
@endsection