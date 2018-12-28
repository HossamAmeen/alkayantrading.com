<html>
    <body>
        <table>
                <table class="table">
                    <tbody>
                        <?php $i=1; ?>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{$i++}}</td>
                                <td >{{$item->ar_title}}</td>
                                <td >{{$item->company_name}}</td>
                                <td >{{$item->en_title}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </table>
    </body>
</html>