<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            width: auto;
        }

        th {
            background-color: #f2f2f2;
        }

        tbody {
            height: calc(100% - 40px); /* Adjust this value based on your header and other elements */
            overflow-y: auto;
            display: block;
        }

        tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Header 1</th>
                <th>Header 2</th>
                <th>Header 3</th>
                <th>Header 4</th>
                <th>Header 5</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Data 1</td>
                <td>Data 2</td>
                <td>Data 3</td>
                <td>Data 4</td>
                <td>Data 5</td>
            </tr>
            <tr>
                <td>Data 6</td>
                <td>Data 7</td>
                <td>Data 8</td>
                <td>Data 9</td>
                <td>Data 10</td>
            </tr>
            <tr>
                <td>Data 11</td>
                <td>Data 12</td>
                <td>Data 13</td>
                <td>Data 14</td>
                <td>Data 15</td>
            </tr>
            <tr>
                <td>Data 16</td>
                <td>Data 17</td>
                <td>Data 18</td>
                <td>Data 19</td>
                <td>Data 20</td>
            </tr>
            <!-- Add more rows as needed -->
        </tbody>
    </table>
</body>
</html>
