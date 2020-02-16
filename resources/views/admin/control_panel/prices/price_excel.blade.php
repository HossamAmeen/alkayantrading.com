<html>
    <body>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>رقم</th>
            <th>المستخدم</th>
            <th>الشركه</th>
            <th>اسم المنتج بالعربي</th>
            <th>اسم المنتج بالانجليزي</th>
            <th>السعر</th>

        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        ?>
        @foreach ($products as $product)


            <tr>
                <td>{{$i++}}</td>
                <td>{{$product->id}}</td>
                <td>{{$product->user->name}}</td>
                <th>{{$product->company_name}}</th>
                <td>
                  {{$product->ar_title}}
                </td>
                <td>{{$product->en_title}}</td>
                @if(isset($product->price))
                <td>{{$product->price->price_today}}</td>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
</html>