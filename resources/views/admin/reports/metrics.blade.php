<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>App Metrics Report - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        thead > tr, tbody > tr, tr > th, tr > td {
            padding: 8px;
        }
    </style>
</head>
<body>
<h1>{{ config('app.name') }} App Metrics Report</h1>
<p>A brief report with selected app metrics</p>
<hr>

<table style="width:100%; border: 0; padding: 9px 10px;  text-align: left;">
    <thead>
    <tr>
        <th width="50%">Metric</th>
        <th width="50%">Value</th>
    </tr>
    </thead>
    <tbody style="width: 100%; border-top: 1px solid #CCCCCC; text-align: left;">
    <tr>
        <td>Total users</td>
        <td>{{ $total_users }}</td>
    </tr>
    <tr>
        <td>Total posts</td>
        <td>{{ $posts }}</td>
    </tr>
    <tr>
        <td>Published posts</td>
        <td>{{ $total_live_posts }}</td>
    </tr>
    <tr>
        <td>Unpublished posts</td>
        <td>{{ $total_unpublished_posts }}</td>
    </tr>
    <tr>
        <td>Users with posts</td>
        <td>{{ $users_with_posts }}</td>
    </tr>
    <tr>
        <td>Users with published posts</td>
        <td>{{ $users_with_live_posts }}</td>
    </tr>
    <tr>
        <td>Most rated post</td>
        <td>{{ $most_rated->title }} ({{ $most_rated->averageRating() }} | {{ $most_rated->ratings_count }} readers)</td>
    </tr>
    <tr>
        <td>Most viewed post</td>
        <td>{{ $most_viewed->title }} ({{ $most_viewed->viewed_users_count }})</td>
    </tr>
    <tr>
        <td>Total Feedback</td>
        <td>{{ $feedback }}</td>
    </tr>
    </tbody>
</table>

<hr>
Generated on {{ $date }}
</body>
</html>