<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@if(count($reports))
    <table>
        <thead>
            <th>Id</th>
            <th>{{__('general.web.order.reference')}}</th>
            <th>{{__('general.web.order.first_name')}}</th>
            <th>{{__('general.web.order.last_name')}}</th>
            <th>{{__('general.web.order.email')}}</th>
            <th>{{__('general.web.order.phone')}}</th>
            <th>{{__('general.web.order.total')}}</th>
            <th>{{__('general.web.created_at')}}</th>
            <th>{{__('general.web.updated_at')}}</th>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report['id']  }}</td>
                    <td>{{ $report['reference'] }}</td>
                    <td>{{ $report['first_name'] }}</td>
                    <td>{{ $report['last_name'] }}</td>
                    <td>{{ $report['email'] }}</td>
                    <td>{{ $report['phone'] }}</td>
                    <td>{{ $report['total'] }}</td>
                    <td>{{ ($report['created_at'])}}</td>
                    <td>{{ ($report['updated_at'])}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
</body>
</html>
