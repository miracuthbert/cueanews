<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Users Report - {{ config('app.name') }} </title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
        }

        thead > tr, tbody > tr, tr > th, tr > td {
            padding: 8px;
        }
    </style>
</head>
<body>
<h1>{{ config('app.name') }} Users Report</h1>
<p>A brief report with selected users details.</p>
<p>Total users {{ $total_users }}</p>
<hr>

<table style="width:100%; border: 0; padding: 9px 10px;  text-align: left;">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Joined</th>
    </tr>
    </thead>
    <tbody style="width: 100%; border-top: 1px solid #CCCCCC; text-align: left;">
    @foreach($users as $user)
        <tr>
            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->created_at->toDateString() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<hr>
Generated on {{ $date }}
</body>
</html>