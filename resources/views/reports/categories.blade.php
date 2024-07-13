<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Categorías</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Reporte de Categorías</h1>
    <table>
        <thead>
            <tr>  
                <th>Id</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>En Uso</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
                <tr>
                    <td>{{ $cat->cat_id }}</td>
                    <td>{{ $cat->cat_name }}</td>
                    <td>{{ $cat->cat_description }}</td>
                    <td>{{ $cat->enUso }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
