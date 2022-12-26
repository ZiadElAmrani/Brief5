<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todos Index</title>
</head>
<body>
    <form action="{{URL('/todoInsert')}}" method="POST">
        @csrf
        Todo name: <input type="text" name="name">
        <input type="submit" value="submit">
    </form>

    @foreach($data as $row)

    <table>
        <tr>
            <th>Todo Id</th>
            <th>Todo Name</th>
        </tr>
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name}}</td>
        </tr>
    </table>

    @endforeach
</body>
</html>