<html>
    <body>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>id</th>
            <th>user_id</th>
            <th>التصنيف</th>
            <th>اسم المنتج بالعربي</th>
            <th>اسم المنتج بالانجليزي</th>
            <th>price</th>

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
                <td>{{$product->user_id}}</td>
                <th>{{$product->company_name}}</th>
                <td>
                  {{$product->ar_title}}
                </td>
                <td>{{$product->en_title}}</td>



            </tr>
        @endforeach
        </tbody>
    </table>
    </body>
</html>