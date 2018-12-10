
									@if(!empty( $data['category'.$c] ))
                                    <?php $i=1; ?>
                                    @foreach ($data['category'.$c++] as $item)	
                                    <tr>							
                                        <td> {{  $item->company_name }}</td>
                                        <td> {{  $item->en_title }}</td>
                                        <td> {{  $item->price }}</td>
                                                                
                                    </tr>
                                    @endforeach
                                @endif
                                