<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="stylesReports.css" rel="stylesheet" type="text/css" >
</head>
<body>
    <header>
        <h1>MercaTodo</h1>
    </header>
    <main>
        <h3>{{ __('general.web.data_management.report_most_visited_products') }}</h3>
        <p>(From {{ $initialDate }} to {{ $endDate }})</p>

        @if(count($reports))
            <table>
                <thead>
                <th>#</th>
                <th>Id</th>
                <th>{{__('general.web.product.name_es')}}</th>
                <th>{{__('general.web.product.name_en')}}</th>
                <th>{{__('general.web.product.price')}}</th>
                <th>{{__('general.web.product.stock')}}</th>
                <th>{{__('general.web.data_management.number_of_visits')}}</th>
                </thead>
                <tbody>
                @foreach($reports as $key => $report)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $report->product_id  }}</td>
                        <td>{{ $report->name_es }}</td>
                        <td>{{ $report->name_en }}</td>
                        <td>${{ $report->price }}</td>
                        <td>{{ $report->stock }}</td>
                        <td>{{ $report->quantity }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </main>
    <footer>
        <h5>{{ __('general.welcome.slogan') }}</h5>
    </footer>
</body>
</html>
