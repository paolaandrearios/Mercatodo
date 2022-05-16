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
        <h3>{{ __('general.web.data_management.report_abandoned_carts') }}</h3>
        <p>(From {{ $initialDate }} to {{ $endDate }})</p>

        @if(count($reports))
            <table>
                <thead>
                <th>#</th>
                <th>Id</th>
                <th>{{__('general.web.order.reference')}}</th>
                <th>{{__('general.web.order.first_name')}}</th>
                <th>{{__('general.web.order.last_name')}}</th>
                <th>{{__('general.web.order.email')}}</th>
                <th>{{__('general.web.order.phone')}}</th>
                <th>{{__('general.web.order.total')}}</th>
                </thead>
                <tbody>

                @foreach($reports as $key => $report)
                    <tr>
                        <td>{{ $key+1}}</td>
                        <td>{{ $report['id']  }}</td>
                        <td>{{ $report['reference'] }}</td>
                        <td>{{ $report['first_name'] }}</td>
                        <td>{{ $report['last_name'] }}</td>
                        <td>{{ $report['email'] }}</td>
                        <td>{{ $report['phone'] }}</td>
                        <td>{{ $report['total'] }}</td>
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
