
</br>
@if(!$services->isEmpty())


                <table class='table table-striped table-bordered'>
                    <thead>
                    <tr>
                        <td>Услуга</td>
                        <td>Добавить в парйс</td>
                        <td>Стоимость, &nbsp руб.</td>
                    </tr>
                    </thead>
                    <tbody >
                    @foreach ($services as $service)
                        <tr>
                            <td>{{$service->title}}</td>
                                @if(isset($cosmetolog))
                                    @if($cosmetolog->hasService($service->id))
                                         <td>
                                            <input checked name="serviceCheck[]" type="checkbox" value="{{$service->id}}" id="{{$service->id}}">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="servicePrice[{{$service->id}}]"  value="{{$cosmetolog->getServiceCost($service->id)}}" placeholder="Введите стоимость" >
                                        </td>
                                    @else
                                        <td>
                                            <input  name="serviceCheck[]" type="checkbox" value="{{$service->id}}" id="{{$service->id}}">
                                        </td>
                                        <td>
                                            <input class="form-control" type="text" name="servicePrice[{{$service->id}}]"  value="" placeholder="Введите стоимость" >
                                        </td>
                                    @endif
                                @else
                                    <td>
                                        <input  name="serviceCheck[]" type="checkbox" value="{{$service->id}}" id="{{$service->id}}">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="servicePrice[{{$service->id}}]"  value="" placeholder="Введите стоимость" >
                                    </td>
                                @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>



@endif
