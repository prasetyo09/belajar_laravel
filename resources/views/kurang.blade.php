<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('action-kurang') }}" method="post">
        @csrf
        <label for="">Angka 1</label><br>
        <input type="number" name="angka1" id=""><br>
        <label for="">Angka 2</label><br>
        <input type="number" name="angka2" id=""><br><br>

        <button type="submit">Hitung</button>
    </form>
    <a href="{{ url('counting') }}">Back</a>
    <h3>Hasilnya: {{ isset($hasilKurang) ? $hasilKurang : 0  }}</h3>

</body>
</html>
