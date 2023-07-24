<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PharmaShots Sitemap</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .ps-sitmap-section {
            padding: 50px;
        }

        .ps-sitmap-title {
            margin-bottom: 10px;
            font-size: 32px;
            font-weight: 600;
            color: #6c6c6c;
        }

        .ps-sitmap-description {
            margin-bottom: 10px;
        }

        .ps-sitmap-table table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 50px;
            font-size: 14px;
        }

        .ps-sitmap-table tr * {
            padding: 5px 10px;
            text-align: left;
        }

        .ps-sitmap-table tr td a {
            color: black
        }

        .ps-sitmap-table thead {
            background-color: #d8d3d3;
        }

        .ps-sitmap-table tbody tr:nth-child(odd) {
            background-color: #f5eded;
        }

        .ps-sitmap-table thead tr th {
            border-bottom: 2px solid #727272;
        }

        nav .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            list-style: none;
            padding-left: 0;
            margin-top: 40px;
        }

        nav .pagination .page-link {
            margin: 0 8px;
        }

        nav .pagination .page-link {
            color: black;
            text-decoration: none;
            padding: 0.2rem 0.8rem;
            border: 1px solid #d5d5d5;
        }

        nav .pagination .page-link .active {
            padding: 5px 10px;
            background-color: #efefef;
            border-radius: 3px;
        }

        nav .pagination .disabled {
            cursor: not-allowed;
        }

        nav .pagination .page-item:first-child .page-link {
            padding: 0.2rem 0.8rem;
            background-color: #d7d7d7;
        }

        nav .pagination .page-item:last-child .page-link {
            padding: 0.2rem 0.8rem;
            background-color: #d7d7d7;
        }

        .ps-sub-title {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <section class="ps-sitmap-section">
        <h1 class="ps-sitmap-title">Sitemap</h1>
        <div class="ps-sub-title">
            <span class="ps-sitmap-description">Explore PharmaShots: A Comprehensive Sitemap of Our Website</span>
            <span>Total Number of URLs : <strong>{{ $count_total_links }}</strong></span>
        </div>
        <div class="ps-sitmap-table">

            <table>
                <thead>
                    <tr>
                        <th>URL</th>
                        <th>Last Modified</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allUrls as $url)
                        <tr>
                            <td>
                                <a target="_blank" href="{{ $url->url }}">{{ $url->url }}</a>
                            </td>
                            <td>{{ $url->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @php
            $pagePrev = $allUrls->currentPage() - 1;
            $pageNext = $allUrls->currentPage() + 1;
            
            // url of the previous page with query string parameters
            $urlPrev = $allUrls->url($pagePrev);
            $urlNext = $allUrls->url($pageNext);
        @endphp

        <nav>
            <ul class="pagination">
                @if ($allUrls->currentPage() > 1)
                    <li class="page-item">
                        <a href="{{ $urlPrev }}" class="page-link">Previous</a>
                    </li>
                @endif

                @if ($allUrls->currentPage() < $pageNext)
                    <li class="page-item">
                        <a href="{{ $urlNext }}" class="page-link">Next</a>
                    </li>
                @endif
            </ul>
        </nav>

    </section>
</body>

</html>
